<?php

namespace App\PlaylistConfigs\Operations;

trait RemoveUnplayable
{
    /**
     * Remove unplayable tracks.
     * @return void.
     */
    private function removeUnplayable()
    {
        //$deleteTracks['tracks'] = [];
        // Loop and add any redundant tracks.

        // This is unsafe and unreliable with Spotify API changes.

        /*foreach ($this->selectedPlaylistData as $position => $playlistTrack) {

            if ($this->artistOrTrackShouldBeExcluded($playlistTrack) && $this->config['overrideGlobal'] === 'no') {
                continue;
            }

            if (empty($playlistTrack['available_markets'])) {
                $deleteTracks['tracks'][] = ['uri' => $playlistTrack['uri']];
            }
        }

        // Remove all redundant tracks from playlist by URI.
        $this->dataService->sendRequest("playlists/$this->playlistLinkId/items", $this->userId, json_encode($deleteTracks), 'DELETE');*/
    }
}
