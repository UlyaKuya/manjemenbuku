<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'superadmin',
            'label' => 'Super Administrator',
            'description' => 'Mengelola seluruh sistem',
        ]);

        Role::create([
            'name' => 'admin',
            'label' => 'Administrator',
            'description' => 'Mengelola seluruh data buku',
        ]);

        Role::create([
            'name' => 'petugas',
            'label' => 'Petugas Perpustakaan',
            'description' => 'Mengelola operasional perpustakaan',
        ]);

        Role::create([
            'name' => 'member',
            'label' => 'Anggota',
            'description' => 'Pengguna perpustakaan',
        ]);
    }
}