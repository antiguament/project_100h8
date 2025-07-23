<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener o crear las categorías necesarias
        $categories = [
            'Entradas' => 'Deliciosas entradas para comenzar tu comida',
            'Desayunos' => 'Desayunos deliciosos para empezar el día',
            'Pastas' => 'Pastas caseras con los mejores ingredientes',
            'Menú Especial' => 'Platos especiales de la casa',
            'Menú Típico' => 'Platos típicos de la región',
            'Pescados' => 'Platos de pescado fresco',
            'Frijoles Gratinados' => 'Frijoles preparados de diferentes formas',
            'Asados' => 'Carnes asadas al mejor estilo',
            'Bebidas' => 'Bebidas frías y calientes',
            'Adiciones' => 'Acompañamientos adicionales'
        ];

        // Crear categorías si no existen
        foreach ($categories as $name => $description) {
            Category::firstOrCreate(
                ['name' => $name],
                [
                    'description' => $description,
                    'is_active' => true,
                    'slug' => Str::slug($name)
                ]
            );
        }

        // Obtener categorías para usar en los productos
        $categoryIds = [];
        foreach ($categories as $name => $description) {
            $category = Category::where('name', $name)->first();
            if ($category) {
                $categoryIds[$name] = $category->id;
            }
        }
        
        // Obtener todas las categorías disponibles
        $allCategories = Category::all();

        // Limpiar productos existentes
        DB::table('products')->truncate();

        $products = [
            // Pescados
            [
                'name' => 'Filete de Pescado a la Plancha',
                'description' => 'Fresco filete de pescado a la plancha con guarnición de verduras',
                'price' => 28000,
                'category_id' => $categoryIds['Pescados'],
                'image' => 'https://placehold.co/200x200/1E90FF/FFFFFF?text=Pescado+Plancha',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Cazuela de Mariscos',
                'description' => 'Deliciosa cazuela de mariscos con leche de coco y especias',
                'price' => 35000,
                'category_id' => $categoryIds['Pescados'],
                'image' => 'https://placehold.co/200x200/1E90FF/FFFFFF?text=Cazuela+Mariscos',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Arroz con Camarones',
                'description' => 'Arroz con camarones salteados en mantequilla de ajo',
                'price' => 30000,
                'category_id' => $categoryIds['Pescados'],
                'image' => 'https://placehold.co/200x200/1E90FF/FFFFFF?text=Arroz+Camarones',
                'stock' => 999,
                'is_active' => true,
            ],

            // Frijoles Gratinados
            [
                'name' => 'Frijoles con Carne y Queso',
                'description' => 'Frijoles rojos con carne molida y queso gratinado',
                'price' => 22000,
                'category_id' => $categoryIds['Frijoles Gratinados'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Frijoles+Carne+Queso',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Frijoles con Chicharrón',
                'description' => 'Frijoles rojos con chicharrón crujiente',
                'price' => 20000,
                'category_id' => $categoryIds['Frijoles Gratinados'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Frijoles+Chicharron',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Frijoles con Huevo',
                'description' => 'Frijoles rojos con huevo frito y plátano maduro',
                'price' => 18000,
                'category_id' => $categoryIds['Frijoles Gratinados'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Frijoles+Huevo',
                'stock' => 999,
                'is_active' => true,
            ],

            // Bebidas
            [
                'name' => 'Jugo Natural',
                'description' => 'Jugo natural de frutas de la temporada',
                'price' => 6000,
                'category_id' => $categoryIds['Bebidas'],
                'image' => 'https://placehold.co/200x200/FF6347/FFFFFF?text=Jugo+Natural',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Limonada Natural',
                'description' => 'Refrescante limonada natural con hierbabuena',
                'price' => 5000,
                'category_id' => $categoryIds['Bebidas'],
                'image' => 'https://placehold.co/200x200/FFD700/000000?text=Limonada',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Gaseosa Personal',
                'description' => 'Gaseosa en presentación personal (350ml)',
                'price' => 4000,
                'category_id' => $categoryIds['Bebidas'],
                'image' => 'https://placehold.co/200x200/FF0000/FFFFFF?text=Gaseosa',
                'stock' => 999,
                'is_active' => true,
            ],

            // Adiciones
            [
                'name' => 'Porción de Arroz',
                'description' => 'Porción individual de arroz blanco',
                'price' => 3000,
                'category_id' => $categoryIds['Adiciones'],
                'image' => 'https://placehold.co/200x200/FFFFFF/000000?text=Arroz',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Porción de Papas',
                'description' => 'Porción de papas a la francesa',
                'price' => 5000,
                'category_id' => $categoryIds['Adiciones'],
                'image' => 'https://placehold.co/200x200/FFD700/000000?text=Papas',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Porción de Ensalada',
                'description' => 'Ensalada fresca de lechuga, tomate y cebolla',
                'price' => 4000,
                'category_id' => $categoryIds['Adiciones'],
                'image' => 'https://placehold.co/200x200/90EE90/000000?text=Ensalada',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Porción de Aguacate',
                'description' => 'Media unidad de aguacate fresco',
                'price' => 4000,
                'category_id' => $categoryIds['Adiciones'],
                'image' => 'https://placehold.co/200x200/008000/FFFFFF?text=Aguacate',
                'stock' => 999,
                'is_active' => true,
            ],

            // Entradas
            [
                'name' => 'Patacones Boloñesos y Gratinados x 4 und',
                'description' => 'Deliciosos patacones con salsa boloñesa y queso gratinado',
                'price' => 10000,
                'category_id' => $categoryIds['Entradas'],
                'image' => 'https://placehold.co/200x200/FFD700/000000?text=Patacones+x4',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Patacones Boloñesos y Gratinados x 8 und',
                'description' => 'Deliciosos patacones con salsa boloñesa y queso gratinado',
                'price' => 16000,
                'category_id' => $categoryIds['Entradas'],
                'image' => 'https://placehold.co/200x200/FFD700/000000?text=Patacones+x8',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Patacones Boloñesos y Gratinados x 12 und',
                'description' => 'Deliciosos patacones con salsa boloñesa y queso gratinado',
                'price' => 30000,
                'category_id' => $categoryIds['Entradas'],
                'image' => 'https://placehold.co/200x200/FFD700/000000?text=Patacones+x12',
                'stock' => 999,
                'is_active' => true,
            ],

            // Desayunos
            [
                'name' => 'Huevos con Aliños',
                'description' => 'Huevos revueltos con cebolla, tomate y especias',
                'price' => 18000,
                'category_id' => $categoryIds['Desayunos'],
                'image' => 'https://placehold.co/200x200/F0E68C/000000?text=Huevos+Aliños',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Huevos con Tocino',
                'description' => 'Huevos revueltos con crujiente tocino',
                'price' => 18000,
                'category_id' => $categoryIds['Desayunos'],
                'image' => 'https://placehold.co/200x200/F0E68C/000000?text=Huevos+Tocino',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Huevos Rancheros',
                'description' => 'Huevos estilo ranchero con salsa de tomate y especias',
                'price' => 18000,
                'category_id' => $categoryIds['Desayunos'],
                'image' => 'https://placehold.co/200x200/F0E68C/000000?text=Huevos+Rancheros',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Huevos Sencillos',
                'description' => 'Huevos fritos o revueltos al gusto',
                'price' => 18000,
                'category_id' => $categoryIds['Desayunos'],
                'image' => 'https://placehold.co/200x200/F0E68C/000000?text=Huevos+Sencillos',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Calentado Especial',
                'description' => 'Calentado tradicional con huevo, arepa, chorizo y más',
                'price' => 18000,
                'category_id' => $categoryIds['Desayunos'],
                'image' => 'https://placehold.co/200x200/D2B48C/000000?text=Calentado+Esp',
                'stock' => 999,
                'is_active' => true,
            ],

            // Pastas
            [
                'name' => 'Carbonara con Panceta y Pollo',
                'description' => 'Pasta en salsa carbonara con trozos de pollo y panceta crujiente',
                'price' => 32000,
                'category_id' => $categoryIds['Pastas'],
                'image' => 'https://placehold.co/200x200/F5DEB3/000000?text=Carbonara',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Gamberry 3 Quesos',
                'description' => 'Pasta con salsa de tres quesos y camarones',
                'price' => 32000,
                'category_id' => $categoryIds['Pastas'],
                'image' => 'https://placehold.co/200x200/F5DEB3/000000?text=Gamberry+3Q',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Vegetariana',
                'description' => 'Pasta con salsa de tomate natural y vegetales frescos',
                'price' => 32000,
                'category_id' => $categoryIds['Pastas'],
                'image' => 'https://placehold.co/200x200/F5DEB3/000000?text=Vegetariana',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Al Tono (Atún)',
                'description' => 'Pasta con salsa de atún y especias',
                'price' => 32000,
                'category_id' => $categoryIds['Pastas'],
                'image' => 'https://placehold.co/200x200/F5DEB3/000000?text=Pasta+Atún',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Bolognesa',
                'description' => 'Pasta con salsa bolognesa tradicional',
                'price' => 32000,
                'category_id' => $categoryIds['Pastas'],
                'image' => 'https://placehold.co/200x200/F5DEB3/000000?text=Bolognesa',
                'stock' => 999,
                'is_active' => true,
            ],

            // Menú Especial
            [
                'name' => 'Lomo Horneado a la Oriental',
                'description' => 'Lomo de cerdo horneado con especias orientales',
                'price' => 25000,
                'category_id' => $categoryIds['Menú Especial'],
                'image' => 'https://placehold.co/200x200/A0522D/FFFFFF?text=Lomo+Oriental',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Cordon Blue',
                'description' => 'Pechuga rellena de jamón y queso, empanizada y dorada',
                'price' => 25000,
                'category_id' => $categoryIds['Menú Especial'],
                'image' => 'https://placehold.co/200x200/A0522D/FFFFFF?text=Cordon+Blue',
                'stock' => 999,
                'is_active' => true,
            ],

            // Menú Típico
            [
                'name' => 'Menú Típico con Res',
                'description' => 'Bandeja típica con carne de res, arroz, frijoles, plátano, aguacate y arepa',
                'price' => 18000,
                'category_id' => $categoryIds['Menú Típico'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Típico+Res',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Menú Típico con Pollo',
                'description' => 'Bandeja típica con pollo, arroz, frijoles, plátano, aguacate y arepa',
                'price' => 18000,
                'category_id' => $categoryIds['Menú Típico'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Típico+Pollo',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Menú Típico con Cerdo',
                'description' => 'Bandeja típica con carne de cerdo, arroz, frijoles, plátano, aguacate y arepa',
                'price' => 18000,
                'category_id' => $categoryIds['Menú Típico'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Típico+Cerdo',
                'stock' => 999,
                'is_active' => true,
            ],
            [
                'name' => 'Menú Típico con Chicharrón',
                'description' => 'Bandeja típica con chicharrón, arroz, frijoles, plátano, aguacate y arepa',
                'price' => 18000,
                'category_id' => $categoryIds['Menú Típico'],
                'image' => 'https://placehold.co/200x200/8B4513/FFFFFF?text=Típico+Chicharrón',
                'stock' => 999,
                'is_active' => true,
            ],

        ];
        
        // Insertar productos
        foreach ($products as $productData) {
            // Si el producto tiene un category_id definido, usarlo
            if (isset($productData['category_id'])) {
                Product::create([
                    'category_id' => $productData['category_id'],
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'image' => $productData['image'] ?? null,
                    'is_active' => $productData['is_active']
                ]);
            }
        }
        
        $this->command->info('Productos de ejemplo creados exitosamente.');
    }
}
