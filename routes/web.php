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
    session_start();

    $clientId = config('soundcloud.client_id');

    $redirectUri = urlencode(config('soundcloud.redirect_uri'));

    // 1. Generate a secure random code_verifier (43–128 chars)
    $codeVerifier = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

    // 2. Create code_challenge using SHA256 + base64url encoding
    $hash = hash('sha256', $codeVerifier, true);
    $codeChallenge = rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');

    $_SESSION['code_verifier'] = $codeVerifier;

    $state = bin2hex(random_bytes(16));

    return redirect("https://secure.soundcloud.com/authorize?client_id=$clientId&redirect_uri=$redirectUri&response_type=code&code_challenge=$codeChallenge&code_challenge_method=S256&state=$state&display=popup");
});

Route::get('/soundcloud-auth', function(Request $request) {
    session_start();

    // Ձեր config
    $clientId = config('soundcloud.client_id');
    $clientSecret = config('soundcloud.client_secret');
    $redirectUri = config('soundcloud.redirect_uri');

    // Values from callback
    $authCode = $request->input('code'); // SoundCloud sends this back
    $codeVerifier = $_SESSION['code_verifier']; // stored earlier

    // Prepare POST data
    $postFields = http_build_query([
        'grant_type' => 'authorization_code',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'code_verifier' => $codeVerifier,
        'code' => $authCode
    ]);

    // Init cURL
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => "https://secure.soundcloud.com/oauth/token",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json; charset=utf-8",
            "Content-Type: application/x-www-form-urlencoded"
        ],
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);

    // Decode JSON response
    $data = json_decode($response, true);

    // Output (for testing)
    print_r($data);
});
