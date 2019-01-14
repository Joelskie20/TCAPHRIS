<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshifts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code')->nullable();
            $table->string('name')->nullable();

            $table->string('monday_workshift')->nullable();
            $table->string('tuesday_workshift')->nullable();
            $table->string('wednesday_workshift')->nullable();
            $table->string('thursday_workshift')->nullable();
            $table->string('friday_workshift')->nullable();
            $table->string('saturday_workshift')->nullable();
            $table->string('sunday_workshift')->nullable();


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
        Schema::dropIfExists('workshifts');
    }
}
