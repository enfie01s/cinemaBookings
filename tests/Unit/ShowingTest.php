<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Showing;

class ShowingTest extends TestCase
{
    protected static $showing;

    public function setUp(): void
    {
        parent::setUp();
        $movie1 = factory(\App\Movie::class)->create();
        $movie2 = factory(\App\Movie::class)->create();
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

    public function testShowingAreListedCorrectly()
    {
        factory(Showing::class)->create($this->test_data[0]);
        factory(Showing::class)->create($this->test_data[1]);

        $headers = [];

        $response = $this->json('GET', '/api/showings', [], $headers)
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'movie_id', 'start_at', 'created_at', 'updated_at'],
            ]);
    }

    public function testsShowingAreUpdatedCorrectly()
    {
        $headers = [];
        $showing = factory(Showing::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/showings/' . $showing->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testsShowingAreDeletedCorrectly()
    {
        $headers = [];
        $showing = factory(Showing::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/showings/' . $showing->id, [], $headers)
            ->assertStatus(204);
    }
}

