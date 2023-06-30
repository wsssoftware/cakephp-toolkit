<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Toolkit\Controller\Component\ApexChartsComponent;

/**
 * Toolkit\Controller\Component\ApexcharsComponent Test Case
 */
class ApexCharsComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Toolkit\Controller\Component\ApexChartsComponent
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
        $registry = new ComponentRegistry();
        $this->Apexchars = new ApexChartsComponent($registry);
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
