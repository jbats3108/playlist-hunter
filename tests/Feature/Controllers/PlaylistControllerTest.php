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

        Song::factory()->count(3)->create(
            ['playlist_id' => $playlist->id]
        );

        // When
        $response = $this->get('playlists/' . $playlist->id)->assertSuccessful(
        );

        // Then
        $response->assertSee($playlist->title);
        $playlist->songs()->each(function ($song) use ($response) {
            $response->assertSee($song->title);
            $response->assertSee($song->artist);
        });
    }

    /** @test */
    public function it_displays_all_playlists()
    {
        // Given
        $playlists = Playlist::factory()->count(3)->create([]);

        $playlists->each(function ($playlist) {
            Song::factory()->count(3)->create(
                [
                    'playlist_id' => $playlist->id
                ]
            );
        });

        // When
        $response = $this->get('playlists')->assertSuccessful();

        // Then
        $playlists->each(function ($playlist) use ($response) {
            $response->assertSee($playlist->title);
            $playlist->songs()->each(function ($song) use ($response) {
                $response->assertSee($song->title);
                $response->assertSee($song->artist);
            });
        });
    }
}
