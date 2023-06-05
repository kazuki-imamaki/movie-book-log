<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\WantMovie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

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
            'poster_path' => 'https://image.tmdb.org/t/p/w154/3BSxAjiporlwQTWzaHZ9Yrl5C9D.jpg',
            'userId' => $user->id,
            'is_done' => true,
            'date' => '2022-01-01',
            'star' => 5
        ];

        $response = $this->actingAs($user)->post('/api/postContent', $data);

        $response->assertStatus(200);

        // $image = Image::where('name', '')->first();

        $this->assertDatabaseHas('want_movies', [
            'title' => 'Inception',
            'memo' => 'Great movie',
            // 'images_id' => $image->id,
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
            'poster_path' => 'https://www.themoviedb.org/t/p/w1280/jVE0GT7nDUpJY0T8F3i8ygi6YQa.jpg',
            'userId' => $user->id,
            'is_done' => true,
            'date' => '2022-01-01',
            'star' => 3.5
        ];

        $response = $this->actingAs($user)->post('/api/postContent', $data);

        $response->assertStatus(200);

        $image = Image::where('name', 'https://example.com/image.jpg')->first();

        $this->assertDatabaseHas('want_movies', [
            'title' => 'Inception',
            'memo' => 'Great movie',
            // 'images_id' => $image->id,
            'user_id' => $user->id,
            'is_done' => 1,
            'date' => '2022-01-01',
            'star' => 3.5
        ]);
    }
}
