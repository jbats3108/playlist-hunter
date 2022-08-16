<?php

namespace Tests\Unit\Models;

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

        $search = Song::find($song->id);

        $this->assertSame($title, $search->title);
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

        $search = Song::find($song->id);

        $this->assertSame($artist, $search->artist);
    }

    /** @test */
    public function it_belongs_to_a_playlist() {}
}
