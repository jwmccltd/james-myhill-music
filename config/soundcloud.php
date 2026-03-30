<?php

return [
    'client_id' => env('SOUNDCLOUD_CLIENT_ID'),
    'client_secret' => env('SOUNDCLOUD_CLIENT_SECRET'),
    'username' => env('SOUNDCLOUD_EMAIL'),
    'password' => env('SOUNDCLOUD_PASSWORD'),
    'redirect_uri' => env('SOUNDCLOUD_REDIRECT_URI'),
    'playlist_url' => env('SOUNDCLOUD_PLAYLIST_URL', 'https://api.soundcloud.com/playlists'),
    'token_url' => env('SOUNDCLOUD_TOKEN_URL', 'https://api.soundcloud.com/oauth2/token'),
    'auth_url' => env('SOUNDCLOUD_AUTH_URL', 'https://secure.soundcloud.com/authorize'),
    'tracks_url' => env('SOUNDCLOUD_TRACKS_URL', 'https://api.soundcloud.com/tracks'),
];
