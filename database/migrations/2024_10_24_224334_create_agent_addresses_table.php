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
        Schema::create('agent_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agent_id')->index('agent_addresses_agent_id_foreign');
            $table->string('business_name', 100)->nullable();
            $table->string('phone', 50);
            $table->text('address');
            $table->string('city', 100);
            $table->integer('state_id');
            $table->integer('country_id');
            $table->string('zip', 10);
            $table->timestamps();
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agent_addresses', function (Blueprint $table) {
            $table->dropForeign('agent_addresses_agent_id_foreign');
        });
        Schema::dropIfExists('agent_addresses');
    }
};
