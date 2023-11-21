->nullable()<?php

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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('date');
            $table->longText('content');
            $table->longText('image');
            $table->longText('blok1-title');
            $table->longText('blok1-content');
            $table->longText('blok1-image');
            $table->longText('blok2-title')->nullable();
            $table->longText('blok2-content')->nullable();
            $table->longText('blok2-image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};