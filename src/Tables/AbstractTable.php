<?php
declare(strict_types = 1);


namespace Toolkit\Tables;


use Cake\Datasource\ModelAwareTrait;
use Cake\Datasource\ResultSetInterface;
use Cake\Error\FatalErrorException;
use Cake\ORM\Association;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Entity;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Cake\View\View;
use InvalidArgumentException;
use ReflectionClass;
use Toolkit\View\Helper\TablesHelper;

abstract class AbstractTable
{
    use LocatorAwareTrait;
    use ModelAwareTrait;

    /**
     * Holds a cached list of getters/setters per class
     *
     * @var array
     */
    protected static array $_accessors = [];

    /**
     * @var \Cake\View\View
     */
    protected View $_view;

    /**
     * @var int
     */
    protected int $_bootstrapVersion = 4;

    /**
     * @var array
     */
    protected array $_helpers = [];

    /**
     * @var \Cake\ORM\Entity
     */
    protected Entity $_currentEntity;

    protected array $_currentTdAttributes;

    /**
     * @var string|null
     */
    protected ?string $_repositoryName = null;

    protected Table $_repository;

    /**
     * @var Column[]
     */
    protected array $_columns = [];

    /**
     * @var array
     */
    protected array $_tableAttributes = [];

    /**
     * @var string|null
     */
    protected ?string $_tableTitle = null;

    /**
     * @var array
     */
    protected array $_tableTitleAttributes = [];

    /**
     * @var string|null
     */
    protected ?string $_searchPlaceholder = null;

    /**
     * @var \Cake\Datasource\ResultSetInterface
     */
    protected ResultSetInterface $_resultSet;

    /**
     * @var string
     */
    protected string $_loadingText;

    /**
     * @var string
     */
    protected string $_loadingErrorText;

    /**
     * @var int|null
     */
    private ?int $_defaultPageLimit = null;

    private array $_pageLimitOptions = [
        10,
        20,
        50,
        100
    ];

    /**
     * @var string|null
     */
    public ?string $_defaultFilter = null;

    /**
     * @var array
     */
    public array $_filters = [];

    /**
     * TableAbstract constructor.
     */
    public function __construct()
    {
        if (!empty($this->_repositoryName)) {
            $model = $this->_repositoryName;
        } else {
            $model = (new ReflectionClass($this))->getShortName();
        }
        $this->_repository = TableRegistry::getTableLocator()->get($model);

        $this->_loadingText = __('Carregando') . '...';
        $this->_loadingErrorText = __('Algo deu errado ao carregar a tabela! Tente atualizar a página.');
        $this->initialize();
        $this->define();
    }

    /**
     * Initialization hook method.
     *
     * Implement this method to avoid having to overwrite
     * the constructor and call parent.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Define the table configuration
     */
    abstract public function define(): void;

    /**
     * @param string $name
     * @param array $config
     */
    public function loadHelper(string $name, array $config = []): void
    {
        $this->_helpers[] = [
            'name' => $name,
            'config' => $config
        ];
    }

    /**
     * @return \Cake\ORM\Query
     */
    public function getFinalQuery(): Query
    {
        $query = $this->getQuery();
        $model =Inflector::tableize($this->getRepository()->getAlias());
        $filter = Router::getRequest()->getQuery($model . '.filter', false);
        if ($filter === false && $this->getDefaultFilter() !== null) {
            $filter = $this->getDefaultFilter();
        }
        if ($filter !== false && is_string($filter) && !empty($this->_filters[$filter])) {
            $methodName = 'filter' . Inflector::camelize($filter);
            if (!method_exists($this, $methodName)) {
                throw new FatalErrorException(sprintf('You must create the method \'%s\' in your table class.', $methodName));
            }
            $this->{$methodName}($query);
        }

        return $query;
    }

    /**
     * Get the table query
     *
     * @return \Cake\ORM\Query
     */
    abstract public function getQuery(): Query;

