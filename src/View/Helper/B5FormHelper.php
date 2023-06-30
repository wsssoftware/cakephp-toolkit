<?php
declare(strict_types=1);

namespace Toolkit\View\Helper;

use Cake\Utility\Inflector;
use Cake\View\Form\EntityContext;
use Cake\View\Helper\FormHelper;

/**
 * B5Form helper
 */
class B5FormHelper extends FormHelper
{

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setConfig('errorClass', 'is-invalid');
        $templates = $this->getTemplates();
        $templates['bs5CheckboxWrapper'] = '<div class="form-check {{margin}}">{{input}}{{label}}</div>';
        $templates['bs5CheckboxWrapperError'] = '<div class="form-check {{margin}}">{{input}}{{label}}{{error}}</div>';
        $templates['bs5SwitchWrapper'] = '<div class="form-check form-switch {{margin}}">{{input}}{{label}}</div>';
        $templates['bs5SwitchWrapperError'] = '<div class="form-check form-switch {{margin}}">{{input}}{{label}}{{error}}</div>';
        $templates['bs5CheckboxLabel'] = '<label class="form-check-label" for="{{for}}">{{content}}</label>';
        $templates['checkbox'] = '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>';
        $templates['inputContainer'] = '{{colOpen}}<div class="form-floating mb-3 {{type}}{{required}}">{{content}}</div>{{colClose}}';
        $templates['inputContainerError'] = '{{colOpen}}<div class="form-floating mb-3 {{type}}{{required}}">{{content}}{{error}}</div>{{colClose}}';
        $templates['formGroup'] = '{{input}}{{label}}';
        $templates['error'] = '<div class="invalid-feedback">{{content}}</div>';
        $templates['errorList'] = '<ul role="list">{{content}}</ul>';
        $this->setTemplates($templates);
    }

    /**
     * @inheritDoc
     */
    public function control(string $fieldName, array $options = []): string
    {
        $options['placeholder'] = !empty($options['label']) ? $options['label'] : Inflector::humanize(Inflector::underscore($fieldName));
        $options['class'] = !empty($options['class']) ? explode(' ', $options['class']) : [];
        $options['class'][] = 'form-control';

        if (!empty($options['col'])) {
            $options['templateVars']['colOpen'] = '<div class="' . $options['col'] . '">';
            $options['templateVars']['colClose'] = '</div>';
            unset($options['col']);
        }

        $entity = $this->_getContext();
        if ($entity instanceof EntityContext && $entity->entity()->hasErrors()) {
            if (!$this->isFieldError($fieldName)) {
                $options['class'][] = 'is-valid';
            }
        }
        if (!empty($options['help']) && is_string($options['help'])) {
            $options['data-bs-toggle'] = 'tooltip';
            $options['title'] = $options['help'];
        }
        $options['class'] = implode(' ', $options['class']);
        return parent::control($fieldName, $options);
    }

    /**
     * @param string $fieldName
     * @param array $options
     * @return string
     */
    public function defaultCheckbox(string $fieldName, array $options = []): string
    {
        return parent::checkbox($fieldName, $options);
    }

    /**
     * @inheritDoc
     */
    public function checkbox(string $fieldName, array $options = []): string
    {
        $id = $this->_domId($fieldName);
        $options += [
            'margin' => 'mb-3',
        ];
        $margin = $options['margin'];
        $margin = $margin === false ? '' : $margin;
        unset($options['margin']);
        $options['label'] = !empty($options['label']) ? $options['label'] : Inflector::humanize(Inflector::underscore($fieldName));
        $options['id'] = $id;
        $options['class'] = !empty($options['class']) ? explode(' ', $options['class']) : [];
        $options['class'][] = 'form-check-input';
        $checkbox = parent::checkbox($fieldName, $options);
        $labelString = $options['label'];
        if (!empty($options['help']) && is_string($options['help'])) {
            $helpTitle = $options['help'];
            $labelString .= " <i class='fa-duotone fa-circle-question text-info-600' data-bs-toggle='tooltip' title='$helpTitle'></i>";
        }
        $label = $this->templater()->format('bs5CheckboxLabel', ['for' => $id, 'content' => $labelString]);
        $error = $this->isFieldError($fieldName) ? $this->error($fieldName) : '';
        $templateName = $this->isFieldError($fieldName) ?  'bs5CheckboxWrapperError' : 'bs5CheckboxWrapper';

        return $this->templater()->format($templateName, [
            'margin' => $margin,
            'input' => $checkbox,
            'label' => $label,
            'error' => $error,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function switch(string $fieldName, array $options = []): string
    {
        $id = $this->_domId($fieldName);
        $options += [
            'margin' => 'mb-3',
        ];
        $margin = $options['margin'];
        $margin = $margin === false ? '' : $margin;
        unset($options['margin']);
        $options['label'] = !empty($options['label']) ? $options['label'] : Inflector::humanize(Inflector::underscore($fieldName));
        $options['id'] = $id;
        $options['class'] = !empty($options['class']) ? explode(' ', $options['class']) : [];
        $options['class'][] = 'form-check-input';
        $checkbox = parent::checkbox($fieldName, $options);
        $labelString = $options['label'];
        if (!empty($options['help']) && is_string($options['help'])) {
            $helpTitle = $options['help'];
            $labelString .= " <i class='fa-duotone fa-circle-question text-info-600' data-bs-toggle='tooltip' title='$helpTitle'></i>";
        }
        $label = $this->templater()->format('bs5CheckboxLabel', ['for' => $id, 'content' => $labelString]);
        $error = $this->isFieldError($fieldName) ? $this->error($fieldName) : '';
        $templateName = $this->isFieldError($fieldName) ?  'bs5SwitchWrapperError' : 'bs5SwitchWrapper';

        return $this->templater()->format($templateName, [
            'margin' => $margin,
            'input' => $checkbox,
            'label' => $label,
            'error' => $error,
        ]);
    }

    /**
     * @param string $title
     * @param array $options
     * @return string
     */
    public function submitButton(string $title, array $options = []): string
    {
        $class = !empty($options['class']) ? explode(' ', $options['class']) : [];
        $class[] = 'btn';
        $class[] = 'd-block';
        $class[] = 'fw-500';
        $options += [
            'disableOnSubmit' => true,
            'type' => 'submit',
            'btn-type' => 'primary',
            'btn-size' => 'lg',
            'margin-bottom' => 3,
            'full-width' => true,
            'fa' => 'fa-duotone fa-floppy-disk',
            'data-loading-text' => __('Salvando...'),
            'data-loading-fa' => null,
            'data-loading-fa-animation' => 'fa-flip',
        ];
        if ($options['disableOnSubmit'] !== false) {
            $options['onclick'] = 'Toolkit.b5form.disableSubmit(this);';
        }
        if (empty($options['data-loading-fa']) && !empty($options['fa'])) {
            $options['data-loading-fa'] = $options['fa'];
        }
        $class[] = "btn-{$options['btn-type']}";
        $class[] = "btn-{$options['btn-size']}";
        $class[] = "mb-{$options['margin-bottom']}";
        if ($options['full-width'] === true) {
            $class[] = 'w-100';
        }
        $options['escapeTitle'] = false;
        if (!empty($options['fa']) && $options['fa'] !== false) {
            $title = "<i class='{$options['fa']}'></i> " . $title;
        }
        unset($options['disableOnSubmit']);
        unset($options['btn-type']);
        unset($options['btn-size']);
        unset($options['margin-bottom']);
        unset($options['full-width']);
        unset($options['fa']);

        $title = "<span>$title</span>";
        $options['class'] = implode(' ', $class);
        return parent::button($title, $options);
    }
}
