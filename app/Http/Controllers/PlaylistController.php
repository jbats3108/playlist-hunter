<?php

namespace App\Http\Controllers;

use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function show(int $playlistId)
    {
        $playlist = Playlist::find($playlistId);
        return view('playlist.show', [
            'playlist' => $playlist
        ]);
    }
}
