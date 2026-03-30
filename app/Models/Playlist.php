<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Playlist extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playlists';

    public $timestamps = false;

    protected $fillable = [
        'playlist_link_id', 'user_id', 'label', 'soundcloud_playlist_urn'
    ];

    /**
     * Get the promotion associated with the playlist.
     */
    public function promotion(): HasOne
    {
        return $this->hasOne(PlaylistPromotion::class, 'playlist_id');
    }
}
