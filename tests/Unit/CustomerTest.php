<?php

namespace Tests\Unit;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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

    public function testCustomersAreListedCorrectly()
    {
        factory(Customer::class)->create($this->test_data[0]);
        factory(Customer::class)->create($this->test_data[1]);

        $response = $this->json('GET', '/api/customers', [])
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'email', 'created_at', 'updated_at'],
            ]);
    }

    public function testCustomersAreCreatedCorrectly()
    {
        $response = $this->call('POST', '/api/customers', $this->test_data[0])
            ->assertStatus(201);
    }

    public function testCustomersAreUpdatedCorrectly()
    {
        $customer = factory(Customer::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/customers/' . $customer->id, $payload)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testCustomersAreDeletedCorrectly()
    {
        $customer = factory(Customer::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/customers/' . $customer->id, [])
            ->assertStatus(204);
    }
}

