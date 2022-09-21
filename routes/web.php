<?php

use App\Http\Controllers\Auth\SpotifyController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('playlists', [PlaylistController::class, 'index']);
Route::get('playlists/{id}', [PlaylistController::class, 'show']);

Route::get('spotify/login', [SpotifyController::class, 'login']);
Route::get(
    Config::get('services.spotify.redirect'),
    [SpotifyController::class, 'callback']
);

require __DIR__ . '/auth.php';
