<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;
use App\Models\WantMovie;

class EditMovieTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_編集対象の映画を取得する()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a movie for the user
        $movie = WantMovie::factory()->create(['user_id' => $user->id]);

        // Make a request to get the movie to edit
        $response = $this->actingAs($user)->get('/api/edit?id=' . $movie->id);

        // Assert that the response has status 200
        $response->assertStatus(Response::HTTP_OK);

        // Assert that the movie poster path has been modified
        $response->assertJsonFragment([
            'poster_path' => str_replace("342", "154", $movie->poster_path),
        ]);
    }
}
