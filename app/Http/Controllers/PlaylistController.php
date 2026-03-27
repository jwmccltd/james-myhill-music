<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PlaylistController extends Controller
{
    public function playlists() : View
    {
        return view('playlists');
    }
}
