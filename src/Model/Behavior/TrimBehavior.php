<?php
declare(strict_types=1);

namespace Toolkit\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Table;


/**
 * Trim behavior
 */
class TrimBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param \ArrayObject $data
     */
    public function trim(ArrayObject $data): void
    {
        foreach ($data as $key => $datum) {
            $data[$key] = $this->_trim($datum);
        }
    }

    /**
     * @param string|array|null $data
     * @return array|string|null
     */
    protected function _trim($data = null)
    {
        if (is_array($data)) {
            foreach ($data as $key => $item) {
                $data[$key] = $this->_trim($item);
            }
        } else {
            if (is_string($data)) {
                $data = trim($data);
            }
        }

        return $data;
    }

    /**
     * @param \ArrayObject $data
     */
    protected function removeMasks(ArrayObject $data): void
    {
        $validDigitMaskFields = [
            'phone',
            'cellphone',
            'cpf',
            'cnpj',
            'document',
            'cep',
        ];
        foreach ($data as $key => $datum) {
            if (in_array($key, $validDigitMaskFields)) {
                $data[$key] = preg_replace('/[^0-9]/', '', (string)$datum);
            }
        }
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        $this->trim($data);
        $this->removeMasks($data);
    }
}
