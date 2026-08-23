<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = Role::where('name', 'superadmin')->first();
        $admin      = Role::where('name', 'admin')->first();
        $petugas    = Role::where('name', 'petugas')->first();
        $member     = Role::where('name', 'member')->first();

        // Ambil semua permission
        $permissions = Permission::pluck('id', 'name');

        // Super Admin
        $superadmin->permissions()->sync([
            $permissions['books.view'],
            $permissions['books.create'],
            $permissions['books.update'],
            $permissions['books.delete'],

            $permissions['users.view'],
            $permissions['users.create'],
            $permissions['users.update'],
            $permissions['users.delete'],
        ]);

        // Admin
        $admin->permissions()->sync([
            $permissions['books.view'],
            $permissions['books.create'],
            $permissions['books.update'],
            $permissions['books.delete'],

            $permissions['users.view'],
            $permissions['users.create'],
            $permissions['users.update'],
            $permissions['users.delete'],
        ]);

        // Petugas
        $petugas->permissions()->sync([
            $permissions['books.view'],
            $permissions['books.create'],
            $permissions['books.update'],
            
        ]);

        // Member
        $member->permissions()->sync([
            $permissions['books.view'],
        ]);
    }
}
