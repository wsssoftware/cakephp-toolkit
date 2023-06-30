<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Toolkit\View\Helper\ApexChartsHelper;

/**
 * Toolkit\View\Helper\ApexChars Helper Test Case
 */
class ApexCharsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Toolkit\View\Helper\ApexChartsHelper
     */
    protected $Apexchars;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Apexchars = new ApexChartsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Apexchars);

        parent::tearDown();
    }
}
