<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@app.test',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@app.test',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Petugas Perpustakaan',
            'email' => 'petugas@app.test',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Anggota',
            'email' => 'member@app.test',
            'password' => Hash::make('password'),
        ]);
    }
}