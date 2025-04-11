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
        Schema::create('chinese_abilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('chinese_level');
            $table->string('hsk_score')->nullable();
            $table->string('hskk_grade')->nullable();
            $table->string('hssk_score')->nullable();
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chinese_abilities');
    }
};
