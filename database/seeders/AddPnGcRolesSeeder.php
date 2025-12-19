<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPnGcRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 6, 'nombre' => 'Policía Nacional'],
            ['id' => 7, 'nombre' => 'Guardia Civil'],
            ['id' => 8, 'nombre' => 'Autoridad Portuaria'],
        ];

        foreach ($roles as $rol) {
            $exists = DB::table('roles')->where('id', $rol['id'])->orWhere('nombre', $rol['nombre'])->exists();
            if (!$exists) {
                DB::table('roles')->insert(array_merge($rol, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}


