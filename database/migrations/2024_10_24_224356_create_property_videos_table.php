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
        Schema::create('property_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id')->index('property_videos_property_id_foreign');
            $table->string('title', 100)->nullable();
            $table->string('file_name', 100)->nullable();
            $table->enum('video_type', ['YouTube', 'Vimeo'])->nullable()->default('YouTube');
            $table->string('video_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('main_video')->default(false);
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_videos', function (Blueprint $table) {
            $table->dropForeign('property_videos_property_id_foreign');
        });
        Schema::dropIfExists('property_videos');
    }
};
