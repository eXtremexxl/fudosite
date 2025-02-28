<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Закуски'],
            ['id' => 2, 'name' => 'Основные блюда'],
            ['id' => 3, 'name' => 'Десерты'],
            ['id' => 4, 'name' => 'Напитки'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                ['name' => $category['name']]
            );
        }
    }
}