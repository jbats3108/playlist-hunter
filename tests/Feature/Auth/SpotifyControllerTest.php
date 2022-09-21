<?php

namespace Tests\Feature\Auth;

use App\Models\User;
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

    /** @test */
    public function it_retrieves_a_users_playlists()
    {
        // Given
        $user = $this->loginWithSpotify();

        // When
        $playlistsPage = $this->actingAs($user)->call('GET', 'playlists');

        // Then
        $playlistsPage->assertOk();
    }

    private function loginWithSpotify(): User
    {
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

        $this->call('GET', '/spotify/callback');

        return User::firstWhere('spotify_id', $spotifyId);
    }

}
