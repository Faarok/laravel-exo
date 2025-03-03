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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('surface');
            $table->bigInteger('price');
            $table->text('description');
            $table->integer('room');
            $table->integer('bedroom');
            $table->integer('floor');
            $table->string('address');
            $table->string('town');
            $table->integer('zip');
            $table->boolean('sell');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
