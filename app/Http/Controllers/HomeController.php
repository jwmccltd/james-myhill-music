<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct() {

    }

    public function home() : View
    {

        //Array of display data for Vue component
        $displayData = [];

        $displayData[] = ['slide' => 'images/slide-folder/slides/slide-2.2.jpg', 'text' => ['Strange Flowers', 'Out Now!'], 'btn_text' => 'Listen Now', 'btn_action' => ['link' => 'https://push.fm/fl/6ofm9pyj', 'target' => '_blank']];
        $displayData[] = ['slide' => 'images/slide-folder/slides/slide-1.jpg', 'text' => ['Composer / Producer.', 'Electronica, Rock, Orchestral & Hybrid Genres.'], 'btn_text' => 'Selected Compositions', 'btn_action' => ['link' => 'https://on.soundcloud.com/EL3ys', 'target' => '_blank'], 'colours' => ['text_colour' => 'black', 'hover_text_colour' => 'white']];

        $displayData = json_encode($displayData);

        return view('home', compact(['displayData']));

    }


}
