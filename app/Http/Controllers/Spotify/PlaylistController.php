<?php

namespace App\Http\Controllers\Spotify;

use App\Data\Spotify\PlaylistData\PlaylistData;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PlaylistController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function index()
    {
        $user = Auth::user();

        $client = new Client(
            [
                'base_uri' => Config::get('services.spotify.api_base'),
                'headers'  => [
                    'Authorization' => 'Bearer ' . $user->spotifyToken(),
                    'Content-Type'  => 'application/json'
                ]
            ]
        );

        $playlistResponse = $client
            ->get('me/playlists')
            ->getBody()
            ->getContents();

        $playlists = PlaylistData::collection(
            json_decode($playlistResponse)->items
        );

        return view(
            'playlist.index',
            [
                'playlists' => $playlists
            ]
        );
    }
}
