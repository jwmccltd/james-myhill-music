<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProcessPlaylistPromotionBatch;

class ProcessBatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-batches';

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
        $this->call('app:refresh-instagram-token');

        $batches = ProcessPlaylistPromotionBatch::get();

        foreach ($batches AS $batch) {            
            // Successful, so call the function to generate the video.
            $this->call('app:upload-instagram-reel', [
                'source' => config('app.url') . '/storage/' . $batch->batch_video_file_path,
                'caption' => 'James Myhill Music Playlists jamesmyhill.net/playlists',
                'batchId' => $batch->id,
            ]);
        }
    }
}
