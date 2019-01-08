<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonalInformationColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('workshift_id');
            $table->string('middle_name')->after('first_name');
            $table->string('last_name')->after('middle_name');
            $table->timestamp('birth_date')->after('last_name');
            $table->string('nationality')->after('gender_id');
            $table->string('religion')->after('nationality');
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
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('birth_date');
            $table->dropColumn('nationality');
            $table->dropColumn('religion');
        });
    }
}
