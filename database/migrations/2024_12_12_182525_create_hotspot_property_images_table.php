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
        Schema::create('hotspot_property_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotspot_id');
            $table->unsignedBigInteger('property_images_id');

            $table->foreign('hotspot_id')->references('id')->on('hotspots')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspot_property_images');
    }
};
