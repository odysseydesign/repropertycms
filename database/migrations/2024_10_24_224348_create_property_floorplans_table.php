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
        Schema::create('property_floorplans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id')->index('property_floorplans_property_id_foreign');
            $table->string('name', 100);
            $table->string('file_name', 512);
            $table->string('thumb')->nullable();
            $table->unsignedInteger('sequence');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_floorplans', function (Blueprint $table) {
            $table->dropForeign('property_floorplans_property_id_foreign');
        });
        Schema::dropIfExists('property_floorplans');
    }
};
