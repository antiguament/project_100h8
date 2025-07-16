<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckPagesTable extends Command
{
    protected $signature = 'pages:check';
    protected $description = 'Verifica la estructura de la tabla pages y crea un registro de prueba';

    public function handle()
    {
        $this->info('=== Verificando tabla pages ===');
        
        // Verificar si la tabla existe
        if (!Schema::hasTable('pages')) {
            $this->error('La tabla pages no existe en la base de datos.');
            return 1;
        }
        
        $this->info('✓ La tabla pages existe');
        
        // Mostrar estructura de la tabla
        $columns = Schema::getColumnListing('pages');
        $this->info('\nColumnas en la tabla pages:');
        foreach ($columns as $column) {
            $this->line("- $column");
        }
        
        // Contar registros
        $count = DB::table('pages')->count();
        $this->info("\nNúmero de registros en pages: $count");
        
        if ($count === 0) {
            $this->info('\nIntentando insertar un registro de prueba...');
            
            try {
                $page = Page::create([
                    'title' => 'Página de Prueba',
                    'slug' => 'pagina-prueba',
                    'hero_title' => 'Título de Prueba',
                    'hero_subtitle' => 'Subtítulo de prueba',
                    'features' => json_encode([
                        ['title' => 'Prueba', 'description' => 'Descripción de prueba', 'icon' => 'fa-check']
                    ]),
                    'specialties' => json_encode([]),
                    'testimonials' => json_encode([]),
                    'address' => 'Dirección de prueba',
                    'phone' => '123456789',
                    'email' => 'test@example.com',
                    'whatsapp' => '123456789',
                    'facebook' => 'https://facebook.com',
                    'instagram' => 'https://instagram.com',
                    'whatsapp_link' => 'https://wa.me/123456789',
                    'opening_hours' => json_encode(['Lunes a Viernes' => '9:00 AM - 6:00 PM']),
                    'meta_title' => 'Meta título de prueba',
                    'meta_description' => 'Meta descripción de prueba',
                    'is_active' => true
                ]);
                
                $this->info('✓ Registro de prueba insertado correctamente');
                $this->info('ID del registro: ' . $page->id);
                
            } catch (\Exception $e) {
                $this->error('Error al insertar registro de prueba: ' . $e->getMessage());
                return 1;
            }
        }
        
        // Mostrar todos los registros
        $pages = Page::all();
        $this->info('\nRegistros en la tabla pages:');
        $this->table(
            ['ID', 'Título', 'Slug', 'Activo'],
            $pages->map(function($page) {
                return [
                    'id' => $page->id,
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'is_active' => $page->is_active ? 'Sí' : 'No'
                ];
            })
        );
        
        return 0;
    }
}
