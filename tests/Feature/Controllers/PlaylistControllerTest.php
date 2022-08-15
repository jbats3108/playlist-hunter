<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class PlaylistControllerTest extends TestCase
{
    /** @test */
    public function it_displays_a_playlist()
    {
        // Given

        $playlist = [
            [
                'title' => 'Super Song',
                'artist' => 'Artist'
            ],
        ];

        // When
        $view = $this->view('playlist', $playlist);

        // Then
        $view->assertSee('Super Song');
        $view->assertSee('Artist');
    }
}
