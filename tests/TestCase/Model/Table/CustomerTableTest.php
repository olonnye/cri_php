<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerTable Test Case
 */
class CustomerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var CustomerTable
     */
    protected $Customer;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Customer',
        'app.Kit',
        'app.Description',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Customer') ? [] : ['className' => CustomerTable::class];
        $this->Customer = $this->getTableLocator()->get('Customer', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Customer);

        parent::tearDown();
    }
}
