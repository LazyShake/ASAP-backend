<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем роль администратора, если она не существует
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Создаем пользователя администратора
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Уникальное поле для проверки
            [
                'name' => 'Administrator',
                'password' => Hash::make('12345'), // Замените на безопасный пароль
            ]
        );

        // Присваиваем пользователю роль администратора
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}