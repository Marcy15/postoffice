<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('population', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('city')->unique();
            $table->integer('population');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('population');
    }
};
