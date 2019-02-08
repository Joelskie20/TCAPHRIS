<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('team_id')->nullable();
            $table->unsignedInteger('account_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('job_codes');
    }
}
