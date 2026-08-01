<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::insert([

            [
                'name' => 'books.view',
                'label' => 'Lihat Buku',
                'category' => 'books',
            ],

            [
                'name' => 'books.create',
                'label' => 'Tambah Buku',
                'category' => 'books',
            ],

            [
                'name' => 'books.update',
                'label' => 'Edit Buku',
                'category' => 'books',
            ],

            [
                'name' => 'books.delete',
                'label' => 'Hapus Buku',
                'category' => 'books',
            ],

        ]);
    }
}