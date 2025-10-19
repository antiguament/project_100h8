<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar los seeders en orden
        $this->call([
            RolesTableSeeder::class,  // Primero creamos los roles
            CategorySeeder::class,    // Luego las categorías
            ProductSeeder::class,     // Después los productos
            PreferencesSeeder::class, // Luego las preferencias de productos
            PageSeeder::class,        // Y finalmente las páginas
        ]);
    }
}
