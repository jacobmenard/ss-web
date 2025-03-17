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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('fb_first_note')->nullable();
            $table->bigInteger('fb_first_rate')->nullable();
            $table->string('fb_second_note')->nullable();
            $table->bigInteger('fb_second_rate')->nullable();
            $table->string('fb_third_note')->nullable();
            $table->bigInteger('fb_third_rate')->nullable();
            $table->string('fb_fourth_note')->nullable();
            $table->bigInteger('fb_fourth_rate')->nullable();
            $table->string('others')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
