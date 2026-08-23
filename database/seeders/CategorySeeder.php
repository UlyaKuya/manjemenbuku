<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Pemrograman',
        ]);

        Category::create([
            'name' => 'Database',
        ]);

        Category::create([
            'name' => 'Peternakan',
        ]);

        Category::create([
            'name' => 'Bisnis',
        ]);
    }
}