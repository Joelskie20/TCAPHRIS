<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGovernmentDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tin_number')->after('permanent_zip_code_id')->nullable();
            $table->string('sss_number')->after('tin_number')->nullable();
            $table->string('philhealth_number')->after('sss_number')->nullable();
            $table->string('pagibig_number')->after('philhealth_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tin_number');
            $table->dropColumn('sss_number');
            $table->dropColumn('philhealth_number');
            $table->dropColumn('pagibig_number');
        });
    }
}
