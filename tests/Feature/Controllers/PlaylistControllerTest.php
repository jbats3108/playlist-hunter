<?php

namespace Tests\Feature\Controllers;

use App\Models\Playlist;
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

        // When
        $view = $this->view('playlist.show', $playlist);

        // Then
        $view->assertSee('Super Song');
        $view->assertSee('Artist');
    }
}
