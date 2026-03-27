<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('/playlists',[PlaylistController::class, 'playlists']);
Route::get('/soundcloud', function() {
      $params = [
            "client_id" => config('soundcloud.client_id'),
            "client_secret" => config('soundcloud.client_secret'),
            "grant_type" => 'client_credentials',
        ];

    $clientId = config('soundcloud.client_id');

    $redirectUri = urlencode("https://jamesmyhill.net/soundcloud-auth");

    return redirect("https://secure.soundcloud.com/authorize?client_id=$clientId&redirect_uri=$redirectUri&response_type=code&code_challenge=CODE_CHALLENGE&code_challenge_method=S256&state=STATE&display=popup");
});

Route::get('/soundcloud-auth', function() {
    dd('Hit');
});
