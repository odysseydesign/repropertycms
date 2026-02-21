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
        Schema::create('property_matterport', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('property_id')->index('property_matterport_property_id_foreign');
            $table->string('matterport_url', 500);
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_matterport', function (Blueprint $table) {
            $table->dropForeign('property_matterport_property_id_foreign');
        });
        Schema::dropIfExists('property_matterport');
    }
};
