<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
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

            [
                'name' => 'categories.view',
                'label' => 'Lihat Kategori',
                'category' => 'categories',
            ],
            [
                'name' => 'categories.create',
                'label' => 'Tambah Kategori',
                'category' => 'categories',
            ],
            [
                'name' => 'categories.update',
                'label' => 'Edit Kategori',
                'category' => 'categories',
            ],
            [
                'name' => 'categories.delete',
                'label' => 'Hapus Kategori',
                'category' => 'categories',
            ],

            [
                'name' => 'users.view',
                'label' => 'Lihat User',
                'category' => 'users',
            ],
            [
                'name' => 'users.create',
                'label' => 'Tambah User',
                'category' => 'users',
            ],
            [
                'name' => 'users.update',
                'label' => 'Edit User',
                'category' => 'users',
            ],
            [
                'name' => 'users.delete',
                'label' => 'Hapus User',
                'category' => 'users',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                [
                    'label' => $permission['label'],
                    'category' => $permission['category'],
                ]
            );
        }
    }
}
