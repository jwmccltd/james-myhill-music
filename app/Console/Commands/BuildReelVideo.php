<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PlaylistPromotion;
use App\Models\Playlist;
use App\Models\PlaylistTrack;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;
use Str;

class BuildReelVideo extends Command
{
    const IN_THE_ELECTRONICA_ZONE = '3B5O5ZcPfw2hAtLliVfvnu';
    const DARK_CINEMATIC = '60ZAiKbFEkqukCJHpO12dj';
    const ALT_ELECTRIC = '4BAeIqII4WGepTDXgr5Bv8';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-reel-video';

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
        $promotions = PlaylistPromotion::join('playlists', 'playlists.id', 'playlist_promotion.playlist_id')
            ->where('active', 1)
            ->where('next_run_date', Carbon::now()->format('Y-m-d'))
            ->selectRaw('*')
            ->get();

        // Create manager
        $manager = new ImageManager(new Driver());

        foreach ($promotions as $promotion) {
          
            $playlist = Playlist::where('id', $promotion->playlist_id)->first();

            if ($playlist && $this->isValidPLaylistLink($playlist->playlist_link_id)) {
                $frequency = json_decode($promotion->frequency, true);
            
                $dateCompare = null;
                if (array_key_exists('months', $frequency)) {
                    $dateCompare = Carbon::now()->subMonths($frequency['months'])->format('Y-m-d');
                }

                // Check if we have tracks in the period and if so how many
                $tracks = PlaylistTrack::where('playlist_id', $playlist->id)
                    ->whereBetween(DB::raw('DATE(added_at)'), [$dateCompare, Carbon::now()->format('Y-m-d')])
                    ->whereNull('processed_at')
                    ->get();

                if (sizeof($tracks) > 2) {
                    $filenameNumber = 1;

                    $filesToFlush = [];
                    foreach ($tracks as $track) {
                        $response = Http::get($track['image_url']);

                        if ($response->successful()) {
                            // Read image
                            $image = $manager->read($response->body());

                            // Convert to JPG
                            $jpg = $image->toJpeg(90);

                            $fileName = str_pad($filenameNumber, 3, '0', STR_PAD_LEFT);

                            $filesToFlush[] = "private/$playlist->playlist_link_id/$fileName.jpg";   

                            // Step 4: Save to storage/app/private
                            Storage::disk('local')->put("private/$playlist->playlist_link_id/$fileName.jpg", $jpg);

                            $filenameNumber++;
                        } else {
                            throw new Exception("Failed to download image.");
                        }

                        $track->processed_at = Carbon::now();
                        $track->save();
                    }

                    $randomStr = Str::random(10);

                    // Successful, so call the function to generate the video.
                    $this->call('app:process-instagram-reel', [
                        'folder' => $playlist->playlist_link_id,
                        'outputVideoName' => $playlist->playlist_link_id.'_'.$randomStr,
                        'playlistId' => $playlist->id,
                    ]);

                    $promotionClass = PlaylistPromotion::where('playlist_id', $playlist->id)->first();
                    $promotionClass->next_run_date = Carbon::now()->addMonths((int) $frequency['months'])->format('Y-m-d');
                    $promotionClass->save();

                    Storage::disk('local')->delete($filesToFlush);
                }  
            }
        }   
    }

    private function isValidPLaylistLink($playlistLinkId) {
        return in_array($playlistLinkId,
            [
                self::IN_THE_ELECTRONICA_ZONE,
                self::DARK_CINEMATIC,
                self::ALT_ELECTRIC
            ]);
    }
}
