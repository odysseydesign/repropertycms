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
        Schema::create('property_gallery_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gallery_id')->index('property_gallery_images_gallery_id_foreign');
            $table->unsignedInteger('property_image_id');
            $table->bigInteger('featured_image')->default(0);
            $table->unsignedInteger('sequence')->default(0);
            $table->timestamps();
            $table->foreign('gallery_id')->references('id')->on('property_galleries')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_gallery_images', function (Blueprint $table) {
            $table->dropForeign('property_gallery_images_gallery_id_foreign');
        });
        Schema::dropIfExists('property_gallery_images');
    }
};
