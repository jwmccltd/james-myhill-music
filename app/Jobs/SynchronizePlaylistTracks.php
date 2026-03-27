<?php

namespace App\Jobs;

use App\Services\DataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PlaylistTrack;
use App\Models\Playlist;
use Carbon\Carbon;

class SynchronizePlaylistTracks implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $selectedPlaylistData;
    public $playlistLinkId;
    public $userId;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct(protected DataService $dataService, $playlistLinkId, $userId)
    {
        $this->playlistLinkId = $playlistLinkId;

        $fields = 'items(added_at,track(id,uri,name,artists(id,name),album(id,name,images),available_markets)),next,total';
        $this->selectedPlaylistData = $this->dataService->getData('tracks', 'playlists/' . $playlistLinkId . '/items', $userId, $fields);

        $this->userId = $userId;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(): void
    {
        $playlist = Playlist::where('playlist_link_id', $this->playlistLinkId)->first();

        PlaylistTrack::where('playlist_id', $playlist->id)->delete();

        foreach ($this->selectedPlaylistData as $track) {
            $playlistTrack = new PlaylistTrack();
            $playlistTrack->playlist_id = $playlist->id;
            $playlistTrack->image_url = $track['album']['images'][0]['url'];
            $playlistTrack->album_name = $track['album']['name'];
            $playlistTrack->artist_name = $track['artists'][0]['name'];
            $playlistTrack->name = $track['name'];
            $playlistTrack->track_id = $track['id'];
            $playlistTrack->added_at = Carbon::parse($track['added_at'])->toDateTime();
            $playlistTrack->save();
        }

    }
}
