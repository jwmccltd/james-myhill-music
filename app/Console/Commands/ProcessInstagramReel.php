<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProcessPlaylistPromotionBatch;
use File;

class ProcessInstagramReel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-instagram-reel {folder} {outputVideoName} {playlistId?}';

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
        $folder = $this->argument('folder');

        $path = storage_path("/app/private/$folder");

        $publicPath = storage_path("/app/public/$folder");
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath);
        }

        $videoName = $this->argument('outputVideoName');

        $cmd =
        <<<CMD
            ffmpeg \
            -loop 1 -t 5 -i $path/title.jpg \
            -framerate 1/5 -i $path/%03d.jpg \
            -i $path/track.mp3 \
            -filter_complex "[0:v]scale=1080:1080,fps=30[v0]; \
                            [1:v]scale=1080:1080,fps=30[v1]; \
                            [v0][v1]concat=n=2:v=1:a=0[v]" \
            -map '[v]' -map 2:a \
            -c:v libx264 -crf 25 -pix_fmt yuv420p \
            -c:a aac -shortest \
            $publicPath/$videoName.mp4;
        CMD;
        exec($cmd);

        ProcessPlaylistPromotionBatch::create([
            'playlist_id' => $this->argument('playlistId') ?? null,
            'batch_video_file_path' => "$publicPath/$videoName.mp4",        
        ]);
    }
}