    /**
     * @param string $key
     * @param string|null $title
     * @param array $options
     * @param array $attributes
     * @param bool $searchable
     * @param bool $orderable
     * @return $this
     */
    public function addDatabaseColumn(string $key, string|null $title = null, array $options = [], array $attributes = [], bool $searchable = true, bool $orderable = true): self
    {
        $this->_columns[] = new Column($key, $title, $options, $attributes, true, $searchable, $orderable);

        return $this;
    }

    /**
     * @param string $key
     * @param string|null $title
     * @param array $options
     * @param array $attributes
     * @return $this
     */
    public function addNonDatabaseColumn(string $key, string|null $title = null, array $options = [], array $attributes = []): self
    {
        $this->_columns[] = new Column($key, $title, $options, $attributes, false);

        return $this;
    }

    public function getScope(): string
    {
        $reflect = new ReflectionClass($this);

        return Inflector::underscore($reflect->getShortName());
    }

    /**
     * @return Column[]
     */
    public function getColumns(): array
    {
        return $this->_columns;
    }

    /**
     * @return \Cake\Datasource\ResultSetInterface
     */
    public function getResultSet(): ResultSetInterface
    {
        return $this->_resultSet;
    }

    /**
     * @param \Cake\Datasource\ResultSetInterface $resultSet
     * @internal You shouldn't use this method.
     */
    public function setResultSet(ResultSetInterface $resultSet): void
    {
        $this->_resultSet = $resultSet;
    }

    /**
     * @return string
     */
    public function getLoadingText(): string
    {
        return $this->_loadingText;
    }

    /**
     * @param string $loadingText
     * @return self
     */
    public function setLoadingText(string $loadingText): self
    {
        $this->_loadingText = $loadingText;

        return $this;
    }

    /**
     * @return string
     */
    public function getLoadingErrorText(): string
    {
        return $this->_loadingErrorText;
    }

