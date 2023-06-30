<?php
declare(strict_types=1);

namespace Toolkit\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Toolkit\Model\Table\SmsLogsTable;

/**
 * Toolkit\Model\Table\SmsLogsTable Test Case
 */
class SmsLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Toolkit\Model\Table\SmsLogsTable
     */
    protected $SmsLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Toolkit.SmsLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SmsLogs') ? [] : ['className' => SmsLogsTable::class];
        $this->SmsLogs = $this->getTableLocator()->get('SmsLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SmsLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
