<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class PlaylistTrack extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playlist_tracks';

    public $timestamps = false;

    protected $fillable = [
        'playlist_id', 'track_id', 'image_url', 'name', 'album_name', 'added_at', 'processed_at',
    ];

}
