<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCancelledFieldsToLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->unsignedInteger('cancelled_by')->after('denied_remarks')->nullable();
            $table->timestamp('date_cancelled')->after('cancelled_by')->nullable();
            $table->text('cancelled_remarks')->after('date_cancelled')->nullable();
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
            $table->dropColumn('cancelled_by');
            $table->dropColumn('date_cancelled');
            $table->dropColumn('cancelled_remarks');
        });
    }
}
