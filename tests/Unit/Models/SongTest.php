<?php

namespace Tests\Unit\Models;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SongTest extends TestCase
{
    use WithFaker;
    use DatabaseMigrations;

    /** @test */
    public function it_has_a_title()
    {
        $title = $this->faker->word();

        $song = Song::factory()->create(
            [
                'title' => $title
            ]
        );

        $this->assertSame($title, $song->title);
    }

    /** @test */
    public function it_has_an_artist()
    {
        $artist = $this->faker->word();

        $song = Song::factory()->create(
            [
                'artist' => $artist
            ]
        );

        $this->assertSame($artist, $song->artist);
    }

    /** @test */
    public function it_belongs_to_a_playlist()
    {
        $playlist = Playlist::factory()->create([]);

        $song = Song::factory()->create(
            [
                'playlist_id' => $playlist->id
            ]
        );

        $playlist = Playlist::find($playlist->id);

        $songPlaylist = $song->playlist();

        $this->assertEquals($playlist->refresh(), $songPlaylist);
    }

    /** @test */
    public function it_has_a_url()
    {
        $song = Song::factory()->create([]);

        $baseUrl = 'https://www.ultimate-guitar.com/search.php?search_type=title&value=';

        $searchString = rawurlencode(sprintf('%s %s', $song->title, $song->artist));

        $this->assertSame($baseUrl . $searchString,$song->url());
    }
}
