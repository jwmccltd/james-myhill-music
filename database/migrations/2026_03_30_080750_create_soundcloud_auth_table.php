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
        Schema::create('soundcloud_auth', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('soundcloud_access_token');
            $table->longText('soundcloud_refresh_token');
            $table->dateTime('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soundcloud_auth');
    }
};
