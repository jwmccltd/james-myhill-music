<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InstagramTokenCred;
use App\Models\ProcessPlaylistPromotionBatch;
use File;

class UploadInstagramReel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-instagram-reel {source} {caption} {batchId?}';

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
        $token = InstagramTokenCred::first();
        if (empty($token->long_token)) {
            return;
        }

        $accessToken = $token->long_token;
        $igUserId = config('instagram.user_id');

        $videoUrl = $this->argument('source');
        $caption = $this->argument('caption');

        $urlGraphAPI = config('instagram.graph_api_endpoint');
        $url = "{$urlGraphAPI}/{$igUserId}/media";

        $params = [
            "media_type" => "REELS",
            "video_url" => $videoUrl,
            "caption" => $caption,
            "access_token" => $accessToken
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        $creationId = $data['id'];

        $maxAttempts = 20;
        $attempts = 0;
        $status = '';
        // Poll until video is processed
        do {
            sleep(5);
            $statusResponse = $this->getRequest("{$urlGraphAPI}/{$creationId}?fields=status_code&access_token={$accessToken}");
            $status = $statusResponse['status_code'] ?? '';
            echo "Current status: $status\n";
            $attempts++;
        } while ($status === 'IN_PROGRESS' && $attempts < $maxAttempts);

        if (strtolower($status) === 'error') {
            echo "Error preparing reel";
            return;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$urlGraphAPI}/{$igUserId}/media_publish");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'creation_id' => $creationId,
            'access_token' => $accessToken
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $publishData = json_decode($response, true);

        if ($this->argument('batchId')) {
            $batch = ProcessPlaylistPromotionBatch::find($this->argument('batchId'));

            $filePath = storage_path("/app/public/{$batch->batch_video_file_path}");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $batch->delete();
        }       

        return 'success';
    }

    private function getRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            die('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($response, true);
    }

}
