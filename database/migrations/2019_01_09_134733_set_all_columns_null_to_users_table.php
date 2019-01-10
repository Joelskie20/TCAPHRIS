<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetAllColumnsNullToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('employee_id')->nullable()->change();
            $table->integer('position_id')->nullable()->change();
            $table->integer('department_id')->nullable()->change();
            $table->integer('team_id')->nullable()->change();
            $table->string('tax_status')->nullable()->change();
            $table->string('payment_frequency')->nullable()->change();
            $table->integer('direct_manager_id')->nullable()->change();
            $table->integer('workshift_id')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('middle_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->integer('gender_id')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->string('religion')->nullable()->change();


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
            $table->integer('employee_id')->nullable(false)->change();
            $table->integer('position_id')->nullable(false)->change();
            $table->integer('department_id')->nullable(false)->change();
            $table->integer('team_id')->nullable(false)->change();
            $table->string('tax_status')->nullable(false)->change();
            $table->string('payment_frequency')->nullable(false)->change();
            $table->integer('direct_manager_id')->nullable(false)->change();
            $table->integer('workshift_id')->nullable(false)->change();
            $table->string('first_name')->nullable(false)->change();
            $table->string('middle_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->integer('gender_id')->nullable(false)->change();
            $table->string('nationality')->nullable(false)->change();
            $table->string('religion')->nullable(false)->change();
        });
    }
}
