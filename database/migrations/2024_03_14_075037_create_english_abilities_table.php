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
        Schema::create('english_abilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('english_level');
            $table->string('toefl')->nullable();
            $table->string('ielts')->nullable();
            $table->string('gre')->nullable();
            $table->string('gmat')->nullable();
            $table->string('other')->nullable();
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('english_abilities');
    }
};
