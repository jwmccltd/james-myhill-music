<?php

namespace App\Services;
use App\Models\SoundcloudAuth;
use Carbon\Carbon;

class SoundcloudService {
    /**
     * Get/set access token
     * @param bool    $forceAccessTokenRefresh Force refresh of access token.
     * @return string|null
     */
    public function getSetAccessToken()
    {
        $soundCloudAuth = SoundcloudAuth::first();

        $clientId = config('soundcloud.client_id');
        $clientSecret = config('soundcloud.client_secret');

        if (empty($soundCloudAuth->expires_at) || Carbon::now()->gte($soundCloudAuth->expires_at)) {

            // Prepare POST data
            $postFields = http_build_query([
                'grant_type' => 'refresh_token',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'refresh_token' => $soundCloudAuth->soundcloud_refresh_token,
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

            $soundCloudAuth->soundcloud_access_token = $data['access_token'];
            $soundCloudAuth->soundcloud_refresh_token = $data['refresh_token'];
            $soundCloudAuth->expires_at = Carbon::now()->addSeconds($data['expires_in']);
            $soundCloudAuth->save();
        }

        return $soundCloudAuth->soundcloud_access_token;

    }

    public function saveRefreshToken($refreshToken) {
        $soundCloudAuth = SoundcloudAuth::first();
        $soundCloudAuth->soundcloud_refresh_token = $refreshToken;
        $soundCloudAuth->save();
    }
}