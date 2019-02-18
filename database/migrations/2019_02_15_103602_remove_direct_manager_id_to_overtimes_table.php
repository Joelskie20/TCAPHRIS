<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDirectManagerIdToOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtimes', function (Blueprint $table) {
            $table->dropColumn('direct_manager_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overtimes', function (Blueprint $table) {
            $table->unsignedInteger('direct_manager_id')->after('filing_date')->nullable();
        });
    }
}
