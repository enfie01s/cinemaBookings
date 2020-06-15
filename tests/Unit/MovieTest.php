<?php

namespace Tests\Unit;

use App\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieTest extends TestCase
{
    protected static $movie;

    public function setUp(): void
    {
        parent::setUp();
        $this->test_data = array(
            [
                'title' => 'Movie One',
                'seo_title' => 'movie_one',
                'synopsis' => 'blah',
                'certification' => 'U'
            ],
            [
                'title' => 'Movie Two',
                'seo_title' => 'movie_Two',
                'synopsis' => 'blah',
                'certification' => 'U'
            ]
        );
    }

    public function testMoviesAreListedCorrectly()
    {
        factory(Movie::class)->create($this->test_data[0]);
        factory(Movie::class)->create($this->test_data[1]);

        $response = $this->json('GET', '/api/movies', [])
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'title', 'seo_title', 'synopsis', 'certification', 'created_at', 'updated_at'],
            ]);
    }

    public function testMoviesAreCreatedCorrectly()
    {
        $response = $this->call('POST', '/api/movies', $this->test_data[0])
            ->assertStatus(201);
    }

    public function testMoviesAreUpdatedCorrectly()
    {
        $movie = factory(Movie::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/movies/' . $movie->id, $payload)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testMoviesAreDeletedCorrectly()
    {
        $movie = factory(Movie::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/movies/' . $movie->id, [])
            ->assertStatus(204);
    }
}

