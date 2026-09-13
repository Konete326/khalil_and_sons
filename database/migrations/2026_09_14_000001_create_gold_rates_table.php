<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gold_rates', function (Blueprint $table) {
            $table->id();
            $table->enum('karat', ['18K', '21K', '22K', '24K']);
            $table->decimal('rate_per_gram', 10, 2);
            $table->decimal('rate_per_tola', 10, 2);
            $table->timestamp('effective_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gold_rates');
    }
};
