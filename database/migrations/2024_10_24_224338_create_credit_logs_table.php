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
        Schema::create('credit_logs', function (Blueprint $table) {
            $table->increments('id')->comment('Credits spent and purchase log for agent');
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('property_id');
            $table->tinyInteger('credits');
            $table->enum('type', ['Spent', 'Bought']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_logs');
    }
};
