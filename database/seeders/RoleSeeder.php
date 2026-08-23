<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'superadmin',
                'label' => 'Super Administrator',
                'description' => 'Mengelola seluruh sistem',
            ],
            [
                'name' => 'admin',
                'label' => 'Administrator',
                'description' => 'Mengelola seluruh data',
            ],
            [
                'name' => 'petugas',
                'label' => 'Petugas Perpustakaan',
                'description' => 'Mengelola operasional perpustakaan',
            ],
            [
                'name' => 'member',
                'label' => 'Anggota',
                'description' => 'Pengguna perpustakaan',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                [
                    'label' => $role['label'],
                    'description' => $role['description'],
                ]
            );
        }
    }
}