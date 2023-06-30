<?php
declare(strict_types = 1);

namespace Toolkit\View\Helper\Traits;

use Cake\Utility\Hash;

/**
 * Trait B5ButtonsTrait
 *
 * @package Toolkit\View\Helper\Traits
 * @method \Cake\View\StringTemplate templater() get templater
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
trait B5ButtonsTrait
{

    public function btnGroupLg(string ...$btn): string
    {
        return $this->_btnGroup('lg', $btn);
    }

    public function btnGroup(string ...$btn): string
    {
        return $this->_btnGroup('md', $btn);
    }

    /**
     * @param string ...$btn
     * @return string
     */
    public function btnGroupSm(string ...$btn): string
    {
        return $this->_btnGroup('sm', $btn);
    }

    /**
     * @param string ...$btn
     * @return string
     */
    public function btnGroupXs(string ...$btn): string
    {
        return $this->_btnGroup('xs', $btn);
    }

    /**
     * @param string $size
     * @param array $buttons
     * @return string
     */
    protected function _btnGroup(string $size, array $buttons): string
    {
        return $this->templater()->format('btnGroup', [
            'size' => match ($size) {
                'lg' => ' btn-group-lg',
                'sm' => ' btn-group-sm',
                'xs' => ' btn-group-xs',
                default => '',
            },
            'aria' => __('Grupo de botões'),
            'content' => implode('', $buttons),
        ]);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnPrimary(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-primary';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnSecondary(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-secondary';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnSuccess(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-success';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnDanger(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-danger';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnWarning(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-warning';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnInfo(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-info';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnLight(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-light';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnDark(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'btn-dark';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnAppPrimary(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'app-btn-primary';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnAppAccent(string $title, array|string $url = null, array $options = []): string
    {
        $class = explode(' ', Hash::get($options, 'class', ''));
        $class[] = 'app-btn-accent';
        return $this->_linkBtn($title, $url, $class, $options);
    }

    /**
     * @param string|null $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnAdd(string $title = null, array|string $url = null, array $options = []): string
    {
        $options += [
            'fa' => 'fa-regular fa-plus',
        ];
        if (empty($title)) {
            $title = __('Adicionar');
        }
        return $this->urlBtnAppPrimary($title, $url, $options);
    }

    /**
     * @param string|null $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnView(string $title = null, array|string $url = null, array $options = []): string
    {
        $options += [
            'fa' => 'fa-regular fa-eye',
        ];
        if (empty($title)) {
            $title = __('Ver');
        }
        return $this->urlBtnSecondary($title, $url, $options);
    }

    /**
     * @param string|null $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnEdit(string $title = null, array|string $url = null, array $options = []): string
    {
        $options += [
            'fa' => 'fa-regular fa-pen',
        ];
        if (empty($title)) {
            $title = __('Editar');
        }
        return $this->urlBtnWarning($title, $url, $options);
    }

    /**
     * @param string|null $title
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public function urlBtnDelete(string $title = null, array|string $url = null, array $options = []): string
    {
        $options += [
            'fa' => 'fa-regular fa-trash-can',
        ];
        if (empty($title)) {
            $title = __('Deletar');
        }
        return $this->urlBtnDanger($title, $url, $options);
    }

    /**
     * @param string $title
     * @param array|string|null $url
     * @param array $class
     * @param array $options
     * @return string
     */
    protected function _linkBtn(string $title, array|string $url = null, array $class = [], array $options = []): string
    {
        $class[] = 'btn';
        $options['class'] = implode(' ', array_unique($class));
        $icon = '';
        if (!empty($options['fa'])) {
            $icon = '<i class="' . $options['fa'] . '"></i> ';
            if (empty($options['escape']) || $options['escape'] === true) {
                $title = h($title);
            }
            $options['escape'] = false;
        }
        if (!empty($options['post']) && $options['post'] === true) {
            unset($options['post']);
            return $this->getView()->Form->postLink($title, $url, $options);
        }
        return $this->Html->link($icon . $title, $url, $options);
    }

}