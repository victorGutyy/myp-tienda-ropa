<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        $sizes = [
            ['label' => '37'],
            ['label' => '38'],
            ['label' => '39'],
            ['label' => '40'],
            ['label' => 'S'],
            ['label' => 'M'],
            ['label' => 'L'],
            ['label' => 'XL'],
        ];

        DB::table('sizes')->insert($sizes);
    }
    
}
