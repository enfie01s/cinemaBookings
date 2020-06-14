<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Movie;

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

    public function testMovieAreListedCorrectly()
    {
        factory(Movie::class)->create($this->test_data[0]);
        factory(Movie::class)->create($this->test_data[1]);

        $headers = [];

        $response = $this->json('GET', '/api/movies', [], $headers)
            ->assertStatus(200)
            ->assertJson($this->test_data)
            ->assertJsonStructure([
                '*' => ['id', 'title', 'seo_title', 'synopsis', 'certification', 'created_at', 'updated_at'],
            ]);
    }

    public function testsMovieAreUpdatedCorrectly()
    {
        $headers = [];
        $movie = factory(Movie::class)->create($this->test_data[0]);

        $payload = $this->test_data[0];
        $assert_data = array('id' => 1) + $payload;

        $response = $this->json('PUT', '/api/movies/' . $movie->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson($assert_data);
    }

    public function testsMovieAreDeletedCorrectly()
    {
        $headers = [];
        $movie = factory(Movie::class)->create($this->test_data[0]);

        $this->json('DELETE', '/api/movies/' . $movie->id, [], $headers)
            ->assertStatus(204);
    }
}

