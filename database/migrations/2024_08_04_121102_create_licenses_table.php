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
        Schema::create('licenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('license', 255);
            $table->string('email', 255);
            $table->string('product_permalink', 255);
            $table->string('product_name', 255);
            $table->string('price', 255)->nullable();
            $table->string('ip_country', 255)->nullable();
            $table->string('recurrence', 255)->nullable();
            $table->integer('uses');
            $table->string('product_code', 255);
            $table->timestamp('sale_timestamp');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('subscription_ended_at')->nullable();
            $table->timestamp('subscription_cancelled_at')->nullable();
            $table->timestamp('subscription_failed_at')->nullable();

            $table->timestamps();
        });

        // Create the pivot table for the many-to-many relationship
        Schema::create('figma_user_license', function (Blueprint $table) {
            $table->uuid('license_id');
            $table->uuid('figma_user_id');

            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
            $table->foreign('figma_user_id')->references('id')->on('figma_users')->onDelete('cascade');

            $table->primary(['license_id', 'figma_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('figma_user_license');
        Schema::dropIfExists('licenses');
    }
};
