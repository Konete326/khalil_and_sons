<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gold_rates', function (Blueprint $table) {
            $table->string('karat', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('gold_rates', function (Blueprint $table) {
            $table->enum('karat', ['18K', '21K', '22K', '24K'])->change();
        });
    }
};
