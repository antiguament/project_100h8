<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las categorías
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->command->warn('No hay categorías disponibles. Por favor, ejecute el CategorySeeder primero.');
            return;
        }
        
        $products = [
            [
                'name' => 'Laptop HP Pavilion',
                'description' => 'Laptop HP Pavilion con procesador Intel Core i5, 8GB RAM, 512GB SSD',
                'price' => 899.99,
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'iPhone 13 Pro',
                'description' => 'Smartphone Apple iPhone 13 Pro con pantalla Super Retina XDR',
                'price' => 999.99,
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Samsung 4K Smart TV',
                'description' => 'Televisor Samsung 55" 4K UHD Smart TV con HDR',
                'price' => 599.99,
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Sony WH-1000XM4',
                'description' => 'Audífonos inalámbricos Sony WH-1000XM4 con cancelación de ruido',
                'price' => 349.99,
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'description' => 'Consola Nintendo Switch modelo OLED con pantalla de 7 pulgadas',
                'price' => 349.99,
                'stock' => 5,
                'is_active' => true,
            ],
        ];
        
        foreach ($products as $productData) {
            $category = $categories->random();
            
            Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'is_active' => $productData['is_active'],
            ]);
        }
        
        $this->command->info('Productos de ejemplo creados exitosamente.');
    }
}
