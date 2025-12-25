<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $guard = 'admin';

        // 1. Create Permissions
        $permissions = [
            'view dashboard',
            'manage admins',
            'manage roles',
            'manage products',
            'manage categories',
            'manage packages',
            'view bookings',
            'manage bookings', // update status, etc.
            'view payments',
            'view customers',
            'manage popups',
            'manage settings',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guard]);
        }

        // 2. Create Roles and Assign Permissions

        // Super Admin - All access
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => $guard]);
        // Super Admin gets all permissions implicitly via Gate::before rule or just assign all
        $superAdmin->givePermissionTo(Permission::all());

        // Manager - Everything except managing admins/roles and deleting critical stuff (logic handled in code)
        // For now, give them broad management access
        $manager = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => $guard]);
        $manager->givePermissionTo([
            'view dashboard',
            'manage products',
            'manage categories',
            'manage packages',
            'view bookings',
            'manage bookings',
            'view payments',
            'view customers',
            'manage popups',
            'view reports',
        ]);

        // Seller - Only Products (Inventory)
        $seller = Role::firstOrCreate(['name' => 'Seller', 'guard_name' => $guard]);
        $seller->givePermissionTo([
            'view dashboard',
            'manage products',
            'manage categories', // maybe view?
        ]);

        // Support - View Bookings, Update Status
        $support = Role::firstOrCreate(['name' => 'Support', 'guard_name' => $guard]);
        $support->givePermissionTo([
            'view dashboard',
            'view bookings',
            'manage bookings',
            'view customers',
        ]);

        // Marketing
        $marketing = Role::firstOrCreate(['name' => 'Marketing', 'guard_name' => $guard]);
        $marketing->givePermissionTo([
            'view dashboard',
            'manage popups',
            'view reports',
        ]);

        // 3. Assign Super Admin Role to Default Admin
        $adminEmail = 'admin@dahejsaman.com';
        $admin = Admin::where('email', $adminEmail)->first();

        if ($admin) {
            $admin->assignRole($superAdmin);
            $this->command->info("Role 'Super Admin' assigned to {$adminEmail}");
        } else {
            // Create if not exists (fallback)
            $admin = Admin::create([
                'name' => 'Super Admin',
                'email' => $adminEmail,
                'password' => Hash::make('password123'),
            ]);
            $admin->assignRole($superAdmin);
            $this->command->info("Created default admin and assigned 'Super Admin' role.");
        }
    }
}
