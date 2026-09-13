<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->string('original_image_path');
            $table->string('model_3d_url')->nullable();
            $table->string('karat');
            $table->decimal('target_weight_grams', 8, 3)->nullable();
            $table->decimal('estimated_budget', 12, 2);
            $table->boolean('provides_own_gold')->default(false);
            $table->decimal('customer_gold_weight', 8, 3)->nullable();
            $table->decimal('design_token_paid', 10, 2)->default(0);
            $table->enum('payment_status', ['pending', 'slip_uploaded', 'verified', 'rejected'])->default('pending');
            $table->enum('manufacturing_status', ['inquiry', 'in_workshop', 'ready_for_dispatch', 'completed'])->default('inquiry');
            $table->string('payment_slip_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_orders');
    }
};
