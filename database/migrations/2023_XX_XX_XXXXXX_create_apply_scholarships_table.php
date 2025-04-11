<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyScholarshipsTable extends Migration
{
    public function up()
    {
        Schema::create('apply_scholarships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('application_id')->unique();
            $table->uuid('student_id');
            $table->uuid('scholarship_id');
            $table->decimal('application_fee', 8, 2)->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->text('rejection_reason')->nullable(); // Changed to text to handle longer content
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('scholarship_id')->references('id')->on('scholarships')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apply_scholarships');
    }
}