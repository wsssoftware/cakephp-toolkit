<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\Model\Behavior;

use Cake\ORM\Table;
use Cake\TestSuite\TestCase;
use Toolkit\Model\Behavior\TrimBehavior;

/**
 * Toolkit\Model\Behavior\TrimBehavior Test Case
 */
class TrimBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Toolkit\Model\Behavior\TrimBehavior
     */
    protected $Trim;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $table = new Table();
        $this->Trim = new TrimBehavior($table);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Trim);

        parent::tearDown();
    }
}
