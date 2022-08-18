<?php

namespace Tests\Feature\Auth;

use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class SpotifyControllerTest extends TestCase
{
    /** @test */
    public function it_redirects_to_the_spotify_login_page()
    {
        Socialite::shouldReceive('driver')->with('spotify')->once();

        $this->call('GET', '/spotify/login')->isRedirection();
    }
}
