<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $admin = Role::firstOrCreate(['name' => 'admin', 'title' => 'Admin', 'is_fixed' => true]);
        $manager = Role::firstOrCreate(['name' => 'manager', 'title' => 'manager', 'is_fixed' => true]);
        $employee = Role::firstOrCreate(['name' => 'employee', 'title' => 'employee', 'is_fixed' => true]);
        $user = Role::firstOrCreate(['name' => 'user', 'title' => 'user', 'is_fixed' => true]);

        // Create Permissions
        Permission::firstOrCreate(['name' => 'view_backend', 'is_fixed' => true]);
        Permission::firstOrCreate(['name' => 'edit_settings', 'is_fixed' => true]);
        Permission::firstOrCreate(['name' => 'view_logs', 'is_fixed' => true]);

        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $key => $perms) {
            Permission::firstOrCreate(['name' => $key, 'is_fixed' => true]);
        }

        // Assign Permissions to Roles
        $admin->givePermissionTo(Permission::get());

        // Assign Permissions to Roles
        $manager->givePermissionTo('view_backend');

        Schema::enableForeignKeyConstraints();
    }
}
