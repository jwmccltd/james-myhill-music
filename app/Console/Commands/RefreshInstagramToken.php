<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InstagramTokenCred;
use Carbon\Carbon;

class RefreshInstagramToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-instagram-token';

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
        $app_id = config('instagram.app_id');
        $app_secret = config('instagram.app_secret');

        $token = InstagramTokenCred::first();
        if (empty($token->short_token)) {
            if (empty($token->long_token)) {
                return;
            }

            $expires = $token->expires;
            $now = Carbon::now();
            $otherDatetime = Carbon::parse($token->expires);

            if ($now->copy()->addHours(2)->lt($otherDatetime)) {
                return;
            }

            $tokenValue = $token->long_token;
        } else {
            $tokenValue = $token->short_token;
        }

        $url = "https://graph.facebook.com/v19.0/oauth/access_token?"
            . "grant_type=fb_exchange_token"
            . "&client_id={$app_id}"
            . "&client_secret={$app_secret}"
            . "&fb_exchange_token={$tokenValue}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "Curl error: " . curl_error($ch);
            exit;
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['access_token'])) {
            echo "Long-lived token:\n";
            echo $data['access_token'] . "\n";
            echo "Expires in: " . $data['expires_in'] . " seconds\n";

            $token->long_token = $data['access_token'];
            $token->expires = Carbon::now()->addSeconds($data['expires_in']);
            $token->short_token = null;
            $token->save();

        } else {
            echo "Error:\n";
            print_r($data);
        }
    }
}
