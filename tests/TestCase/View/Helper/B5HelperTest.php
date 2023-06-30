<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Toolkit\View\Helper\B5Helper;

/**
 * Toolkit\View\Helper\B5Helper Test Case
 */
class B5HelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Toolkit\View\Helper\B5Helper
     */
    protected $B5;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->B5 = new B5Helper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->B5);

        parent::tearDown();
    }
}
