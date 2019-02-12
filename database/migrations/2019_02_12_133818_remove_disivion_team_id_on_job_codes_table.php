<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDisivionTeamIdOnJobCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('job_codes', function (Blueprint $table) {
            $table->dropColumn('division_id');
            $table->dropColumn('team_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('team_id')->nullable();
        });
    }
}
