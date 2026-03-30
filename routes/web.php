<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SoundcloudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('/playlists',[PlaylistController::class, 'playlists']);
Route::get('/soundcloud',[SoundcloudController::class, 'connect']);
Route::get('/soundcloud-auth',[SoundcloudController::class, 'auth']);
