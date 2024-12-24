<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание ролей
    $adminRole = Role::create(['name' => 'admin']);
    $userRole = Role::create(['name' => 'user']);

    // Создание прав
    Permission::create(['name' => 'edit articles']);
    Permission::create(['name' => 'delete articles']);

    // Привязка прав к ролям
    $adminRole->givePermissionTo('edit articles');
    $adminRole->givePermissionTo('delete articles');
    $userRole->givePermissionTo('edit articles');
    }
}
