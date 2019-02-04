<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;

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
            [
                'username' => '2170043',
                'email' => 'janszen-kiel.jose1@trans-cosmos.co.jp',
                'mobile_number' => null,
                'landline' => null,
                'password' => Hash::make('2170043'),
                'employee_id' => '2170043',
                'position_id' => 3,
                'department_id' => 1,
                'team_id' => 1,
                'base_salary' => 0,
                'tax_status' => 's',
                'payment_frequency' => 'monthly',
                'direct_manager_id' => 0,
                'workshift_id' => 1,
                'first_name' => 'Kiel',
                'middle_name' => 'Legaspi',
                'last_name' => 'Jose',
                'gender_id' => 1,
                'nationality' => 'Filipino',
                'religion' => 'Roman Catholic',
                'mobile_number' => '09216511870',
                'landline' => '9902483',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => '2150028',
                'email' => 'ryan-michael.reyes1@trans-cosmos.co.jp',
                'mobile_number' => '09278540425',
                'landline' => null,
                'password' => Hash::make('2150028'),
                'employee_id' => '2150028',
                'position_id' => 4,
                'department_id' => 1,
                'team_id' => 1,
                'base_salary' => 0,
                'tax_status' => 's1',
                'payment_frequency' => 'monthly',
                'direct_manager_id' => 0,
                'workshift_id' => 1,
                'first_name' => 'Ryan Michael',
                'middle_name' => 'Lao',
                'last_name' => 'Reyes',
                'gender_id' => 1,
                'nationality' => 'Filipino',
                'religion' => 'Roman Catholic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => '2170052',
                'email' => 'christian.alde1@trans-cosmos.co.jp',
                'mobile_number' => null,
                'landline' => null,
                'password' => Hash::make('2170052'),
                'employee_id' => '2170052',
                'position_id' => 3,
                'department_id' => 1,
                'team_id' => 1,
                'base_salary' => 0,
                'tax_status' => 's',
                'payment_frequency' => 'monthly',
                'direct_manager_id' => 0,
                'workshift_id' => 1,
                'first_name' => 'Christian',
                'middle_name' => 'Viray',
                'last_name' => 'Alde',
                'gender_id' => 1,
                'nationality' => 'Filipino',
                'religion' => 'Roman Catholic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => '2170132',
                'email' => 'bonaagua.janet1@trans-cosmos.co.jp	',
                'mobile_number' => null,
                'landline' => null,
                'password' => Hash::make('2170132'),
                'employee_id' => '2170132',
                'position_id' => 3,
                'department_id' => 1,
                'team_id' => 1,
                'base_salary' => 0,
                'tax_status' => 's',
                'payment_frequency' => 'monthly',
                'direct_manager_id' => 0,
                'workshift_id' => 1,
                'first_name' => 'Janet',
                'middle_name' => 'Cruz',
                'last_name' => 'Bonaagua',
                'gender_id' => 2,
                'nationality' => 'Filipino',
                'religion' => 'Roman Catholic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => '2150088',
                'email' => 'antonio.aduna1@trans-cosmos.co.jp',
                'mobile_number' => null,
                'landline' => null,
                'password' => Hash::make('2150088'),
                'employee_id' => '2150088',
                'position_id' => 4,
                'department_id' => 1,
                'team_id' => 1,
                'base_salary' => 0,
                'tax_status' => 's',
                'payment_frequency' => 'monthly',
                'direct_manager_id' => 0,
                'workshift_id' => 1,
                'first_name' => 'Antonio',
                'middle_name' => null,
                'last_name' => 'Aduna',
                'gender_id' => 1,
                'nationality' => 'Filipino',
                'religion' => 'Roman Catholic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
