<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    public function run()
    {
        $dishes = [
            [
                'name' => 'Брускетта с томатами и базиликом',
                'category_id' => 1, // Закуски
                'price' => 222.00,
                'description' => 'Хрустящий багет с сочными томатами, ароматным базиликом и оливковым маслом первого отжима.',
            ],
            [
                'name' => 'Шаурма классическая',
                'category_id' => 2, // Основные блюда
                'price' => 250.00,
                'description' => 'Сочная курица, свежие овощи и фирменный соус, завёрнутые в мягкий лаваш.',
            ],
            [
                'name' => 'Стейк из мраморной говядины',
                'category_id' => 2, // Основные блюда
                'price' => 1100.00,
                'description' => 'Нежный стейк средней прожарки из мраморной говядины с гарниром из овощей гриль.',
            ],
            [
                'name' => 'Тирамису',
                'category_id' => 3, // Десерты
                'price' => 190.00,
                'description' => 'Классический итальянский десерт с маскарпоне, кофе и савоярди, посыпанный какао.',
            ],
            [
                'name' => 'Домашний лимонад',
                'category_id' => 4, // Напитки
                'price' => 170.00,
                'description' => 'Освежающий лимонад из натуральных лимонов с лёгкой ноткой мяты.',
            ],
        ];

        foreach ($dishes as $dish) {
            Dish::updateOrCreate(
                ['name' => $dish['name']],
                [
                    'category_id' => $dish['category_id'],
                    'price' => $dish['price'],
                    'description' => $dish['description'],
                    'image' => null, // Можно добавить позже через админку
                ]
            );
        }
    }
}