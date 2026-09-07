<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('population', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city')->unique()->constrained('cities')->cascadeOnDelete();
            $table->unsignedInteger('population');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('population');
    }
};
