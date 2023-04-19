<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostContentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_映画情報をpostする()
    {
        $user = User::factory()->create();

        $data = [
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster_path' => 'https://example.com/image.jpg',
            'userId' => $user->id,
            'is_done' => true,
            'date' => '2022-01-01',
            'star' => 5
        ];

        $response = $this->actingAs($user)->post('/api/postContent', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('want_movies', [
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster_path' => 'https://example.com/image.jpg',
            'user_id' => $user->id,
            'is_done' => 1,
            'date' => '2022-01-01',
            'star' => 5
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_評価が小数の映画情報を登録()
    {
        $user = User::factory()->create();

        $data = [
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster_path' => 'https://example.com/image.jpg',
            'userId' => $user->id,
            'is_done' => true,
            'date' => '2022-01-01',
            'star' => 3.5
        ];

        $response = $this->actingAs($user)->post('/api/postContent', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('want_movies', [
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster_path' => 'https://example.com/image.jpg',
            'user_id' => $user->id,
            'is_done' => 1,
            'date' => '2022-01-01',
            'star' => 3.5
        ]);
    }
}
