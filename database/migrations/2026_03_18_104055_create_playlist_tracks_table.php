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
        Schema::create('playlist_tracks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('playlist_id');
            $table->foreign('playlist_id')
                ->references('id')->on('playlists')
                ->onDelete('cascade');
            $table->string('track_id');
            $table->string('image_url');
            $table->string('name');
            $table->string('artist_name');
            $table->string('album_name');
            $table->datetime('added_at');
            $table->datetime('processed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_tracks');
    }
};
