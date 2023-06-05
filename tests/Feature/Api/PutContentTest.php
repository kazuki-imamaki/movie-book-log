<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WantMovie;
use App\Models\Image;

class PutContentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_put_content()
    {
        $this->withoutExceptionHandling();

        // テスト用のデータを作成
        $user = User::factory()->create();
        $image = Image::factory()->create([
            'name' => 'https://example.com/image.jpg',
        ]);
        $movie = WantMovie::factory()->create([
            'user_id' => $user->id,
            'images_id' => $image->id, // 仮の値を設定する
        ]);

        // テストデータ
        $data = [
            'id' => $movie->id,
            'title' => 'Inception',
            'memo' => 'Great movie',
            'poster' => 'https://example.com/image.jpg',
            'is_done' => true,
            'date' => '2022-01-01',
            'star' => 5,
        ];

        // PUTリクエストを送信
        $response = $this->actingAs($user)->put('/api/putContent', $data);

        // レスポンスのアサーション
        $response->assertStatus(200);

        // データベースのアサーション
        $this->assertDatabaseHas('want_movies', [
            'id' => $movie->id,
            'title' => 'Inception',
            'memo' => 'Great movie',
            'user_id' => $user->id,
            'is_done' => 1,
            'date' => '2022-01-01',
            'star' => 5,
        ]);

        // 更新されたモデルを取得
        $updatedMovie = WantMovie::find($movie->id);

        // モデルのアサーション
        $this->assertEquals('Inception', $updatedMovie->title);
        $this->assertEquals('Great movie', $updatedMovie->memo);
        $this->assertEquals(1, $updatedMovie->is_done);
        $this->assertEquals('2022-01-01', $updatedMovie->date);
        $this->assertEquals(5, $updatedMovie->star);

        // 画像のアサーション
        $image = Image::where('id', $updatedMovie->images_id)->first();
        $this->assertNotNull($image);
        $this->assertEquals('https://example.com/image.jpg', $image->name);
    }
}
