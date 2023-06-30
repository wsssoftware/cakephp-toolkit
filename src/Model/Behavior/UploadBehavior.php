<?php
declare(strict_types=1);

namespace Toolkit\Model\Behavior;

use ArrayObject;
use Cake\Database\TypeFactory;
use Cake\Datasource\EntityInterface;
use Cake\Error\FatalErrorException;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Laminas\Diactoros\UploadedFile;
use Toolkit\Database\Type\FileType;
use Toolkit\Upload\FileConfig;
use Toolkit\Upload\FileContainer;

/**
 * Upload behavior
 */
class UploadBehavior extends Behavior
{
    /**
     * Default configuration.

     * @var array
     */
    protected $_defaultConfig = [
        'files' => [],
    ];
    
    /**
     * @var array
     */
    protected $filesToSave = [];
    
    /**
     * @var array
     */
    protected $filesToDelete = [];

    /**
     * @param array $config
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        if (TypeFactory::getMap('file') === null) {
            TypeFactory::set('file', new FileType());
        }
        $schema = $this->_table->getSchema();
        $files = $this->getConfig('files', []);
        if (!is_array($files)) {
            throw new FatalErrorException("On table '{$this->_table->getAlias()}', config 'files' must to be an array");
        }
        $this->setConfig('files', [], false);
        foreach ($files as $index => $fileConfig) {
            if (!$fileConfig instanceof FileConfig) {
                throw new FatalErrorException("On table '{$this->_table->getAlias()}', upload file config on index $index must be a instance of 'Toolkit\Upload\FileConfig'");
            }
            if (!empty($newFiles[$fileConfig->getColumn()])) {
                throw new FatalErrorException("On table '{$this->_table->getAlias()}', the column '{$fileConfig->getColumn()}' was declared two times");
            }
            $this->setConfig('files', [$fileConfig->getColumn() => $fileConfig]);
            if ($schema->hasColumn($fileConfig->getColumn())) {
                $schema->setColumnType($fileConfig->getColumn(), 'file');
            }
        }
    }
    
    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $data, ArrayObject $options) {
        /** @var FileConfig $fileConfig */
        foreach ($this->getConfig('files', []) as $fileConfig) {
            /** @var UploadedFile|null|mixed $column */
            $column = $entity->get($fileConfig->getColumn());
            if (!empty($column) && $column instanceof UploadedFile) {
                switch ($column->getError()) {
                    case UPLOAD_ERR_OK:
                        $pathinfo = pathinfo($column->getClientFilename());
                        $data = [
                            'filename' => uniqid($fileConfig->getFilenamePrefix(), true) . '.' . $pathinfo['extension'],
                            'path' => $fileConfig->getPath(),
                        ];
                        $this->filesToSave[$fileConfig->getColumn()] = $column;
                        $entity->set($fileConfig->getColumn(), new FileContainer($data));
                        if (!empty($entity->getOriginal($fileConfig->getColumn())) && $entity->getOriginal($fileConfig->getColumn()) instanceof FileContainer) {
                            $this->filesToDelete[$fileConfig->getColumn()] = $entity->getOriginal($fileConfig->getColumn());
                        }
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $entity->set($fileConfig->getColumn(), $entity->getOriginal($fileConfig->getColumn()));
                        $entity->setDirty($fileConfig->getColumn(), false);
                        break;
                    default:
                        throw new FatalErrorException(UploadedFile::ERROR_MESSAGES[$column->getError()]);
                        break;
                }
            }
        }
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \Cake\Datasource\EntityInterface $entity
     * @param \ArrayObject $options
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        /** @var FileConfig $fileConfig */
        foreach ($this->getConfig('files', []) as $fileConfig) {
            /** @var FileContainer|null|mixed $column */
            $column = $entity->{$fileConfig->getColumn()};
            if (!empty($this->filesToSave[$fileConfig->getColumn()]) && $column instanceof FileContainer) {
                /** @var UploadedFile $uploadedFile */
                $uploadedFile = $this->filesToSave[$fileConfig->getColumn()];
                if (!is_dir($column->getPath())) {
                    mkdir($column->getPath(), 0777, true);
                }
                $uploadedFile->moveTo($column->getPathAndFile());
            }
            if (!empty($this->filesToDelete[$fileConfig->getColumn()]) && $this->filesToDelete[$fileConfig->getColumn()] instanceof FileContainer) {
                $this->filesToDelete[$fileConfig->getColumn()]->delete();
            }
        }
    }

    public function afterDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        /** @var FileConfig $fileConfig */
        foreach ($this->getConfig('files', []) as $fileConfig) {
            /** @var FileContainer|null|mixed $column */
            $column = $entity->{$fileConfig->getColumn()};
            if ($column instanceof FileContainer) {
                $column->delete();
            }
        }
    }
}
