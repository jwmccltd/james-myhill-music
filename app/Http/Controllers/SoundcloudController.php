<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoundcloudAuth;
use Carbon\Carbon;

class SoundcloudController extends Controller
{
    public function connect()
    {
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

        $authUrl = config('soundcloud.auth_url');

        return redirect("$authUrl?client_id=$clientId&redirect_uri=$redirectUri&response_type=code&code_challenge=$codeChallenge&code_challenge_method=S256&state=$state&display=popup");

    }

    public function auth(Request $request) {
        session_start();

        // Get config
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
            CURLOPT_URL => config('soundcloud.token_url'),
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

        if (isset($data['access_token'])) {
            SoundCloudAuth::truncate();
            $soundCloudAuth = new SoundCloudAuth();
            $soundCloudAuth->soundcloud_access_token = $data['access_token'];
            $soundCloudAuth->soundcloud_refresh_token = $data['refresh_token'];
            $soundCloudAuth->expires_at = Carbon::now()->addSeconds($data['expires_in']);
            $soundCloudAuth->save();
        }
    }   
}
