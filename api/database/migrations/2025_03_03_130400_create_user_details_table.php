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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('preferred_gender')->nullable();
            $table->integer('preferred_height_from')->nullable();
            $table->integer('preferred_height_to')->nullable();
            $table->integer('preferred_age_from')->nullable();
            $table->integer('preferred_age_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
