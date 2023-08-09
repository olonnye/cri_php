<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DescriptionTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DescriptionTable Test Case
 */
class DescriptionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DescriptionTable
     */
    protected $Description;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Description',
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
        $config = $this->getTableLocator()->exists('Description') ? [] : ['className' => DescriptionTable::class];
        $this->Description = $this->getTableLocator()->get('Description', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Description);

        parent::tearDown();
    }
}
