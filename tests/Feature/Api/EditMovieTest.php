<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;
use App\Models\WantMovie;
use App\Models\Image;

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

        // 画像作成
        $image = Image::factory()->create(['name' => "https://example.com/image.jpg"]);

        // Create a movie for the user
        $movie = WantMovie::factory()->create(['user_id' => $user->id, 'images_id' => $image->id]);

        // Make a request to get the movie to edit
        $response = $this->actingAs($user)->get('/api/edit?id=' . $movie->id);

        // Assert that the response has status 200
        $response->assertStatus(Response::HTTP_OK);

        // Assert that the movie poster path has been modified
        $response->assertJsonFragment([
            'id' => $movie->id,
            'user_id' => $user->id,
            'poster' => 'https://example.com/image.jpg'
        ]);
    }
}
