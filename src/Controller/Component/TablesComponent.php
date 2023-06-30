<?php

declare(strict_types = 1);

namespace Toolkit\Controller\Component;

use Cake\Routing\Router;
use Toolkit\Tables\AbstractTable;
use Toolkit\View\TableView;
use Cake\Controller\Component;
use Cake\Event\EventManager;

/**
 * Tables component
 *
 * @property \Cake\Controller\Component\PaginatorComponent $Paginator
 */
class TablesComponent extends Component
{

    /**
     * @var string[]
     */
    protected $components = [
        'Paginator'
    ];

    /**
     * @var AbstractTable[]
     */
    protected array $_tableConfigs = [];


    public function initialize(array $config): void
    {
        parent::initialize($config);

        EventManager::instance()->on(
            'Controller.beforeRender',
            function ()
            {
                $this->getController()->set('_tableConfigs', $this->_tableConfigs);
                $this->_setView();
            }
        );
    }

    /**
     *
     */
    private function _setView()
    {
        if (!empty($this->getController()->getRequest()->getHeader('tableUpdate'))) {
            $this->getController()->viewBuilder()->setClassName(TableView::class);
        }
    }

    /**
     * @param array $fallbackUrl
     * @return array
     */
    public function getLastUrl(array $fallbackUrl = []): array {
        $url = $this->getController()->getRequest()->getSession()->read('Toolkit.tables.lastUrl', false);
        if (!$url) {
            return $fallbackUrl;
        }
        return $url;
    }

    /**
     * @param \Toolkit\Tables\AbstractTable $table
     * @param array $settings
     */
    public function paginate(AbstractTable $table, array $settings = []): void
    {
        $request = $this->getController()->getRequest();
        if ($request->getSession()->started()) {
            $currentUrl = Router::reverseToArray($request);
            $request->getSession()->write('Toolkit.tables.lastUrl', $currentUrl);
        }
        if ($this->getConfig('bootstrap', false)) {
            $table->setBootstrapVersion($this->getConfig('bootstrap', 4));
        }
        $settings['scope'] = $table->getScope();
        if ($table->getDefaultPageLimit() !== null) {
            $settings['limit'] = $table->getDefaultPageLimit();
        } else {
            $settings['limit'] = $table->getPageLimitOptions()[array_key_first($table->getPageLimitOptions())];
        }
        $query = $table->getFinalQuery();
        $searchQuery = $this->getController()->getRequest()->getQuery($settings['scope'] . '.query');
        if (!empty($searchQuery)) {
            $searchWhere['OR'] = [];
            foreach ($table->getColumns() as $column) {
                if ($column->isDatabase() && $column->isSearchable()) {
                    switch ($this->_getColumnType($table, $column->getKey())) {
                        case 'datetime':
                            $this->_whereDatetime($searchWhere, $column->getKey(), $searchQuery);
                            break;
                        case 'date':
                            $this->_whereDate($searchWhere, $column->getKey(), $searchQuery);
                            break;
                        default:
                            $this->_whereString($searchWhere, $column->getKey(), $searchQuery);
                    }
                }
            }
            if (!empty($searchWhere['OR'])) {
                $query->where($searchWhere);
            }
        }
        if (!empty($settings['limit'])) {
            $maxLimit = $this->Paginator->getConfig('maxLimit');
            $settings['maxLimit'] = $maxLimit >= $settings['limit'] ? $maxLimit : $settings['limit'];
            $table->setDefaultPageLimit($settings['limit']);
        }
        $table->setResultSet($this->Paginator->paginate($query, $settings));
        $this->_tableConfigs[$table->getScope()] = $table;
    }

    /**
     * @param \Toolkit\Tables\AbstractTable $table
     * @param string $column
     * @return string
     */
    private function _getColumnType(AbstractTable $table, string $column): string
    {
        $repository = $table->getRepository();
        $column = explode('.', $column);
        $table = null;
        $field = null;
        if (count($column) === 1) {
            $table = $repository->getAlias();
            $field = $column[0];
        } elseif (count($column) === 2) {
            $table = $column[0];
            $field = $column[1];
        }
        if ($table === $repository->getAlias()) {
            $schema = $repository->getSchema();
            $type = !empty($schema->getColumn($field)['type']) ? $schema->getColumn($field)['type'] : 'string';
        } else {
            $matchedAssociation = null;
            foreach ($repository->associations() as $firstLevelAssociation) {
                if ($firstLevelAssociation->getAlias() === $table) {
                    $matchedAssociation = $firstLevelAssociation;
                    break;
                }
                foreach ($firstLevelAssociation->associations() as $secondLevelAssociation) {
                    if ($secondLevelAssociation->getAlias() === $table) {
                        $matchedAssociation = $secondLevelAssociation;
                        break;
                    }
                }
                if (!empty($matchedAssociation)) {
                    break;
                }
            }
            if (!empty($matchedAssociation)) {
                $schema = $matchedAssociation->getSchema();
                $type = !empty($schema->getColumn($field)['type']) ? $schema->getColumn($field)['type'] : 'string';
            } else {
                $type = 'string';
            }

        }
        switch ($type) {
            case 'datetime':
                return 'datetime';
            case 'date':
                return 'date';
            default:
                return 'string';
        }
    }

    /**
     * @param array $where
     * @param string $column
     * @param string $search
     * @return void
     */
    private function _whereString(array &$where, string $column, string $search): void
    {
        $where['OR'] += ["CONVERT({$column} ,char) LIKE" => "%$search%"];
    }

    /**
     * @param array $where
     * @param string $column
     * @param string $search
     * @return void
     */
    private function _whereDate(array &$where, string $column, string $search): void
    {
        $where['OR'] += ["CONVERT({$column} ,char) LIKE" => "%$search%"];
        $where['OR'] += ["CONCAT(DAY($column), '/', MONTH($column), '/', YEAR($column)) LIKE" => "%$search%"];
    }

    /**
     * @param array $where
     * @param string $column
     * @param string $search
     * @return void
     */
    private function _whereDatetime(array &$where, string $column, string $search): void
    {
        $where['OR'] += ["CONVERT($column ,char) LIKE" => "%$search%"];
        $where['OR'] += ["CONCAT(DAY($column), '/', MONTH($column), '/', YEAR($column), ' ', HOUR($column), ':', MINUTE($column), ':', SECOND($column)) LIKE" => "%$search%"];
    }


}
