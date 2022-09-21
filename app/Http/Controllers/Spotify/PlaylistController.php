<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use App\Models\User;
use Config;
use GuzzleHttp\Client;

class PlaylistController extends Controller
{
    public function index(User $user)
    {
        $client = new Client(
            [
                'base_uri' => Config::get('services.spotify.api_base'),
                'headers' => [
                    'Authorization' => 'Bearer ' . $user->spotifyAuthToken(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $client->get('me/playlists');
    }
}
