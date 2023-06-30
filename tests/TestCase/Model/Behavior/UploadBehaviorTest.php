<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\Model\Behavior;

use Cake\ORM\Table;
use Cake\TestSuite\TestCase;
use Toolkit\Model\Behavior\UploadBehavior;

/**
 * WSSCore\Model\Behavior\UploadBehavior Test Case
 */
class UploadBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \WSSCore\Model\Behavior\UploadBehavior
     */
    protected $Upload;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $table = new Table();
        $this->Upload = new UploadBehavior($table);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Upload);

        parent::tearDown();
    }
}
