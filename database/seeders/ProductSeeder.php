<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'CAFE LILA GOURMET TUESTE MEDIO 1000 GRAMOS', 'weight' => '1000 GRAMOS', 'roast_type' => 'Tueste medio'],
            ['name' => 'CAFE LILA GOURMET TUESTE OSCURO 1000 GRAMOS', 'weight' => '1000 GRAMOS', 'roast_type' => 'Tueste oscuro'],
            ['name' => 'CAFE LILA RESERVA ESPECIAL TUESTE CLARO 500 GRAMOS', 'weight' => '500 GRAMOS', 'roast_type' => 'Tueste claro'],
            ['name' => 'CAFE LILA GOURMET TUESTE MEDIO 500 GRAMOS', 'weight' => '500 GRAMOS', 'roast_type' => 'Tueste medio'],
            ['name' => 'CAFE LILA GOURMET TUESTE OSCURO 500 GRAMOS', 'weight' => '500 GRAMOS', 'roast_type' => 'Tueste oscuro'],
            ['name' => 'CAFE LILA SELECTO TUESTE OSCURO 500 GRAMOS', 'weight' => '500 GRAMOS', 'roast_type' => 'Tueste oscuro'],
            ['name' => 'CAFE LILA GOURMET TUESTE MEDIO 250 GRAMOS', 'weight' => '250 GRAMOS', 'roast_type' => 'Tueste medio'],
            ['name' => 'CAFE LILA GOURMET TUESTE OSCURO 250 GRAMOS', 'weight' => '250 GRAMOS', 'roast_type' => 'Tueste oscuro'],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'description' => 'Cafe gourmet premium de origen costarricense.',
                    'weight' => $product['weight'],
                    'roast_type' => $product['roast_type'],
                    'category' => 'gourmet',
                    'status' => true,
                ]
            );
        }
    }
}
