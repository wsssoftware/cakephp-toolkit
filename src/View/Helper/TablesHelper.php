<?php

declare(strict_types = 1);

namespace Toolkit\View\Helper;

use Toolkit\Tables\AbstractTable;
use Cake\Error\FatalErrorException;
use Cake\Utility\Inflector;
use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

/**
 * Tables helper
 *
 * @property \Cake\View\Helper\PaginatorHelper $Paginator
 */
class TablesHelper extends Helper
{

    use StringTemplateTrait;

    protected $helpers = [
        'Paginator',
    ];

    /**
     * Default config for this helper.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'bootstrap' => 4,
        'autoCss' => true,
        'autoScript' => true,
        'cssBlock' => 'css',
        'scriptBlock' => 'script',
        'templates' => [
            'tableHeader' => '<div class="row justify-content-between">{{info}}{{search}}</div>',
            'tableFooter' => '<div class="row mt-2"><div class="col-12">{{pagination}}</div></div>',
            'mainWrapper' => '<div class="system-table-container"{{attrs}}>{{content}}</div>',
            'tableWrapper' => '{{tableHeader}}<div class="table-responsive">{{loadingError}}{{loading}}{{table}}</div>{{tableFooter}}',
            'loading' => '<div class="table-loading-overlay"><span><i class="fas fa-spinner fa-pulse"></i> {{message}}</span></div>',
            'loadingError' => '<div class="table-loading-error-overlay"><span><i class="fas fa-times"></i> {{message}}</span></div>',
            'table' => '<table{{attrs}}>{{thead}}{{tbody}}</table>',
            'theadTitle' => '<tr><th{{attrs}}>{{title}}</th></tr>',
            'thead' => '<thead>{{theadTitle}}<tr>{{content}}</tr></thead>',
            'th' => '<th{{attrs}}>{{content}}</th>',
            'td' => '<td{{attrs}}>{{content}}</th>',
            'emptyBody' => '<tr><td{{attrs}}>{{content}}</th></tr>',
            'tbody' => '<tbody>{{content}}</tbody>',
            'pageLimitAndFilterItem' => '<a href="{{url}}"{{attrs}}>{{label}}</a>',
            'pageLimitAndFilter4' => '<div class="dropdown"><button type="button" class="btn btn-table dropdown-toggle" id="{{id}}" data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">{{label}} <span class="caret"></span></button><div class="dropdown-menu" aria-labelledby="{{id}}">{{items}}</div></div>',
            'pageLimitAndFilter5' => '<button type="button" class="btn btn-table dropdown-toggle" id="{{id}}" data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">{{label}}</button><div class="dropdown-menu" aria-labelledby="{{id}}">{{items}}</div>',
            'searchInput4' => '<div class="col-12"><div class="input-group"><div class="input-group-append">{{filter}}{{pageLimit}}</div><input type="text" value="{{value}}" data-scope="{{scope}}" id="{{id}}" class="form-control table-search-input" placeholder="{{placeholder}}"></div></div>',
            'searchInput5' => '<div class="col-12"><div class="input-group">{{filter}}{{pageLimit}}<input type="text" value="{{value}}" data-scope="{{scope}}" id="{{id}}" class="form-control table-search-input" placeholder="{{placeholder}}"></div></div>',
            'search' => '<div class="col-sm-12 col-md-12 col-lg-6 col-xl-5"><div class="form-group row mb-2">{{label}}{{input}}</div></div>',
            'info' => '<div class="col-sm-12 col-md-12 col-lg-6 col-xl-7"><div class="d-flex h-100 align-items-end"><p class="mb-1 ml-1">{{content}}</p></div></div>',
            'pagination' => '<nav class="pull-right"><ul class="pagination pagination-sm mb-1">{{first}}{{previous}}{{numbers}}{{next}}{{last}}</ul></nav>',
            'actionButtonContainer' => '<div class="btn-group">{{content}}</div>',
        ]
    ];

    /**
     * @var \Toolkit\Tables\AbstractTable[]
     */
    private array $_tableConfigs = [];

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->_tableConfigs = $this->getView()->get('_tableConfigs', []);
        $this->Paginator->options([
            'url' => [
                'fullBase' => false,
            ]
        ]);
        $templates = $this->Paginator->getTemplates();
        $templates['nextActive'] = '<li class="page-item"><a class="page-link table-filter-link" rel="next" href="{{url}}">{{text}}</a></li>';
        $templates['nextDisabled'] = '<li class="page-item disabled"><a class="page-link table-filter-link" href="" onclick="return false;">{{text}}</a></li>';
        $templates['prevActive'] = '<li class="page-item"><a class="page-link table-filter-link" rel="prev" href="{{url}}">{{text}}</a></li>';
        $templates['prevDisabled'] = '<li class="page-item disabled"><a class="page-link table-filter-link" href="" onclick="return false;">{{text}}</a></li>';
        $templates['first'] = '<li class="page-item"><a class="page-link table-filter-link" href="{{url}}">{{text}}</a></li>';
        $templates['last'] = '<li class="page-item"><a class="page-link table-filter-link" href="{{url}}">{{text}}</a></li>';
        $templates['number'] = '<li class="page-item"><a class="page-link table-filter-link" href="{{url}}">{{text}}</a></li>';
        $templates['current'] = '<li class="page-item active"><a class="page-link table-filter-link" href="">{{text}}</a></li>';
        $templates['ellipsis'] = '<li class="page-item disabled"><a class="page-link table-filter-link" href="" onclick="return false;"><i class="fad fa-ellipsis-h"></i></a></li>';
        $templates['sort'] = '<a class="table-filter-link" href="{{url}}">{{text}}</a>';
        $templates['sortAsc'] = '<a class="asc table-filter-link" href="{{url}}">{{text}}</a>';
        $templates['sortDesc'] = '<a class="desc table-filter-link" href="{{url}}">{{text}}</a>';
        $templates['sortAscLocked'] = '<a class="asc locked table-filter-link" href="{{url}}">{{text}}</a>';
        $templates['sortDescLocked'] = '<a class="desc locked table-filter-link" href="{{url}}">{{text}}</a>';

