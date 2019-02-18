<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveExtraManagersToLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropColumn('direct_manager_id_two');
            $table->dropColumn('direct_manager_id_three');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->unsignedInteger('direct_manager_id_two')->after('denied_remarks')->nullable();
            $table->unsignedInteger('direct_manager_id_three')->after('direct_manager_id_two')->nullable();
        });
    }
}
