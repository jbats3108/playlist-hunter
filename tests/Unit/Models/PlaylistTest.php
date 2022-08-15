<?php

namespace Tests\Unit\Models;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaylistTest extends TestCase
{
    use WithFaker;
    use DatabaseMigrations;

    /** @test */
    public function it_has_a_title()
    {
        $title = $this->faker->word;

        $playlist = Playlist::factory()->create(
            [
                'title' => $title
            ]
        );

        $search = Playlist::find($playlist->id);

        $this->assertSame($title, $search->title);
    }

    /** @test */
    public function it_contains_songs()
    {
        $playlist = Playlist::factory()->create([]);

        $songs = Song::factory()->count(3)->create(
            [
                'playlist_id' => $playlist->id
            ]
        );

        $playlistSongs = $playlist->songs()->get();

        $songs->each(
            fn($song) => $this->assertTrue($playlistSongs->contains($song))
        );


    }
}
