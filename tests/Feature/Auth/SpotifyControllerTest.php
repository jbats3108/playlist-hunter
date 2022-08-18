<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SpotifyUser;
use Mockery;
use Tests\TestCase;

class SpotifyControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_redirects_to_the_spotify_login_page()
    {
        Socialite::shouldReceive('driver')->with('spotify')->once();

        $this->call('GET', '/spotify/login')->isRedirection();
    }

    /** @test */
    public function it_returns_a_logged_in_user_to_the_dashboard()
    {
        $spotifyUser = Mockery::mock(SpotifyUser::class);

        $spotifyUser->shouldReceive('getId')
            ->andReturn('fooBar')
            ->shouldReceive('getEmail')
            ->andReturn('foo@bar.com');

        Socialite::shouldReceive('driver->user')->andReturn($spotifyUser);

        $response = $this->call('GET', '/spotify/callback');

        $this->assertDatabaseHas('users',
        [
            'spotify_id' => 'fooBar'
        ]);

        $response->assertRedirect('dashboard');

    }

}
