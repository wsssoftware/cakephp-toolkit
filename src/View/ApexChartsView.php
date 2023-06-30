<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.4
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Toolkit\View;

use Cake\Core\Configure;
use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\JsonView;
use Cake\View\View;
use RuntimeException;
use Toolkit\ApexCharts\ApexChart;

/**
 * A view class that is used for AJAX responses.
 * Currently only switches the default layout and sets the response type -
 * which just maps to text/html by default.
 */
class ApexChartsView extends JsonView
{

    /**
     * @param array|string $serialize
     * @return string
     */
    protected function _serialize($serialize): string
    {
        $data = parent::_serialize($serialize);
        return ApexChart::staticReplaceQuotesFromJson($data);
    }
}
