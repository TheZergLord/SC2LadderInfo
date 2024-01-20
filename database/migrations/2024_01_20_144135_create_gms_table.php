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
        Schema::create('gms', function (Blueprint $table) {
            $table->id();
            $table->string('displayName')->nullable();
            $table->string('race')->nullable();
            $table->string('clan')->nullable();
            $table->integer('mmr')->nullable();
            $table->integer('points')->nullable();
            $table->integer('wins')->nullable();
            $table->integer('losses')->nullable();
            $table->unsignedBigInteger('region_id');
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gms');
    }
};
