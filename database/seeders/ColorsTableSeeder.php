<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Rojo'],
            ['name' => 'Azul'],
            ['name' => 'Negro'],
            ['name' => 'Blanco'],
            ['name' => 'Gris'],
            ['name' => 'Rosado'],
        ];

        DB::table('colors')->insert($colors);
    }
}
