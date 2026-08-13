<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = AdminUser::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'nama' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('password123'),
                'role' => 'superadmin',
            ]
        );

        $admin->syncRoles('superadmin');
    }
}
