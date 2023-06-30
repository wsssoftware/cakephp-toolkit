<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Toolkit\View\Helper\B5FormHelper;

/**
 * Toolkit\View\Helper\B5FormHelper Test Case
 */
class B5FormHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Toolkit\View\Helper\B5FormHelper
     */
    protected $B5Form;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->B5Form = new B5FormHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->B5Form);

        parent::tearDown();
    }
}
