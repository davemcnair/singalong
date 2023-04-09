<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Song;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class AddSongTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function adds_song(): void
    {
        // given
        $user = User::factory()->create();
        $song = Song::factory()->make();
        $tag = Tag::factory()->make();
        $tag2 = Tag::factory()->make();

        //when
        $response = $this->actingAs($user)->post('/songs', [
            'title' => $song->title,
            'artist' => $song->artist,
            'tags' => [
                ['name' => $tag->name],
                ['name' => $tag2->name],
            ]
        ]);

        // then
        $song = Song::get()->first();
        $this->assertCount(2, $song->tags);
        $this->assertDatabaseCount('tags', 2);
        $response->assertStatus(302);
        $response->assertRedirect('/songs');
    }
}
