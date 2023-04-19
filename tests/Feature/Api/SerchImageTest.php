<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\User;

class SerchImageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSearchImage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/search?title=star%20wars');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                '*' => [
                    'poster_path',
                    'adult',
                    'overview',
                    'release_date',
                    'genre_ids',
                    'id',
                    'original_title',
                    'original_language',
                    'title',
                    'backdrop_path',
                    'popularity',
                    'vote_count',
                    'video',
                    'vote_average',
                ]
            ]);
    }
}
