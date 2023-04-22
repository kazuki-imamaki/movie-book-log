<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WantMovie;

class PutContentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();

        $movie = WantMovie::factory()->create([
            // 'id' => 10,
            'user_id' => $user->id,
            // 'title' => 'test',
            // 'memo' => 'testest'
        ]);

        $data = [
            'id' => $movie->id,
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster_path' => 'https://example.com/image.jpg',
            'userId' => $user->id,
            'is_done' => true,
            'date' => '2022-01-01',
            'star' => 5
        ];

        $response = $this->actingAs($user)->put('/api/putContent', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('want_movies', [
            'id' => $movie->id,
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster_path' => 'https://example.com/image.jpg',
            'user_id' => $user->id,
            'is_done' => 1,
            'date' => '2022-01-01',
            'star' => 5
        ]);

        $updatedMovie = WantMovie::find($movie->id);

        $this->assertEquals('Inception', $updatedMovie->title);
        $this->assertEquals('Great movie', $updatedMovie->memo);
        $this->assertEquals('https://example.com/image.jpg', $updatedMovie->poster_path);
        $this->assertTrue(true, $updatedMovie->is_done);
        $this->assertEquals('2022-01-01', $updatedMovie->date);
        $this->assertEquals(5, $updatedMovie->star);
    }
}
