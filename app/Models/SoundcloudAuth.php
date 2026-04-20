<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoundcloudAuth extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'soundcloud_auth';

    protected $fillable = [
        'soundcloud_access_token', 'soundcloud_refresh_token', 'expires_at'
    ];
}
