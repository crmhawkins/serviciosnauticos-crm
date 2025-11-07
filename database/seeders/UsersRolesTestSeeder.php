<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersRolesTestSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'secretaria_test',
                'surname' => 'Secretaría (test)',
                'email' => 'secretaria@test.local',
                'username' => 'secretaria_test',
                'password' => Hash::make('Test1234!'),
                'role' => 2, // Secretaría
                'inactive' => 0,
                'user_department_id' => 1,
            ],
            [
                'name' => 'comodoro_test',
                'surname' => 'Comodoro (test)',
                'email' => 'comodoro@test.local',
                'username' => 'comodoro_test',
                'password' => Hash::make('Test1234!'),
                'role' => 3, // Comodoro
                'inactive' => 0,
                'user_department_id' => 1,
            ],
            [
                'name' => 'marinero_test',
                'surname' => 'Marinero (test)',
                'email' => 'marinero@test.local',
                'username' => 'marinero_test',
                'password' => Hash::make('Test1234!'),
                'role' => 4, // Marinero
                'inactive' => 0,
                'user_department_id' => 1,
            ],
            [
                'name' => 'info_test',
                'surname' => 'Acceso info (test)',
                'email' => 'info@test.local',
                'username' => 'info_test',
                'password' => Hash::make('Test1234!'),
                'role' => 5, // Acceso info
                'inactive' => 0,
                'user_department_id' => 1,
            ],
        ];

        foreach ($users as $u) {
            $exists = DB::table('users')
                ->where('username', $u['username'])
                ->orWhere('email', $u['email'])
                ->exists();
            if (!$exists) {
                $u['created_at'] = now();
                $u['updated_at'] = now();
                DB::table('users')->insert($u);
            }
        }
    }
}



