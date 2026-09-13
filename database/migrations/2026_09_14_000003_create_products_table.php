<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('karat');
            $table->decimal('gross_weight_grams', 8, 3);
            $table->decimal('net_gold_weight_grams', 8, 3);
            $table->decimal('making_charges', 10, 2);
            $table->decimal('gemstone_cost', 10, 2)->default(0);
            $table->text('stone_description')->nullable();
            $table->json('images');
            $table->string('model_3d_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
