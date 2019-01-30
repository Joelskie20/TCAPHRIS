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
        Permission::create(['name' => 'time in']);
        Permission::create(['name' => 'time out']);
        Permission::create(['name' => 'daily time records']);
        Permission::create(['name' => 'view DTR based on user ID']);
        Permission::create(['name' => 'departments']);
        Permission::create(['name' => 'add department']);
        Permission::create(['name' => 'edit department']);
        Permission::create(['name' => 'delete department']);
        Permission::create(['name' => 'teams']);
        Permission::create(['name' => 'add team']);
        Permission::create(['name' => 'edit team']);
        Permission::create(['name' => 'delete team']);
        Permission::create(['name' => 'positions']);
        Permission::create(['name' => 'add position']);
        Permission::create(['name' => 'edit position']);
        Permission::create(['name' => 'delete position']);
        Permission::create(['name' => 'workshifts']);
        Permission::create(['name' => 'add workshift']);
        Permission::create(['name' => 'edit workshift']);
        Permission::create(['name' => 'delete workshift']);
        Permission::create(['name' => 'holidays']);
        Permission::create(['name' => 'add holiday']);
        Permission::create(['name' => 'edit holiday']);
        Permission::create(['name' => 'delete holiday']);

        // create the superadmin role and assign all permissions
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());

        // assign the superadmin role to my self
        // User::find(1)->assignRole('superadmin');

        // assign the superadmin role to all users in seeding
        foreach(User::all() as $user) {
            $user->assignRole('superadmin');
        }

        // create roles without permissions
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'coder']);
        Role::create(['name' => 'bridge director']);
    }
}
