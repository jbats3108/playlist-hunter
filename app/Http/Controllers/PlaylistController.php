<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PlaylistController extends Controller
{
    public function index(): Factory | View | Application
    {
        return view(
            'playlist.index',
            [
                'playlists' => Playlist::all()
            ]
        );
    }

    public function show(int $playlistId): Factory | View | Application
    {
        return view('playlist.show', [
            'playlist' => Playlist::find($playlistId)
        ]);
    }
}
