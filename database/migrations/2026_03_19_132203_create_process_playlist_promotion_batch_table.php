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
        Schema::create('process_playlist_promotion_batch', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('playlist_id')->nullable();
            $table->foreign('playlist_id')
                ->references('id')->on('playlists')
                ->onDelete('cascade');
            $table->string('batch_video_file_path');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_playlist_promotion_batch');
    }
};
