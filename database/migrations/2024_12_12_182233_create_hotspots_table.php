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
        Schema::create('hotspots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_floorplans_id');
            $table->decimal('top', 5, 3);
            $table->decimal('left', 5, 3);
            $table->decimal('height', 5, 3);
            $table->decimal('width', 5, 3);
            $table->timestamps();

            $table->foreign('property_floorplans_id')->references('id')->on('property_floorplans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspots');
    }
};
