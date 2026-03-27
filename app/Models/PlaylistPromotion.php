<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistPromotion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playlist_promotion';

    public $timestamps = false;

    protected $fillable = [
        'playlist_id', 'next_run_date', 'frequency', 'active'
    ];

    protected $casts = [
        'config' => 'array',
    ];
}
