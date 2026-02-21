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
        Schema::create('property_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('property_id')->index('property_images_property_id_foreign');
            $table->string('file_name', 512);
            $table->string('thumb')->nullable();
            $table->string('small')->nullable();
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_images', function (Blueprint $table) {
            $table->dropForeign('property_images_property_id_foreign');
        });
        Schema::dropIfExists('property_images');
    }
};
