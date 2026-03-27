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
        Schema::create('instagram_token_creds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('short_token')->nullable();
            $table->text('long_token')->nullable();
            $table->datetime('expires')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram_token_creds');
    }
};
