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
        Schema::create('property_floorplan_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('property_floorplan_id')->index('property_floorplan_images_property_floorplan_id_foreign');
            $table->unsignedInteger('property_image_id')->index('property_image_id');
            $table->string('coordinates', 50);
            $table->string('floorplan_image_ratio', 50)->nullable();
            $table->timestamps();
            $table->foreign('property_image_id')->references('id')->on('property_images')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('property_floorplan_id')->references('id')->on('property_floorplans')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_floorplan_images', function (Blueprint $table) {
            $table->dropForeign('property_floorplan_images_ibfk_1');
            $table->dropForeign('property_floorplan_images_property_floorplan_id_foreign');
        });
        Schema::dropIfExists('property_floorplan_images');
    }
};
