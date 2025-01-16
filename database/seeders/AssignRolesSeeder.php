<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;


class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Найдем пользователя и присвоим ему роль
        $user = User::find(1); // Найдем пользователя с id 1
        if ($user) {
            $user->assignRole('admin'); // Присваиваем роль 'admin'
        }
    }
}
