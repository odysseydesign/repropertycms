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
        Schema::create('property_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('property_id')->index('property_documents_property_id_foreign');
            $table->string('name')->nullable();
            $table->string('file_name', 512);
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_documents', function (Blueprint $table) {
            $table->dropForeign('property_documents_property_id_foreign');
        });
        Schema::dropIfExists('property_documents');
    }
};
