<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('time_in')->unsigned()->nullable();
            $table->bigInteger('time_out')->unsigned()->nullable();
            $table->timestamp('filing_date')->nullable();
            $table->integer('direct_manager_id')->nullable();
            $table->integer('approved_by')->nullable();
            $table->timestamp('date_approved')->nullable();
            $table->integer('denied_by')->nullable();
            $table->timestamp('date_denied')->nullable();
            $table->text('remarks')->nullable();
            $table->text('approved_remarks')->nullable();
            $table->text('denied_remarks')->nullable();
            $table->string('status')->default('forApproval')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overtimes');
    }
}
