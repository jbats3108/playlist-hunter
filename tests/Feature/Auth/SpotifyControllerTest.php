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
        $this->withoutExceptionHandling();
        $spotifyUser = Mockery::mock(SpotifyUser::class);


        $spotifyId = 'fooBar';
        $spotifyEmail = 'foo@bar.com';

        $spotifyUser->shouldReceive('getId')
            ->andReturn($spotifyId)
            ->shouldReceive('getEmail')
            ->andReturn($spotifyEmail)
            ->shouldReceive('getName')
            ->andReturn($spotifyId);

        Socialite::shouldReceive('driver->user')->andReturn($spotifyUser);

        $this->call('GET', '/spotify/callback')->assertRedirect(
            'dashboard'
        );

        $this->assertDatabaseHas(
            'users',
            [
                'spotify_id' => $spotifyId
            ]
        );


    }

}
