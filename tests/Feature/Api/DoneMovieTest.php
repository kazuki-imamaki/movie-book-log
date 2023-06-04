<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;
use App\Models\WantMovie;
use App\Models\Image;

class DoneMovieTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Done映画情報を取得する()
    {
        $user = User::factory()->create();

        $image = Image::factory()->create(['name' => "https://example.com/image.jpg"]);

        WantMovie::factory()->create([
            'user_id' => $user->id,
            'is_done' => 1,
            'images_id' => $image->id
        ]);

        $response = $this->actingAs($user)->get("/api/done");

        $response->assertStatus(Response::HTTP_OK);

        $response
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'user_id' => $user->id,
                'is_done' => 1,
                'poster' => 'https://example.com/image.jpg'
            ]);
    }

    /**
     * Test to get want movies without login.
     *
     * @return void
     */
    public function test_Done映画情報取得時にログイン済みであること()
    {
        $response = $this->get('/api/want');

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/login');
    }
}
