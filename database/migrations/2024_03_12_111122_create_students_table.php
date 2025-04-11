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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('country_origin');
            $table->date('dob');
            $table->string('country_of_birth');
            $table->string('place_of_birth');
            $table->string('gender');
            $table->string('chinese_name');
            $table->string('highest_education');
            $table->string('native_language');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('profession');
            $table->string('hobby');
            $table->string('health_status');
            $table->string('current_address');
            $table->string('current_city');
            $table->string('available_in_china');
            $table->integer('mobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
