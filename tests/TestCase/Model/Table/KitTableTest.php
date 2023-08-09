<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KitTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KitTable Test Case
 */
class KitTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\KitTable
     */
    protected $Kit;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Kit',
        'app.Customer',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Kit') ? [] : ['className' => KitTable::class];
        $this->Kit = $this->getTableLocator()->get('Kit', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Kit);

        parent::tearDown();
    }
}
