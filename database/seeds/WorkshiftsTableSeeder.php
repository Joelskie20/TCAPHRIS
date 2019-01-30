<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkshiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workshifts')->insert([
            [
                'code' => 'REG-MF-8A5P-SSR',
                'name' => 'Regular Monday-Friday 8AM-5PM Sat-Sun Restday',
                'monday_workshift' => '800-1700,8.0',
                'tuesday_workshift' => '800-1700,8.0',
                'wednesday_workshift' => '800-1700,8.0',
                'thursday_workshift' => '800-1700,8.0',
                'friday_workshift' => '800-1700,8.0',
                'saturday_workshift' => 'RD',
                'sunday_workshift' => 'RD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'NGT-THM-9P6A-MTR',
                'name' => 'Night Shift 9PM-6AM Monday-Tuesday Restday',
                'monday_workshift' => 'RD',
                'tuesday_workshift' => 'RD',
                'wednesday_workshift' => '2100-600,8.0',
                'thursday_workshift' => '2100-600,8.0',
                'friday_workshift' => '2100-600,8.0',
                'saturday_workshift' => '2100-600,8.0',
                'sunday_workshift' => '2100-600,8.0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'MRG-MF-6A3P-SSR',
                'name' => 'Morning Monday-Friday 6AM-3PM Sat-Sun Restday',
                'monday_workshift' => '600-1500,8.0',
                'tuesday_workshift' => '600-1500,8.0',
                'wednesday_workshift' => '600-1500,8.0',
                'thursday_workshift' => '600-1500,8.0',
                'friday_workshift' => '600-1500,8.0',
                'saturday_workshift' => 'RD',
                'sunday_workshift' => 'RD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
