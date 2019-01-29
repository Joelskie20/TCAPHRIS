<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'employee_id' => '2170043',
            'first_name' => 'Kiel',
            'middle_name' => 'Legaspi',
            'last_name' => 'Jose',
            'base_salary' => 40000.00,
            'nationality' => 'Filipino',
            'religion' => 'Christian',
            'email' => 'kiel.legaspi.jose@gmail.com',
            'mobile_number' => '09216511870',
            'landline' => '9902483',
            'password' => Hash::make('2170043'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
