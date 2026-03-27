<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramTokenCred extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instagram_token_creds';

    public $timestamps = false;

    protected $fillable = [
        'short_token', 'long_token'
    ];
}
