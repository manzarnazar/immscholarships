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
        Schema::create('contact_info_applicants', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->integer('phone');
            $table->integer('telephone');
            $table->string('postcode');
            $table->string('email');
            $table->string('physical_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_info_applicants');
    }
};
