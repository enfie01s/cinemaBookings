<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Customer;

class CustomerTest extends TestCase
{
    protected static $customer;

    public function setUp(): void
    {
        parent::setUp();
        $this->test_data = array(
            [
                'name' => 'Joe Bloggs',
                'email' => 'jbloggs@domain.net',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane.d@example.net',
            ]
        );
    }

    public function testCustomerAreListedCorrectly()
    {
        factory(Customer::class)->create($this->test_data[0]);
        factory(Customer::class)->create($this->test_data[1]);

        $headers = [];

        $response = $this->json('GET', '/api/customers', [], $headers)
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'email', 'created_at', 'updated_at'],
            ]);
    }

    public function testsCustomerAreCreatedCorrectly()
    {
        $headers = [];

        $response = $this->call('POST', '/api/customers', $this->test_data[0], $headers)
            ->assertStatus(201);
    }

    public function testsCustomerAreUpdatedCorrectly()
    {
        $headers = [];
        $customer = factory(Customer::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/customers/' . $customer->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testsCustomerAreDeletedCorrectly()
    {
        $headers = [];
        $customer = factory(Customer::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/customers/' . $customer->id, [], $headers)
            ->assertStatus(204);
    }
}

