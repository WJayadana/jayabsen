<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Daftar izin yang akan dibuat
        $permissions = [
            'lihat jurusan',
            'edit jurusan',
            'hapus jurusan',
            'lihat tingkat',
            'edit tingkat',
            'hapus tingkat',
            'lihat siswa',
            'edit siswa',
            'hapus siswa',
            'lihat device',
            'edit device',
            'hapus device',
            'lihat kartu',
            'hapus kartu',
            'lihat pengguna',
            'edit pengguna',
            'hapus pengguna',
            'lihat role permission',
            'tambah role permission',
            'edit role permission',
            'hapus role permission',
            'lihat permissions',
            'edit permissions',
            'hapus permissions',
            'lihat pengaturan',
            'edit pengaturan',
        ];

        // Buat izin jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role admin jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Buat pengguna admin jika belum ada
        $admin = User::firstOrCreate(
            ['email' => 'jayadana@mail.com'],
            ['name' => 'Wahyudi Jayadana', 'password' => bcrypt('password')]
        );

        // Berikan role admin kepada pengguna
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
