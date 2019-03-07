<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCancelledFieldsToOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtimes', function (Blueprint $table) {
            $table->unsignedInteger('cancelled_by')->after('date_denied')->nullable();
            $table->timestamp('date_cancelled')->after('cancelled_by')->nullable();
            $table->text('cancelled_remarks')->after('denied_remarks')->nullable();
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
            $table->dropColumn('cancelled_by');
            $table->dropColumn('date_cancelled');
            $table->dropColumn('cancelled_remarks');
        });
    }
}
