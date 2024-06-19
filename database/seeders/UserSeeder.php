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
        Permission::create(['name' => 'view jurusan']);
        Permission::create(['name' => 'create jurusan']);
        Permission::create(['name' => 'edit jurusan']);
        Permission::create(['name' => 'delete jurusan']);

        Permission::create(['name' => 'view tingkat']);
        Permission::create(['name' => 'create tingkat']);
        Permission::create(['name' => 'edit tingkat']);
        Permission::create(['name' => 'delete tingkat']);

        Permission::create(['name' => 'view siswa']);
        Permission::create(['name' => 'create siswa']);
        Permission::create(['name' => 'edit siswa']);
        Permission::create(['name' => 'delete siswa']);

        Permission::create(['name' => 'view device']);
        Permission::create(['name' => 'create device']);
        Permission::create(['name' => 'edit device']);
        Permission::create(['name' => 'delete device']);

        Permission::create(['name' => 'view kartu']);
        Permission::create(['name' => 'delete kartu']);

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

        Permission::create(['name' => 'view absensi']);

        Permission::create(['name' => 'view absensi by date']);
        Permission::create(['name' => 'export excel absensi by date']);
        Permission::create(['name' => 'export pdf absensi by date']);

        Permission::create(['name' => 'view absensi by siswa']);
        Permission::create(['name' => 'export excel absensi by siswa']);
        Permission::create(['name' => 'export pdf absensi by siswa']);

        $adminRole = Role::create(['name' => 'admin']);
        $permissions = Permission::get();
        $adminRole->syncPermissions($permissions);

        $admin = User::create([
            'name' => 'Wahyudi Jayadana',
            'email' => 'jayadana@mail.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($adminRole);
    }
}
