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
    $clientId = config('soundcloud.client_id');
    $redirectUri = urlencode("https://jamesmyhill.net/soundcloud-auth");
    $scope = "non-expiring"; 

    $auth_url = "https://soundcloud.com/connect?" . http_build_query([
        "client_id" => $clientId,
        "redirect_uri" => $redirectUri,
        "response_type" => "code",
        "scope" => $scope
    ]);

    return redirect($auth_url);
});

Route::get('/soundcloud-auth', function() {
    dd('Hit');
});
