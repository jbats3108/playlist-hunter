<?php

namespace Tests\Feature\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PlaylistControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_displays_a_playlist()
    {
        // Given
        $playlist = Playlist::factory()->create([]);

        $songs = Song::factory()->count(3)->create(
            ['playlist_id' => $playlist->id]
        );

        // When
        $response = $this->get('playlists/' . $playlist->id)->assertSuccessful(
        );

        // Then
        $response->assertSee($playlist->title);
        $songs->each(function ($song) use ($response) {
            $response->assertSee($song->title);
            $response->assertSee($song->artist);
        });
    }
}