    /**
     * @param string $loadingErrorText
     * @return self
     */
    public function setLoadingErrorText(string $loadingErrorText): self
    {
        $this->_loadingErrorText = $loadingErrorText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDefaultFilter(): ?string
    {
        return $this->_defaultFilter;
    }

    /**
     * @param string|null $defaultFilter
     * @return self
     */
    public function setDefaultFilter(?string $defaultFilter): self
    {
        $this->_defaultFilter = $defaultFilter;
        if (empty($this->_filters)) {
            throw new FatalErrorException('You must to set filters before use this method');
        }
        if (empty($this->_filters[$defaultFilter])) {
            throw new FatalErrorException('You must to set a configured filter.');
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->_filters;
    }

    /**
     * @param array $filters
     * @return self
     */
    public function setFilters(array $filters): self
    {
        foreach ($filters as $key => $filter) {
            if (!is_string($key)) {
                throw new FatalErrorException('Filter name must to be a string.');
            }
            if (!is_string($filter)) {
                throw new FatalErrorException('Filter label must to be a string.');
            }
        }
        asort($filters);
        $this->_filters = $filters;

        return $this;
    }

    /**
     * @return array
     */
    public function getPageLimitOptions(): array
    {
        if (!empty($this->_defaultPageLimit) && !in_array($this->_defaultPageLimit, $this->_pageLimitOptions)) {
            $this->_pageLimitOptions[] = $this->_defaultPageLimit;
        }
        sort($this->_pageLimitOptions);

        return $this->_pageLimitOptions;
    }

    /**
     * @param array|int[] $_pageLimitOptions
     * @return self
     */
    public function setPageLimitOptions(array $_pageLimitOptions): self
    {
        if (empty($_pageLimitOptions)) {
            throw new FatalErrorException('You can\'t pass a empty array to page limit options.');
        }
        foreach ($_pageLimitOptions as $pageLimitOption) {
            if (!is_int($pageLimitOption) || $pageLimitOption <= 0) {
                throw new FatalErrorException('Page limit options must to be a array of positive integers.');
            }
        }
        sort($_pageLimitOptions);
        $this->_pageLimitOptions = $_pageLimitOptions;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultPageLimit(): ?int
    {
        return $this->_defaultPageLimit;
    }

    /**
     * @param int|null $defaultPageLimit
     * @return self
     */
    public function setDefaultPageLimit(?int $defaultPageLimit): self
    {
        $this->_defaultPageLimit = $defaultPageLimit;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTableTitle(): ?string
    {
        return $this->_tableTitle;
    }

    /**
     * @param string $tableTile
     * @param array $tableTileAttributes
     * @return $this;
     */
    public function setTableTitle(string $tableTile, array $tableTileAttributes = []): self
    {
        $this->_tableTitle = $tableTile;
        $this->_tableTitleAttributes = $tableTileAttributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getTableTitleAttributes(): array
    {
        return $this->_tableTitleAttributes;
    }

    /**
     * @return string|null
     */
    public function getSearchPlaceholder(): ?string
    {
        return $this->_searchPlaceholder;
    }

    /**
     * @param string|null $searchPlaceholder
     * @return self
     */
    public function setSearchPlaceholder(?string $searchPlaceholder): self
    {
        $this->_searchPlaceholder = $searchPlaceholder;

        return $this;
    }

    /**
     * @return array
     */
    public function getTableAttributes(): array
    {
        return $this->_tableAttributes;
    }

    /**
     * @param array $tableAttributes
     * @return self
     */
    public function setTableAttributes(array $tableAttributes): self
    {
        $this->_tableAttributes = $tableAttributes;

        return $this;
    }

    /**
     * @param \Cake\View\View $view
     * @internal You shouldn't use this method.
     */
    public function setView(View $view): void
    {
        $this->_view = $view;
        if (!empty($this->_view->Tables) && $this->_view->Tables instanceof TablesHelper) {
            $this->_view->Tables->setConfig('bootstrap', $this->_bootstrapVersion);
        }
        foreach ($this->_helpers as $helper) {
            $this->_view->loadHelper(Hash::get($helper, 'name'), Hash::get($helper, 'config'));
        }
    }

    /**
     * @param int $bootstrapVersion
     */
    public function setBootstrapVersion(int $bootstrapVersion): void
    {
        $this->_bootstrapVersion = $bootstrapVersion;
    }

    /**
     * @param \Cake\ORM\Entity $currentEntity
     * @internal You shouldn't use this method.
     */
    public function setCurrentEntity(Entity $currentEntity): void
    {
        $this->_currentEntity = $currentEntity;
    }

    /**
     * @return array
     */
    public function getCurrentTdAttributes(): array
    {
        return $this->_currentTdAttributes;
    }

    /**
     * Magic getter to access fields that have been set in this entity
     *
     * @param string $field Name of the field to access
     * @return mixed
     */
    public function &__get(string $field)
    {
        return $this->get($field);
    }

    /**
     * Returns the value of a field by name
     *
     * @param string $field the name of the field to retrieve
     * @return mixed
     * @throws \InvalidArgumentException if an empty field name is passed
     * @internal You shouldn't use this method.
     */
    public function &get(string $field)
    {
        if ($field === '') {
            throw new InvalidArgumentException('Cannot get an empty field');
        }
        if (empty($this->_currentEntity)) {
            throw new InvalidArgumentException('You net set a entity before');
        }
        if (substr($field, 0, 6) !== 'column' && is_numeric(substr($field, 6))) {
            throw new InvalidArgumentException('Magic method can be used only for column values');
        }
        $column = $this->_columns[substr($field, 6)];

        $value = $this->_getEntityValue($column->getKey());
        $method = static::_accessor($field, 'get');


        $this->_currentTdAttributes = [];
        if ($method) {
            $tdAttributes = [];
            $result = $this->{$method}($value, $this->_currentEntity, $tdAttributes);
            $this->_currentTdAttributes = $tdAttributes;

            return $result;
        }

        return $value;
    }

    /**
     * @param string $columnKey
     * @return mixed
     */
    protected function _getEntityValue(string $columnKey): mixed
    {
        $map = explode('.', $columnKey);
        if (count($map) === 1) {
            return $this->_currentEntity->has($map[0]) ? $this->_currentEntity->get($map[0]) : null;
        } elseif (count($map) === 2) {
            $table = $map[0];
            $field = $map[1];
            if ($table === $this->getRepository()->getAlias()) {
                return $this->_currentEntity->has($field) ? $this->_currentEntity->get($field) : null;
            } else {
                $path = $this->_getAssociationPath($this->getRepository(), $map);
                if (!empty($path)) {
                    $entity = $this->_currentEntity;
                    foreach ($path as $pathItem) {
                        if (isset($entity->{$pathItem})) {
                            $entity = $entity->{$pathItem};
                        } else {
                            $entity = null;
                        }
                    }
                    if (isset($entity)) {
                        if (is_array($entity)) {
                            return __n('um item', '{0} itens', count($entity), count($entity));
                        }
                        if ($entity instanceof Entity) {
                            return $entity->has($field) ? $entity->get($field) : null;
                        }
                    }
                }

                return null;
            }
        } else {
            throw new FatalErrorException('Invalid column key');
        }
    }

    /**
     * @return \Cake\ORM\Table
     */
    public function getRepository(): Table
    {
        return $this->_repository;
    }

    /**
     * @param \Cake\ORM\Table $repository
     * @param array $map
     * @return array
     */
    protected function _getAssociationPath(Table $repository, array $map): array
    {
        $table = $map[0];
        $field = $map[1];
        $firstAssociations = $repository->associations();
        foreach ($firstAssociations as $baseAssociation) {
            $firstPath = [];
            $firstPath[] = $this->addAssociationPath($baseAssociation);
            if ($baseAssociation->getAlias() === $table) {
                return $firstPath;
            }
            $secondAssociations = $baseAssociation->associations();
            foreach ($secondAssociations as $secondAssociation) {
                $secondPath = $firstPath;
                $secondPath[] = $this->addAssociationPath($secondAssociation);
                if ($secondAssociation->getAlias() === $table) {
                    return $secondPath;
                }
            }
        }

        return [];
    }

    /**
     * @param \Cake\ORM\Association $association
     * @return string|null
     */
    protected function addAssociationPath(Association $association): ?string
    {
        $alias = Inflector::underscore($association->getAlias());
        if ($association instanceof BelongsTo) {
            return Inflector::singularize($alias);
        }
        if ($association instanceof Association\HasMany) {
            return Inflector::pluralize($alias);
        }

        return null;
    }

    /**
     * Fetch accessor method name
     * Accessor methods (available or not) are cached in $_accessors
     *
     * @param string $property the field name to derive getter name from
     * @param string $type the accessor type ('get' or 'set')
     * @return string method name or empty string (no method available)
     */
    protected static function _accessor(string $property, string $type): string
    {
        $class = static::class;

        if (isset(static::$_accessors[$class][$type][$property])) {
            return static::$_accessors[$class][$type][$property];
        }

        if (!empty(static::$_accessors[$class])) {
            return static::$_accessors[$class][$type][$property] = '';
        }

        if (static::class === AbstractTable::class) {
            return '';
        }
        foreach (get_class_methods($class) as $method) {
            $prefix = substr($method, 1, 3);
            if ($method[0] !== '_' || ($prefix !== 'get' && $prefix !== 'set')) {
                continue;
            }
            $field = lcfirst(substr($method, 4));
            $snakeField = Inflector::underscore($field);
            $titleField = ucfirst($field);
            static::$_accessors[$class][$prefix][$snakeField] = $method;
            static::$_accessors[$class][$prefix][$field] = $method;
            static::$_accessors[$class][$prefix][$titleField] = $method;
        }

        if (!isset(static::$_accessors[$class][$type][$property])) {
            static::$_accessors[$class][$type][$property] = '';
        }

        return static::$_accessors[$class][$type][$property];
    }

}