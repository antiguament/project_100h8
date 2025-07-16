<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Page;

class CheckDatabase extends Command
{
    protected $signature = 'db:check';
    protected $description = 'Verificar la conexión a la base de datos y la estructura de la tabla pages';

    public function handle()
    {
        $this->info('=== Verificación de Base de Datos ===');
        
        // Verificar conexión
        try {
            DB::connection()->getPdo();
            $this->info('✓ Conexión a la base de datos exitosa');
            $this->info('   Base de datos: ' . DB::connection()->getDatabaseName());
        } catch (\Exception $e) {
            $this->error('✗ No se pudo conectar a la base de datos: ' . $e->getMessage());
            return 1;
        }
        
        // Verificar si la tabla pages existe
        if (!Schema::hasTable('pages')) {
            $this->error('✗ La tabla "pages" no existe en la base de datos');
            return 1;
        }
        $this->info('✓ La tabla "pages" existe');
        
        // Verificar columnas de la tabla
        $columns = Schema::getColumnListing('pages');
        $requiredColumns = [
            'id', 'title', 'slug', 'hero_title', 'hero_subtitle', 'hero_image',
            'features', 'specialties', 'testimonials', 'opening_hours',
            'address', 'phone', 'email', 'whatsapp', 'facebook', 'instagram',
            'whatsapp_link', 'meta_title', 'meta_description', 'is_active',
            'created_at', 'updated_at'
        ];
        
        $missingColumns = array_diff($requiredColumns, $columns);
        if (!empty($missingColumns)) {
            $this->warn('✗ Faltan columnas en la tabla pages: ' . implode(', ', $missingColumns));
        } else {
            $this->info('✓ Todas las columnas requeridas están presentes en la tabla pages');
        }
        
        // Verificar datos de la página de inicio
        $page = Page::where('slug', 'inicio')->first();
        if (!$page) {
            $this->warn('✗ No se encontró la página con slug "inicio"');
            
            // Crear página de inicio si no existe
            if ($this->confirm('¿Desea crear una página de inicio por defecto?', true)) {
                $page = Page::create([
                    'title' => 'Página de Inicio',
                    'slug' => 'inicio',
                    'hero_title' => 'Bienvenido',
                    'hero_subtitle' => 'Subtítulo de bienvenida',
                    'features' => json_encode([
                        ['title' => 'Característica 1', 'description' => 'Descripción 1', 'icon' => 'fa-check']
                    ]),
                    'is_active' => true,
                    'address' => 'Dirección de ejemplo',
                    'phone' => '123456789',
                    'email' => 'ejemplo@ejemplo.com',
                    'meta_title' => 'Título SEO',
                    'meta_description' => 'Descripción SEO',
                    'whatsapp' => '123456789',
                    'whatsapp_link' => 'https://wa.me/123456789',
                    'opening_hours' => json_encode([
                        ['days' => 'Lunes a Viernes', 'hours' => '8:00 AM - 10:00 PM']
                    ])
                ]);
                $this->info('✓ Página de inicio creada exitosamente (ID: ' . $page->id . ')');
            }
        } else {
            $this->info('✓ Página de inicio encontrada (ID: ' . $page->id . ', Última actualización: ' . $page->updated_at . ')' );
            
            // Mostrar información de actualización
            $this->info('\n=== Información de la Página de Inicio ===');
            $this->info('Título: ' . $page->title);
            $this->info('Slug: ' . $page->slug);
            $this->info('Activa: ' . ($page->is_active ? 'Sí' : 'No'));
            $this->info('Creada: ' . $page->created_at);
            $this->info('Actualizada: ' . $page->updated_at);
            
            // Verificar permisos de escritura
            $this->info('\n=== Verificación de Permisos ===');
            $storagePath = storage_path('app/public');
            if (!is_writable($storagePath)) {
                $this->warn('✗ El directorio de almacenamiento no tiene permisos de escritura: ' . $storagePath);
                $this->warn('  Ejecute: chmod -R 775 ' . $storage_path);
            } else {
                $this->info('✓ El directorio de almacenamiento tiene permisos de escritura');
            }
            
            // Verificar caché
            $this->info('\n=== Estado de la Caché ===');
            $this->info('Driver de caché: ' . config('cache.default'));
            
            // Verificar si hay algún problema con la caché
            try {
                cache()->put('test_cache', 'test', 1);
                if (cache()->get('test_cache') === 'test') {
                    $this->info('✓ La caché está funcionando correctamente');
                } else {
                    $this->warn('✗ La caché no está funcionando como se esperaba');
                }
                cache()->forget('test_cache');
            } catch (\Exception $e) {
                $this->warn('✗ Error al verificar la caché: ' . $e->getMessage());
            }
        }
        
        $this->info('\n=== Verificación completada ===');
        return 0;
    }
}
