<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessPlaylistPromotionBatch extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'process_playlist_promotion_batch';

    public $timestamps = false;

    protected $fillable = [
        'playlist_id', 'batch_video_file_path'
    ];

    protected $casts = [
        'config' => 'array',
    ];
}
