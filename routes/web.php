<?php

use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('playlists', [PlaylistController::class, 'index']);
Route::get('playlists/{id}', [PlaylistController::class, 'show']);

Route::get('/auth/redirect', fn() => Socialite::driver('spotify')->redirect());

require __DIR__ . '/auth.php';
