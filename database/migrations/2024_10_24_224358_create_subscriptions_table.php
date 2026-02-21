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
//        Schema::create('subscriptions', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->integer('agent_id')->nullable();
//            $table->string('subscription_id')->nullable();
//            $table->string('customer_id')->nullable();
//            $table->string('billing')->nullable();
//            $table->timestamp('billing_cycle_anchor')->nullable();
//            $table->timestamp('start_date')->nullable();
//            $table->timestamp('cancel_at')->nullable();
//            $table->timestamp('ended_at')->nullable();
//            $table->string('cancel_at_period_end')->nullable();
//            $table->timestamp('canceled_at')->nullable();
//            $table->timestamp('created')->nullable();
//            $table->timestamp('current_period_end')->nullable();
//            $table->timestamp('current_period_start')->nullable();
//            $table->string('default_payment_method')->nullable();
//            $table->string('price_id')->nullable();
//            $table->decimal('amount', 8, 0)->nullable();
//            $table->integer('quantity')->nullable();
//            $table->string('interval')->nullable();
//            $table->string('interval_count')->nullable();
//            $table->string('product')->nullable();
//            $table->string('status')->nullable();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('subscriptions');
    }
};
