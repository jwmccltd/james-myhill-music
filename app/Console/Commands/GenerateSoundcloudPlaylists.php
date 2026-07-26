<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PlaylistTrack;
use App\Models\Playlist;
use App\Services\SoundcloudService;
use App\Services\DataService;
use Illuminate\Support\Facades\Log;

class GenerateSoundcloudPlaylists extends Command
{
    public function __construct(protected DataService $dataService, protected SoundcloudService $soundcloudService) {
        // Constructor
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-soundcloud-playlists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accessToken = $this->soundcloudService->getSetAccessToken();

        $playlists = Playlist::whereHas('promotion', function ($query) {
            return $query->where('active', 1);
        })->get();
        
        foreach ($playlists as $playlist) {
            $playlistInfo = $this->dataService->getData('playlist-data', 'playlists/' . $playlist->playlist_link_id, $playlist->user_id, 'name, description');

            if (isset($playlistInfo['error']['message'])) {
                die($playlistInfo['error']['message']);
            }

            if (!isset($playlistInfo['name'])) {
                continue;
            }

            Log::info('Handling ' . $playlistInfo['name']);

            $trackIds = [];
            $tracks = PlaylistTrack::where('playlist_id', $playlist['id'])
                ->select('artist_name', 'name')
                ->get();

            $tracksUrl = config('soundcloud.tracks_url');

            foreach ($tracks as $trackObj) {
                
                $artist = $trackObj['artist_name'];
                $track  = $trackObj['name'];

                // Build query
                $query = urlencode("$artist $track");

                $url = "{$tracksUrl}?q={$query}";

                // Initialize cURL
                $ch = curl_init($url);

                // Set options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Accept: application/json; charset=utf-8",
                    "Authorization: OAuth $accessToken"
                ]);

                // Execute request
                $response = curl_exec($ch);

                // Error handling
                if (curl_errno($ch)) {
                    die("cURL error: " . curl_error($ch));
                }

                curl_close($ch);

                // Decode JSON
                $data = json_decode($response, true);

                // Can only rely on exact artist name matches
                if (isset($data[0]) && $data[0]['metadata_artist'] === $artist) {
                    Log::info("Found artist and track: $artist $track");

                    $trackIds[] = $data[0]['id'];
                    $trackObj->soundcloud_track_id = $data[0]['id'];
                    $trackObj->save();
                } else {
                    Log::info("Could not find artist and track: $artist $track");
                    Log::info("Data is " . print_r($data, true));
                }
            }

            $trackIds = array_unique($trackIds);

            $trackIdsGrouped = [];
            foreach ($trackIds as $id) {
                $trackIdsGrouped[] = ['urn' => "soundcloud:tracks:$id"];
            }

            // Build request body (as PHP array)
            $body = [
                "playlist" => [
                    "title" => $playlistInfo['name'],
                    "description" => $playlistInfo['description'],
                    "sharing" => "public",
                    "tracks" => $trackIdsGrouped
                ]
            ];

            // Convert to JSON
            $jsonData = json_encode($body);

            // Endpoint
            $url = config('soundcloud.playlist_url');

            if (!empty($playlist->soundcloud_playlist_urn)) {
                $url = "$url/{$playlist->soundcloud_playlist_urn}";
            }

            // Initialize cURL
            $ch = curl_init($url);

            // Set options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if (!empty($playlist->soundcloud_playlist_urn)) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            } else {
                curl_setopt($ch, CURLOPT_POST, true);
            }
         
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Accept: application/json; charset=utf-8",
                "Content-Type: application/json",
                "Authorization: OAuth $accessToken"
            ]);

            // Execute request
            $response = curl_exec($ch);

            Log::info($response);

            // Error handling
            if (curl_errno($ch)) {
                die("cURL error: " . curl_error($ch));
            }

            curl_close($ch);

            // Decode response
            $data = json_decode($response, true);  

            if (isset($data['urn'])) {
                $playlist->soundcloud_playlist_urn = $data['urn'];
                $playlist->save();
            }

        }
    }
}
