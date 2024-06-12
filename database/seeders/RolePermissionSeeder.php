<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'lihat jurusan']);
        Permission::create(['name' => 'edit jurusan']);
        Permission::create(['name' => 'hapus jurusan']);
        Permission::create(['name' => 'lihat tingkat']);
        Permission::create(['name' => 'edit tingkat']);
        Permission::create(['name' => 'hapus tingkat']);
        Permission::create(['name' => 'lihat siswa']);
        Permission::create(['name' => 'edit siswa']);
        Permission::create(['name' => 'hapus siswa']);
        Permission::create(['name' => 'lihat device']);
        Permission::create(['name' => 'edit device']);
        Permission::create(['name' => 'hapus device']);
        Permission::create(['name' => 'lihat kartu']);
        Permission::create(['name' => 'hapus kartu']);
        Permission::create(['name' => 'lihat pengguna']);
        Permission::create(['name' => 'edit pengguna']);
        Permission::create(['name' => 'hapus pengguna']);
        Permission::create(['name' => 'lihat role permission']);
        Permission::create(['name' => 'edit role permission']);
        Permission::create(['name' => 'hapus role permission']);
        Permission::create(['name' => 'lihat permissions']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'hapus permissions']);
        Permission::create(['name' => 'lihat pengaturan']);
        Permission::create(['name' => 'edit pengaturan']);

        $adminRole = Role::create(['name' => 'admin']);
        $permissions = Permission::get();
        $adminRole->syncPermissions($permissions);
    }
}
