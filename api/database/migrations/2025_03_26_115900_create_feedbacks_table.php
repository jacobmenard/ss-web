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
            $table->bigInteger('user_event_id')->nullable();
            $table->bigInteger('host_points')->nullable();
            $table->text('host_feedback')->nullable();
            
            $table->bigInteger('venue_points')->nullable();
            $table->text('venue_feedback')->nullable();
            
            $table->bigInteger('event_points')->nullable();
            $table->text('event_feedback')->nullable();
            
            $table->bigInteger('website_points')->nullable();
            $table->text('website_feedback')->nullable();
            
            $table->text('other_feedback')->nullable();
            
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
