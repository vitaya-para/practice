<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminPassword = '12345678';
        $studentPassword = '12345678';

        $user = new User([
            'name' => 'Admin user',
            'email' => 'admin@admin.com',
            'password' => Hash::make($adminPassword),
            'role' => UserRole::ADMIN,
            'auth' => 'email',
            'active' => true,
            'is_admin' => true
        ]);
        $user->save();

        $userStudent = new User([
            'name' => 'Student user',
            'email' => 'student@student.com',
            'password' => Hash::make($studentPassword),
            'role' => UserRole::STUDENT,
            'auth' => 'email',
            'group_id' => '9930101/40001',
            'active' => true,
            'cas_id' => 'spbstu12345678',
        ]);
        $userStudent->save();
    }
}
