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
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id')->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email');
            $table->string('password', 75);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('credit_balance')->default(0);
            $table->string('verification_code')->default('0');
            $table->boolean('active')->default(true);
            $table->boolean('deleted')->default(false);
            $table->string('profile_image', 100)->nullable();
            $table->string('facebook_profile')->nullable();
            $table->string('instagram_profile')->nullable();
            $table->string('twitter_profile')->nullable();
            $table->string('linkedin_profile')->nullable();
            $table->string('logo_image', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
