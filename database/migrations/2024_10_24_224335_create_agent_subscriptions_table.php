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
        Schema::create('agent_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('payment_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('property_count', 50);
            $table->string('duration', 10);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_subscriptions');
    }
};
