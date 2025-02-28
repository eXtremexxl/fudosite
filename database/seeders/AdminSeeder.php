<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@fudo.com',
            'password' => Hash::make('admin123'), // Пароль: admin123
            'is_admin' => 1, // Администратор
        ];

        User::updateOrCreate(
            ['email' => $admin['email']], // Уникальный ключ по email
            [
                'name' => $admin['name'],
                'password' => $admin['password'],
                'is_admin' => $admin['is_admin'],
            ]
        );
    }
}