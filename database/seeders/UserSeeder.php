<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Administrator',
                'email' => 'superadmin@app.test',
                'password' => 'password',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@app.test',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Petugas Perpustakaan',
                'email' => 'petugas@app.test',
                'password' => 'password',
                'role' => 'petugas',
            ],
            [
                'name' => 'Anggota',
                'email' => 'member@app.test',
                'password' => 'password',
                'role' => 'member',
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                ]
            );

            $user->assignRole($data['role']);
        }
    }
}
