<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRejectionReasonNullable extends Migration
{
    public function up()
    {
        Schema::table('apply_scholarships', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->change(); // Ensure the column is nullable and of type text
        });
    }

    public function down()
    {
        Schema::table('apply_scholarships', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable(false)->change(); // Revert to non-nullable if rolled back
        });
    }
}