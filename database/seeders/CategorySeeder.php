<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tecnología',
                'description' => 'Productos y servicios relacionados con la tecnología',
                'is_active' => true,
            ],
            [
                'name' => 'Electrodomésticos',
                'description' => 'Todo tipo de electrodomésticos para el hogar',
                'is_active' => true,
            ],
            [
                'name' => 'Moda',
                'description' => 'Ropa, calzado y accesorios de moda',
                'is_active' => true,
            ],
            [
                'name' => 'Hogar',
                'description' => 'Artículos para el hogar y decoración',
                'is_active' => true,
            ],
            [
                'name' => 'Deportes',
                'description' => 'Artículos deportivos y equipamiento',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
