<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view department']);
        Permission::create(['name' => 'create department']);
        Permission::create(['name' => 'edit department']);
        Permission::create(['name' => 'delete department']);

        Permission::create(['name' => 'view position']);
        Permission::create(['name' => 'create position']);
        Permission::create(['name' => 'edit position']);
        Permission::create(['name' => 'delete position']);

        Permission::create(['name' => 'view staff']);
        Permission::create(['name' => 'create staff']);
        Permission::create(['name' => 'edit staff']);
        Permission::create(['name' => 'delete staff']);

        Permission::create(['name' => 'view device']);
        Permission::create(['name' => 'create device']);
        Permission::create(['name' => 'edit device']);
        Permission::create(['name' => 'delete device']);

        Permission::create(['name' => 'view rfid']);
        Permission::create(['name' => 'delete rfid']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view role permission']);
        Permission::create(['name' => 'create role permission']);
        Permission::create(['name' => 'edit role permission']);
        Permission::create(['name' => 'delete role permission']);

        Permission::create(['name' => 'view setting']);
        Permission::create(['name' => 'edit setting']);

        Permission::create(['name' => 'view presence']);

        Permission::create(['name' => 'view presence by date']);
        Permission::create(['name' => 'export excel presence by date']);
        Permission::create(['name' => 'export pdf presence by date']);

        Permission::create(['name' => 'view presence by staff']);
        Permission::create(['name' => 'export excel presence by staff']);
        Permission::create(['name' => 'export pdf presence by staff']);

        $adminRole = Role::create(['name' => 'admin']);
        $permissions = Permission::get();
        $adminRole->syncPermissions($permissions);

        $admin = User::create([
            'name' => 'Wahyudi Jayadana',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole($adminRole);
    }
}
