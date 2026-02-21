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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id');
            $table->integer('plan_id');
            $table->date('payment_date')->nullable();
            $table->string('payment_id')->nullable();
            $table->decimal('amount', 5)->nullable();
            $table->decimal('gateway_fees', 5)->nullable();
            $table->string('currency', 10)->nullable();
            $table->text('other')->nullable();
            $table->enum('status', ['Pending', 'Paid', 'Unpaid'])->default('Unpaid');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
