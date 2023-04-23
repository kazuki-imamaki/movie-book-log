<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WantMovie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test deleting a movie.
     *
     * @return void
     */
    public function testDeleteMovie()
    {
        $user = User::factory()->create();
        $movie = WantMovie::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/api/delete', ['id' => $movie->id]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertModelMissing($movie);
    }

    /**
     * Test deleting a non-existent movie.
     *
     * @return void
     */
    public function testDeleteNonExistentMovie()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/delete', ['id' => 999]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * Test deleting a movie without authentication.
     *
     * @return void
     */
    public function testDeleteMovieWithoutAuthentication()
    {
        $user = User::factory()->create();

        $movie = WantMovie::factory()->create(['user_id' => $user->id]);

        $response = $this->post('/api/delete', ['id' => $movie->id]);

        // $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/login');
    }
}
