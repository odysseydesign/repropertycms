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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agent_id')->nullable()->index('properties_agent_id_foreign');
            $table->string('name', 100);
            $table->string('headline', 500)->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('bedroom')->nullable();
            $table->string('bedroom_image')->nullable();
            $table->unsignedTinyInteger('bathroom')->nullable();
            $table->string('bathroom_image')->nullable();
            $table->unsignedTinyInteger('garage')->nullable();
            $table->unsignedTinyInteger('parking_spaces')->nullable();
            $table->string('unique_url', 50);
            $table->string('address_line_1', 100)->nullable();
            $table->string('price', 20)->nullable();
            $table->string('property_area', 20)->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state_id', 50)->nullable();
            $table->integer('country_id')->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->unsignedTinyInteger('levels')->nullable();
            $table->string('levels_image')->nullable();
            $table->string('matterport_data', 100);
            $table->date('publish_date')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('published')->default(false);
            $table->integer('featured_image')->default(0);
            $table->string('video_credit')->nullable();
            $table->string('photographer_credit')->nullable();
            $table->enum('main_section', ['Video', 'Slider', 'Image'])->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->boolean('reviewed')->nullable();
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->index('expiry_date', 'idx_properties_expiry_date');
            $table->index(['agent_id', 'expiry_date'], 'idx_properties_agent_expiry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('properties_agent_id_foreign');
            $table->dropIndex('idx_properties_expiry_date');
            $table->dropIndex('idx_properties_agent_expiry');
        });
        Schema::dropIfExists('properties');
    }
};
