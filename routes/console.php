<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Schedule::command('app:run-config')->dailyAt('22:00');
Schedule::command('app:generate-soundcloud-playlists')->dailyAt('23:00');
#Schedule::command('app:refresh-instagram-token')->dailyAt('05:00');
#Schedule::command('app:build-reel-video')->dailyAt('06:00');
#Schedule::command('app:process-batches')->dailyAt('08:00');
