<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Wahyudi Jayadana',
            'email' => 'jayadana@mail.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole(Role::where('name', 'admin')->first());
    }
}
