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
        Schema::create('playlist_promotion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('playlist_id');
            $table->foreign('playlist_id')
                ->references('id')->on('playlists')
                ->onDelete('cascade');
            $table->date('next_run_date');
            $table->json('frequency');
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_promotion');
    }
};
