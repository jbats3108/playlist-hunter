<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SpotifyController extends Controller
{
    public function login(): RedirectResponse | \Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('spotify')->redirect();
    }

    public function callback(): Redirector | Application | \Illuminate\Http\RedirectResponse
    {
        $spotifyUser = Socialite::driver('spotify')->user();

        $user = User::updateOrCreate(
            [
                'spotify_id' => $spotifyUser->getId()
            ],
            [
                'name'                  => $spotifyUser->getName(),
                'email'                 => $spotifyUser->getEmail(),
                'spotify_token'         => $spotifyUser->token,
                'spotify_refresh_token' => $spotifyUser->refreshToken
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');

    }
}
