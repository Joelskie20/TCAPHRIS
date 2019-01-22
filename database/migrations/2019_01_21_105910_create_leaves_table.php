<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->date('leave_date')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('day_count')->nullable();
            $table->timestamp('filing_date')->nullable();
            $table->integer('approved_by')->nullable();
            $table->timestamp('date_approved')->nullable();
            $table->text('approved_remarks')->nullable();
            $table->integer('denied_by')->nullable();
            $table->timestamp('date_denied')->nullable();
            $table->text('denied_remarks')->nullable();
            $table->integer('direct_manager_id')->nullable();
            $table->text('approval_remarks')->nullable();
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
        Schema::dropIfExists('leaves');
    }
}
