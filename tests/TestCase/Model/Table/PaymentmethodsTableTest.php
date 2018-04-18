<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentmethodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentmethodsTable Test Case
 */
class PaymentmethodsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentmethodsTable
     */
    public $Paymentmethods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.paymentmethods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Paymentmethods') ? [] : ['className' => 'App\Model\Table\PaymentmethodsTable'];
        $this->Paymentmethods = TableRegistry::get('Paymentmethods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paymentmethods);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
