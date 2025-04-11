<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApplicationFeeDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_scholarships', function (Blueprint $table) {
            // Update the default value of the 'application_fee' column
            $table->integer('application_fee')->default(250)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apply_scholarships', function (Blueprint $table) {
            // Revert the default value to 150
            $table->integer('application_fee')->default(150)->change();
        });
    }
}
