<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use App\Models\Playlist;
use App\Models\PlaylistConfiguration;
use App\Models\PlaylistConfigurationSchedule;

class CopyConfig extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:copy-config {copyFromPlaylistId} {playlistLinkId} {newPlaylistLabel}';

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
        $playlist = Playlist::find($this->argument('copyFromPlaylistId'));

        if (!$playlist) {
            $this->error('Playlist not found.');
            return 1;
        }

        $playlist = Playlist::where('playlist_link_id', $this->argument('playlistLinkId'))->first();

        if ($playlist) {
            $this->error('Playlist already exists with this link id.');
            return 1;
        }

        $playlist = Playlist::create([
            'playlist_link_id' => $this->argument('playlistLinkId'),
            'user_id' => 1,
            'label' => $this->argument('newPlaylistLabel')
        ]);

        $configs = PlaylistConfiguration::where('playlist_id', $this->argument('copyFromPlaylistId'))->get();

        foreach ($configs as $config) {
            $playlistConfig = new PlaylistConfiguration();
            $playlistConfig->option_id = $config->option_id;
            $playlistConfig->playlist_id = $playlist->id;
            $playlistConfig->config = $config->config;
            $playlistConfig->active = $config->active;
            $playlistConfig->step = $config->step;
            $playlistConfig->save();
        }

        $schedule = PlaylistConfigurationSchedule::where('playlist_id', $this->argument('copyFromPlaylistId'))->first();
        if ($schedule) {
            $copySchedule = new PlaylistConfigurationSchedule();
            $copySchedule->playlist_id = $playlist->id;
            $copySchedule->run_at_time = $schedule->run_at_time;
            $copySchedule->days = $schedule->days;
            $copySchedule->frequency = $schedule->frequency;
            $copySchedule->save();
        }

        echo "Done";
    }
}
