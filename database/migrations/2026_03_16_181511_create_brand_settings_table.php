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
        Schema::create('brand_settings', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color', 7)->default('#28ADC4');
            $table->string('secondary_color', 7)->default('#0069a6');
            $table->string('accent_color', 7)->default('#008a8f');
            $table->string('accent_2_color', 7)->default('#6f4693');
            $table->string('sidebar_color', 7)->default('#152636');
            $table->string('font_body', 100)->default('Lato');
            $table->string('font_heading', 100)->default('Julius Sans One');
            $table->string('font_admin', 100)->default('Lato');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_settings');
    }
};
