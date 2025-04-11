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
        Schema::table('apply_scholarships', function (Blueprint $table) {
            $table->string('payment_status')->default('unpaid');
            $table->integer('application_fee')->default(150);
            $table->string('documents_attachment')->default('');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_scholarships', function (Blueprint $table) {
            //
        });
    }
};
