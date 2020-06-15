<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Booking;

class BookingTest extends TestCase
{
    protected static $showing;

    public function setUp(): void
    {
        parent::setUp();

        // Set up dependant foreign keys
        $movie1 = factory(\App\Movie::class)->create();
        $customer1 = factory(\App\Customer::class)->create();
        $customer2 = factory(\App\Customer::class)->create();
        $showing1 = factory(\App\Showing::class)->create([
            'movie_id' => $movie1->id,
            'start_at' => "2020-06-14 12:56:00",
        ]);
        $showing2 = factory(\App\Showing::class)->create([
            'movie_id' => $movie1->id,
            'start_at' => "2020-06-14 15:56:00",
        ]);

        // Set up test data
        $this->test_data = array(
            [
                'customer_id' => $customer1->id,
                'showing_id' => $showing1->id,
                'seats' => json_encode(['A1','A2'])
            ],
            [
                'customer_id' => $customer2->id,
                'showing_id' => $showing2->id,
                'seats' => json_encode(['A3','A4'])
            ]
        );
    }

    public function testBookingAreListedCorrectly()
    {
        factory(Booking::class)->create($this->test_data[0]);
        factory(Booking::class)->create($this->test_data[1]);

        $headers = [];

        $response = $this->json('GET', '/api/bookings', [], $headers)
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'customer_id', 'showing_id', 'seats', 'created_at', 'updated_at'],
            ]);
    }

    public function testsBookingAreCreatedCorrectly()
    {
        $headers = [];

        $response = $this->call('POST', '/api/bookings', $this->test_data[0], $headers)
            ->assertStatus(201);
    }

    public function testsBookingAreUpdatedCorrectly()
    {
        $headers = [];
        $booking = factory(Booking::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/bookings/' . $booking->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testsBookingAreDeletedCorrectly()
    {
        $headers = [];
        $booking = factory(Booking::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/bookings/' . $booking->id, [], $headers)
            ->assertStatus(204);
    }
}
