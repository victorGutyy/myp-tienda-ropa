<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        // Tenis (tenis1 - tenis12)
        for ($i = 1; $i <= 12; $i++) {
            $products[] = [
                'name' => 'Tenis ' . $i,
                'price' => 150000,
                'image' => 'assets/img/tenis' . $i . '.png',
                'category' => 'Tenis',
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Camisas (camisa1 - camisa6)
        for ($i = 1; $i <= 6; $i++) {
            $products[] = [
                'name' => 'Camisa ' . $i,
                'price' => 80000,
                'image' => 'assets/img/camisa' . $i . '.png',
                'category' => 'Ropa Masculina',
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Pantalones (pantalon1 - pantalon6)
        for ($i = 1; $i <= 6; $i++) {
            $products[] = [
                'name' => 'Pantalón ' . $i,
                'price' => 90000,
                'image' => 'assets/img/pantalon' . $i . '.png',
                'category' => 'Ropa Masculina',
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Prendas femeninas (prenda_femenina1 - prenda_femenina12)
        for ($i = 1; $i <= 12; $i++) {
            $products[] = [
                'name' => 'Prenda Femenina ' . $i,
                'price' => 70000,
                'image' => 'assets/img/femenino' . $i . '.png',
                'category' => 'Ropa Femenina',
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}

