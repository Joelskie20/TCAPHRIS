<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDivisionAccountJobCodeIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('division_id')->after('position_id')->nullable();
            $table->unsignedInteger('account_id')->after('team_id')->nullable();
            $table->unsignedInteger('job_code_id')->after('account_id')->nullable();
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
            $table->dropColumn('division_id');
            $table->dropColumn('account_id');
            $table->dropColumn('job_code_id');
        });
    }
}