        $this->Paginator->setTemplates($templates);
    }


    /**
     * @param array $fallbackUrl
     * @return array
     */
    public function getLastUrl(array $fallbackUrl = []): array {
        $url = $this->getView()->getRequest()->getSession()->read('Toolkit.tables.lastUrl', false);
        if (!$url) {
            return $fallbackUrl;
        }
        return $url;
    }

    public function renderTable(string $tableName): string
    {
        $tableName = Inflector::underscore($tableName);
        if (empty($this->_tableConfigs[$tableName])) {
            throw new FatalErrorException('Table model not found.');
        }
        $table = $this->_tableConfigs[$tableName];
        $this->Paginator->options([
            'model' => $table->getRepository()->getAlias(),
            'scope' => $table->getScope()
        ]);
        $baseClass = [
            'table',
            'table-bordered',
            'table-striped',
            'table-hover',
            'mb-0',
            'system-table',
        ];
        $table->setView($this->getView());
        $tableAttributes = $table->getTableAttributes();
        $tableAttributes['class'] = !empty($tableAttributes['class']) ? implode(' ', $baseClass) . ' ' . $tableAttributes['class'] : implode(' ', $baseClass);
        $tableContent = $this->formatTemplate('table', [
            'attrs' => $this->templater()->formatAttributes($tableAttributes),
            'thead' => $this->_getTableHead($table),
            'tbody' => $this->_getTableBody($table),
        ]);
        $tableWrapper = $this->formatTemplate('tableWrapper', [
            'loading' => $this->formatTemplate('loading', [
                'message' => $table->getLoadingText(),
            ]),
            'loadingError' => $this->formatTemplate('loadingError', [
                'message' => $table->getLoadingErrorText(),
            ]),
            'tableHeader' => $this->_getTableHeader($table),
            'table' => $tableContent,
            'tableFooter' => $this->_getTableFooter($table),
        ]);
        if ($this->getView()->getRequest()->is('ajax')) {
            return $tableWrapper;
        } else {
            if ($this->getConfig('autoCss', true)) {
                $this->getView()->Html->css('Toolkit.table.min.css', ['block' => $this->getConfig('cssBlock')]);
            }
            if ($this->getConfig('autoScript', true)) {
                $this->getView()->Html->script('Toolkit.table.min.js', ['block' => $this->getConfig('scriptBlock')]);
            }
        }

        $mainWrapperAttributes = [
            'id' => $table->getRepository()->getAlias() . 'Table',
        ];

        return $this->formatTemplate('mainWrapper', [
            'attrs' => $this->templater()->formatAttributes($mainWrapperAttributes),
            'content' => $tableWrapper,
        ]);
    }

    /**
     * @param \Toolkit\Tables\AbstractTable $table
     * @return string
     */
    private function _getTableHead(AbstractTable $table): string
    {
        $content = '';
        $query = $this->getView()->getRequest()->getQuery($table->getScope() . '.query', false);
        foreach ($table->getColumns() as $column) {
            $columnAttributes = $column->getAttributes();
            if ($column->isDatabase() && $column->isOrderable()) {
                $columnOptions = $column->getOptions() + ['fullBase' => true];
                $filter = $this->getFilterName($table);
                $tmpScopeName = 'AAABBB' . $table->getScope() . 'AAABBB';
                if ($query !== false) {
                    $columnOptions['url']['?'][$tmpScopeName]['query'] = $query;
                }
                if (!empty($filter)) {
                    $columnOptions['url']['?'][$tmpScopeName]['filter'] = $filter;
                }
                $columnContent = $this->Paginator->sort($column->getKey(), $column->getTitle(), $columnOptions);
                $columnContent = str_replace($tmpScopeName, $table->getScope(), $columnContent);

                if (str_contains($columnContent, '"asc"') || str_contains($columnContent, 'asc ') || str_contains($columnContent, ' asc')) {
                    $columnAttributes['class'] = !empty($columnAttributes['class']) ? 'th-asc ' . $columnAttributes['class'] : 'th-asc';
                }
                if (str_contains($columnContent, '"desc"') || str_contains($columnContent, 'desc ') || str_contains($columnContent, ' desc')) {
                    $columnAttributes['class'] = !empty($columnAttributes['class']) ? 'th-desc ' . $columnAttributes['class'] : 'th-desc';
                }
            } else {
                $columnContent = $column->getTitle();
            }
            $content .= $this->formatTemplate('th', [
                'content' => $columnContent,
                'attrs' => $this->templater()->formatAttributes($columnAttributes)
            ]);
        }
        $theadTitle = '';
        if (!empty($table->getTableTitle())) {
            $tableTitleAttributes = $table->getTableTitleAttributes();
            $tableTitleAttributes['colspan'] = count($table->getColumns());
            $tableTitleAttributes['class'] = !empty($tableTitleAttributes['class']) ? 'table-title ' . $tableTitleAttributes['class'] : 'table-title';
            $theadTitle = $this->formatTemplate('theadTitle', [
                'title' => $table->getTableTitle(),
                'attrs' => $this->templater()->formatAttributes($tableTitleAttributes),
            ]);
        }

        return $this->formatTemplate('thead', [
            'content' => $content,
            'theadTitle' => $theadTitle
        ]);
    }

    /**
     * @param \Toolkit\Tables\AbstractTable $table
     * @return string
     */
    private function _getTableBody(AbstractTable $table): string
    {
        $tbodyContent = '';
        if ($table->getResultSet()->count() === 0) {
            $emptyAttributes = [
                'colspan' => count($table->getColumns()),
                'class' => 'no-records'
            ];
            $tbodyContent .= $this->formatTemplate('emptyBody', [
                'attrs' => $this->templater()->formatAttributes($emptyAttributes),
                'content' => '<i class="fad fa-empty-set"></i> ' . __('Nenhum registro encontrado')
            ]);
        } else {
            foreach ($table->getResultSet() as $entity) {
                $table->setCurrentEntity($entity);
                $tbodyContent .= '<tr>';
                foreach ($table->getColumns() as $index => $column) {
                    $columnName = 'column' . $index;
                    $tbodyContent .= $this->formatTemplate('td', [
                        'content' => $table->{$columnName},
                        'attrs' => $this->templater()->formatAttributes($table->getCurrentTdAttributes())
                    ]);
                }
                $tbodyContent .= '</tr>';
            }
        }

        return $this->formatTemplate('tbody', [
            'content' => $tbodyContent,
        ]);
    }

    /**
     * @param \Toolkit\Tables\AbstractTable $table
     * @return string
     */
    private function _getTableHeader(AbstractTable $table): string
    {
        $pageLimitAndFilterBootstrap = 'pageLimitAndFilter' . $this->getConfig('bootstrap');
        $searchInputBootstrap = 'searchInput' . $this->getConfig('bootstrap');
        $info = $this->formatTemplate('info', [
            'content' => $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registros de um total de {{count}}'), [
                'model' => $table->getRepository()->getAlias(),
                'scope' => $table->getScope()
            ])
        ]);
        $currentPageLimit = (int)$this->Paginator->param('perPage', $table->getRepository()->getAlias());
        $currentPageLimitLabel = __n('{0} item por página', '{0} itens por página', $currentPageLimit, $currentPageLimit);
        $pageLimitItems = '';
        $pageLimitOptions = $table->getPageLimitOptions();
        $pageLimitOptions = in_array($currentPageLimit, $pageLimitOptions) ? $pageLimitOptions : array_merge($pageLimitOptions, [$currentPageLimit]);
        sort($pageLimitOptions);
        foreach ($pageLimitOptions as $pageLimitOption) {
            $options = [
                'class' => 'dropdown-item table-filter-link',
            ];
            $url = $this->Paginator->generateUrl(['limit' => $pageLimitOption, 'page' => 1], $table->getRepository()->getAlias());
            if ($pageLimitOption === $currentPageLimit) {
                $options['class'] .= ' active';
                $url = 'javascript:void(0);';
            }
            $pageLimitItems .= $this->formatTemplate('pageLimitAndFilterItem', [
                'url' => $url,
                'label' => __n('{0} item por página', '{0} itens por página', $pageLimitOption, $pageLimitOption),
                'attrs' => $this->templater()->formatAttributes($options),
            ]);
        }
        $pageLimit = $this->formatTemplate($pageLimitAndFilterBootstrap, [
            'id' => Inflector::dasherize($table->getRepository()->getAlias()) . '-page-limit-dropdown',
            'label' => $currentPageLimitLabel,
            'items' => $pageLimitItems,
        ]);
        $filter = null;
        if (!empty($table->getFilters())) {
            $currentFilter = $this->getView()->getRequest()->getQuery(Inflector::tableize($table->getRepository()->getAlias()) . '.filter', -1);
            if ($currentFilter === -1 && $table->getDefaultFilter() !== null) {
                $currentFilter = $table->getDefaultFilter();

            }
            if ($table->getDefaultFilter() !== null) {
                $filters = $table->getFilters();
            } else {
                $filters = [-1 => __('Nenhum')] + $table->getFilters();
            }
            $filterItems = '';
            foreach ($filters as $filter => $filterLabel) {
                $options = [
                    'class' => 'dropdown-item table-filter-link',
                ];
                $url = $this->Paginator->generateUrl(['filter' => $filter, 'page' => 1], $table->getRepository()->getAlias());
                if ($filter === -1) {
                    $url = $this->Paginator->generateUrl(['page' => 1], $table->getRepository()->getAlias());
                }
                if ($filter === $currentFilter) {
                    $options['class'] .= ' active';
                    $url = 'javascript:void(0);';
                }
                $filterItems .= $this->formatTemplate('pageLimitAndFilterItem', [
                    'url' => $url,
                    'label' => $filterLabel,
                    'attrs' => $this->templater()->formatAttributes($options),
                ]);
            }
            $filter = $this->formatTemplate($pageLimitAndFilterBootstrap, [
                'id' => Inflector::dasherize($table->getRepository()->getAlias()) . '-filter-dropdown',
                'label' => __('Filtro'),
                'items' => $filterItems,
            ]);
        }
        $currentQuery = $this->getView()->getRequest()->getQuery($table->getScope() . '.query', '');
        $input = $this->formatTemplate($searchInputBootstrap, [
            'value' => $currentQuery,
            'pageLimit' => $pageLimit,
            'filter' => $filter,
            'scope' => $table->getScope(),
            'id' => 'search-input-' . Inflector::dasherize($table->getScope()),
            'placeholder' => !empty($table->getSearchPlaceholder()) ? $table->getSearchPlaceholder() : __('Digite algo para encontrar'),
        ]);
        $search = $this->formatTemplate('search', [
            'input' => $input
        ]);

        return $this->formatTemplate('tableHeader', [
            'info' => $info,
            'search' => $search
        ]);
    }

    /**
     * @param \Toolkit\Tables\AbstractTable $table
     * @return string
     */
    private function _getTableFooter(AbstractTable $table): string
    {
        $default = [
            'escape' => false,
            'fullBase' => true,
            'model' => $table->getRepository()->getAlias(),
        ];
        $hiddenOnSmall = '<span class="d-none d-lg-inline">%s</span>';
        $query = $this->getView()->getRequest()->getQuery($table->getScope() . '.query', false);
        $tmpScopeName = 'AAABBB' . $table->getScope() . 'AAABBB';
        if ($query !== false) {
            $default['url']['?'][$tmpScopeName]['query'] = $query;
        }
        $filter = $this->getFilterName($table);
        if (!empty($filter)) {
            $default['url']['?'][$tmpScopeName]['filter'] = $filter;
        }
        $pagination = $this->formatTemplate('pagination', [
            'first' => $this->Paginator->first('<i class="fad fa-arrow-to-left"></i>' . sprintf($hiddenOnSmall, ' ' . __('Primeiro')), $default),
            'previous' => $this->Paginator->prev('<i class="fad fa-arrow-left"></i>' . sprintf($hiddenOnSmall, ' ' . __('Anterior')), $default),
            'numbers' => $this->Paginator->numbers($default + ['modulus' => 2, 'first' => 2, 'last' => 2]),
            'next' => $this->Paginator->next(sprintf($hiddenOnSmall, __('Próximo') . ' ') . '<i class="fad fa-arrow-right"></i>', $default),
            'last' => $this->Paginator->last(sprintf($hiddenOnSmall, __('Último') . ' ') . ' <i class="fad fa-arrow-to-right"></i>', $default),
        ]);
        $pagination = str_replace($tmpScopeName, $table->getScope(), $pagination);

        return $this->formatTemplate('tableFooter', [
            'pagination' => $pagination,
        ]);
    }

    protected function getFilterName(AbstractTable $table): ?string
    {
        $model = Inflector::tableize($table->getRepository()->getAlias());
        return $this->getView()->getRequest()->getQuery("{$model}.filter", null);
    }

    /**
     * @param array|string|int $url
     * @param array $options
     * @return string
     */
    public function buttonEdit(array|string|int $url = [], array $options = []): string
    {
        if (!is_array($url)) {
            $url = [
                'action' => 'edit',
                $url
            ];
        }
        $options['class'] = !empty($options['class']) ? $options['class'] : 'btn btn-xs btn-warning';
        $options['escape'] = !empty($options['escape']) ? $options['escape'] : false;

        return $this->getView()->Html->link('<i class="fa fa-edit"></i> ' . __('Editar'), $url, $options);
    }

    /**
     * @param array|string|int $url
     * @param array $options
     * @return string
     */
    public function buttonDelete(array|string|int $url = [], array $options = []): string
    {
        if (!is_array($url)) {
            $url = [
                'action' => 'delete',
                $url
            ];
        }
        $options['class'] = !empty($options['class']) ? $options['class'] : 'btn btn-xs btn-danger';
        $options['escape'] = !empty($options['escape']) ? $options['escape'] : false;
        if (empty($options['confirm'])) {
            $options['confirm'] = __('Você tem certeza que deseja apagar esse registro?');
        }

        return $this->getView()->Form->postLink('<i class="fa fa-trash"></i> ' . __('Deletar'), $url, $options);
    }

    /**
     * @param string $title
     * @param array $url
     * @param string $type
     * @param array $options
     * @return string
     */
    public function button(string $title, array $url, string $type, array $options = []): string
    {
        $options['class'] = !empty($options['class']) ? $options['class'] : 'btn btn-xs ' . $type;
        $options['escape'] = !empty($options['escape']) ? $options['escape'] : false;

        return $this->getView()->Html->link($title, $url, $options);
    }

    /**
     * @param string|null ...$buttons
     * @return string
     */
    public function actionButtons(?string ...$buttons): string
    {
        $content = '';
        foreach ($buttons as $button) {
            $content .= $button;
        }

        return $this->formatTemplate('actionButtonContainer', [
            'content' => $content,
        ]);
    }

    /**
     * @param array $option
     */
    private function _setFilterLinkClass(array &$option): void
    {
        $option['class'] = !empty($option['class']) ? $option['class'] . ' table-filter-link' : 'table-filter-link';
    }

}
