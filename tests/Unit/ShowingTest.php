<?php

namespace Tests\Unit;

use App\Showing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowingTest extends TestCase
{
    protected static $showing;

    public function setUp(): void
    {
        parent::setUp();

        // Set up dependant foreign keys
        $movie1 = factory(\App\Movie::class)->create();
        $movie2 = factory(\App\Movie::class)->create();

        // Set up test data
        $this->test_data = array(
            [
                'movie_id' => $movie1->id,
                'start_at' => "2020-06-14 12:56:00",
            ],
            [
                'movie_id' => $movie2->id,
                'start_at' => "2020-06-14 15:56:00",
            ]
        );
    }

    public function testShowingsAreListedCorrectly()
    {
        factory(Showing::class)->create($this->test_data[0]);
        factory(Showing::class)->create($this->test_data[1]);

        $response = $this->json('GET', '/api/showings', [])
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'movie_id', 'start_at', 'created_at', 'updated_at'],
            ]);
    }

    public function testShowingsAreCreatedCorrectly()
    {
        $response = $this->call('POST', '/api/showings', $this->test_data[0])
            ->assertStatus(201);
    }

    public function testShowingsAreUpdatedCorrectly()
    {
        $showing = factory(Showing::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/showings/' . $showing->id, $payload)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testShowingsAreDeletedCorrectly()
    {
        $showing = factory(Showing::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/showings/' . $showing->id, [])
            ->assertStatus(204);
    }
}

