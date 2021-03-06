<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            PositionsTableSeeder::class,
            DepartmentsTableSeeder::class,
            TeamsTableSeeder::class,
            GendersTableSeeder::class,
            WorkshiftsTableSeeder::class
        ]);
    }
}
