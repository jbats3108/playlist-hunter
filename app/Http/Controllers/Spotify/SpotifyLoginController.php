<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\OAuth2\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SpotifyLoginController extends Controller
{
    public function login(): RedirectResponse
    {
        return Socialite::driver('spotify')
            ->scopes(['user-read-email', 'user-read-private', 'playlist-read-private'])
            ->redirect();
    }

    public function callback()
    {
        /** @var User $socialiteUser */
        $socialiteUser = Socialite::driver('spotify')->user();

        $user = \App\Models\User::updateOrCreate(
            [
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'spotify_id' => $socialiteUser->id,
                'spotify_token' => $socialiteUser->token,
                'spotify_refresh_token' => $socialiteUser->refreshToken
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
