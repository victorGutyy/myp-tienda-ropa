<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::table('products')->get();
        $sizes = DB::table('sizes')->get();
        $colors = DB::table('colors')->get();

        foreach ($products as $product) {
            // Definir tallas según categoría
            $availableSizes = [];

            if ($product->category === 'Tenis') {
                $availableSizes = $sizes->whereIn('label', ['37', '38', '39', '40']);
            } else {
                $availableSizes = $sizes->whereIn('label', ['S', 'M', 'L', 'XL']);
            }

            // Para cada producto, combinamos tallas y colores
            foreach ($availableSizes as $size) {
                foreach ($colors as $color) {
                    // Cargar variantes combinando talla y color
                    DB::table('product_variants')->insert([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'size_id' => $size->id,
                        'stock' => 10,
                        'price' => $product->price, // mismo precio del producto base
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

