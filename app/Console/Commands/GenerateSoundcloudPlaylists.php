<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PlaylistTrack;
use App\Models\Playlist;
use App\Services\DataService;

class GenerateSoundcloudPlaylists extends Command
{
    public function __construct(protected DataService $dataService) {
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
        $url = "https://api.soundcloud.com/oauth2/token";

        $params = [
            "client_id" => config('soundcloud.client_id'),
            "client_secret" => config('soundcloud.client_secret'),
            "grant_type" => 'client_credentials',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        $accessToken = $data['access_token'];

        $playlists = Playlist::whereHas('promotion', function ($query) {
            return $query->where('active', 1);
        })->get();
        
        foreach ($playlists as $playlist) {
            $playlistInfo = $this->dataService->getData('playlist-data', 'playlists/' . $playlist->playlist_link_id, $playlist->user_id, 'name, description');
            
            if (!isset($playlistInfo['name'])) {
                continue;
            }

            $trackIds = [];
            $tracks = PlaylistTrack::where('playlist_id', $playlist['playlist_id'])
                ->select('artist_name', 'name')
                ->get();

                foreach ($tracks as $track) {
                    $artist = $track['artist_name'];
                    $track  = $track['name'];

                    // Build query
                    $query = urlencode("$artist $track");

                    $url = "https://api.soundcloud.com/tracks?q=$query";

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

                    if (isset($data[0])) {
                        $trackIds[] = $data[0]['id'];
                    }
                }

            $trackIds = array_unique($trackIds);

            $trackIdsGrouped = [];
            foreach ($trackIds as $id) {
                $trackIdsGrouped[] = ['id' => $id];
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
            $url = "https://api.soundcloud.com/playlists";

            // Initialize cURL
            $ch = curl_init($url);

            // Set options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Accept: application/json; charset=utf-8",
                "Content-Type: application/json",
                "Authorization: OAuth $accessToken",
                "Content-Length: " . strlen($jsonData)
            ]);

            // Execute request
            $response = curl_exec($ch);

            // Error handling
            if (curl_errno($ch)) {
                die("cURL error: " . curl_error($ch));
            }

            curl_close($ch);

            // Decode response
            $data = json_decode($response, true);

            // Output result
            print_r($data);
        }

       

    }
}
