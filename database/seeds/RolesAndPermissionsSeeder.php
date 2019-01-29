<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'daily time records']);
        Permission::create(['name' => 'time in']);
        Permission::create(['name' => 'time out']);

        // create the superadmin role
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());

        User::find(1)->assignRole('superadmin');
    }
}
