<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Movie;
use App\User;

class MovieTest extends TestCase
{
    //use DatabaseMigrations;

    protected static $movie;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testMovieAreListedCorrectly()
    {
        factory(Movie::class)->create([
            'title' => 'Movie One',
            'seo_title' => 'movie_one',
            'synopsis' => 'blah',
            'certification' => 'U'
        ]);

        factory(Movie::class)->create([
            'title' => 'Movie Two',
            'seo_title' => 'movie_two',
            'synopsis' => 'blah',
            'certification' => 'U'
        ]);

        $headers = [];

        $response = $this->json('GET', '/api/movies', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'Movie One', 'seo_title' => 'movie_one', 'synopsis' => 'blah', 'certification' => 'U' ],
                [ 'title' => 'Movie Two', 'seo_title' => 'movie_two', 'synopsis' => 'blah', 'certification' => 'U' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'title', 'seo_title', 'synopsis', 'certification', 'created_at', 'updated_at'],
            ]);
    }

    /*public function testsMovieAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/articles/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'title' => 'Lorem', 
                'body' => 'Ipsum' 
            ]);
    }

    public function testsMovieAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', '/api/articles/' . $article->id, [], $headers)
            ->assertStatus(204);
    }*/
}

