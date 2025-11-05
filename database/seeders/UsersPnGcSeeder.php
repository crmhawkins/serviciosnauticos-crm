<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersPnGcSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Policía Nacional (rol 6)
        $pn = [
            'name' => 'pn_user',
            'surname' => 'Policía Nacional',
            'email' => 'pn@example.com',
            'username' => 'pn_user',
            'password' => Hash::make('Test1234!'),
            'role' => 6,
            'inactive' => 0,
            'user_department_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (!DB::table('users')->where('username', $pn['username'])->orWhere('email', $pn['email'])->exists()) {
            DB::table('users')->insert($pn);
        }

        // Usuario Guardia Civil (rol 7)
        $gc = [
            'name' => 'gc_user',
            'surname' => 'Guardia Civil',
            'email' => 'gc@example.com',
            'username' => 'gc_user',
            'password' => Hash::make('Test1234!'),
            'role' => 7,
            'inactive' => 0,
            'user_department_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (!DB::table('users')->where('username', $gc['username'])->orWhere('email', $gc['email'])->exists()) {
            DB::table('users')->insert($gc);
        }
    }
}


