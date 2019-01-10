<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('present_unit_number')->after('religion')->nullable();
            $table->string('present_building_number')->after('present_unit_number')->nullable();
            $table->string('present_street_name')->after('present_building_number')->nullable();
            $table->string('present_subdivision')->after('present_street_name')->nullable();
            $table->integer('present_barangay_id')->after('present_subdivision')->nullable();
            $table->integer('present_city_id')->after('present_barangay_id')->nullable();
            $table->integer('present_province_id')->after('present_city_id')->nullable();
            $table->integer('present_country_id')->after('present_province_id')->nullable();
            $table->integer('present_zip_code_id')->after('present_country_id')->nullable();

            $table->string('permanent_unit_number')->after('present_zip_code_id')->nullable();
            $table->string('permanent_building_number')->after('permanent_unit_number')->nullable();
            $table->string('permanent_street_name')->after('permanent_building_number')->nullable();
            $table->string('permanent_subdivision')->after('permanent_street_name')->nullable();
            $table->integer('permanent_barangay_id')->after('permanent_subdivision')->nullable();
            $table->integer('permanent_city_id')->after('permanent_barangay_id')->nullable();
            $table->integer('permanent_province_id')->after('permanent_city_id')->nullable();
            $table->integer('permanent_country_id')->after('permanent_province_id')->nullable();
            $table->integer('permanent_zip_code_id')->after('permanent_country_id')->nullable();

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
            $table->string('present_unit_number');
            $table->string('present_building_number');
            $table->string('present_street_name');
            $table->string('present_subdivision');
            $table->integer('present_barangay_id');
            $table->integer('present_city_id');
            $table->integer('present_province_id');
            $table->integer('present_country_id');
            $table->integer('present_zip_code_id');

            $table->string('permanent_unit_number');
            $table->string('permanent_building_number');
            $table->string('permanent_street_name');
            $table->string('permanent_subdivision');
            $table->integer('permanent_barangay_id');
            $table->integer('permanent_city_id');
            $table->integer('permanent_province_id');
            $table->integer('permanent_country_id');
            $table->integer('permanent_zip_code_id');
        });
    }
}
