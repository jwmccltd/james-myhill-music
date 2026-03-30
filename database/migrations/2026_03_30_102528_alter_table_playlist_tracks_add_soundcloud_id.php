<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('playlist_tracks', function (Blueprint $table) {
            $table->bigInteger('soundcloud_track_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('playlist_tracks', function (Blueprint $table) {
            $table->dropColumn('soundcloud_track_id');
        });
    }
};
