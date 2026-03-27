<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Http\Request;

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

    // 1. Generate a secure random code_verifier (43–128 chars)
    $codeVerifier = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

    // 2. Create code_challenge using SHA256 + base64url encoding
    $hash = hash('sha256', $codeVerifier, true);
    $codeChallenge = rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');

    echo "Code Verifier: " . $codeVerifier . PHP_EOL;
    echo "Code Challenge: " . $codeChallenge . PHP_EOL;

    $state = bin2hex(random_bytes(16));

    return redirect("https://secure.soundcloud.com/authorize?client_id=$clientId&redirect_uri=$redirectUri&response_type=code&code_challenge=$codeChallenge&code_challenge_method=S256&state=$state&display=popup");
});

Route::get('/soundcloud-auth', function(Request $request) {
    dd($request->all());
});
