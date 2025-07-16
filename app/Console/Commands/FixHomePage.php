<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixHomePage extends Command
{
    protected $signature = 'fix:homepage';
    protected $description = 'Repara la página de inicio con datos de ejemplo';

    public function handle()
    {
        $this->info('Verificando y reparando la página de inicio...');

        // Verificar si ya existe una página de inicio
        $page = Page::where('slug', 'inicio')->first();

        if ($page) {
            $this->warn('Ya existe una página de inicio. Actualizando...');
            $page->delete(); // Eliminar la página existente
        }

        // Crear una nueva página de inicio con datos de ejemplo
        $page = Page::create([
            'title' => 'Bienvenido a Nuestro Sitio',
            'slug' => 'inicio',
            'hero_title' => 'Descubre Nuestra Propuesta Gastronómica',
            'hero_subtitle' => 'Sabores únicos que deleitarán tu paladar',
            'hero_image' => null,
            'features' => json_encode([
                [
                    'title' => 'Platillos Exclusivos',
                    'description' => 'Elaborados con ingredientes frescos y de la más alta calidad',
                    'icon' => 'fas fa-utensils'
                ],
                [
                    'title' => 'Servicio a Domicilio',
                    'description' => 'Llevamos tus platillos favoritos hasta la puerta de tu hogar',
                    'icon' => 'fas fa-truck'
                ],
                [
                    'title' => 'Reservas Fáciles',
                    'description' => 'Haz tu reserva en línea de manera rápida y sencilla',
                    'icon' => 'fas fa-calendar-check'
                ]
            ]),
            'specialties' => json_encode([
                [
                    'title' => 'Especialidad de la Casa',
                    'description' => 'Nuestro plato estrella, preparado con ingredientes seleccionados',
                    'image' => null,
                    'button_text' => 'Ver más',
                    'button_url' => '#especialidades'
                ]
            ]),
            'testimonials' => json_encode([
                [
                    'name' => 'Cliente Satisfecho',
                    'position' => 'Cliente frecuente',
                    'text' => '¡La mejor comida que he probado en mucho tiempo!',
                    'rating' => 5,
                    'image' => null
                ]
            ]),
            'address' => 'Calle Principal #123, Ciudad',
            'phone' => '+1 234 567 890',
            'email' => 'contacto@tudominio.com',
            'whatsapp' => '1234567890',
            'whatsapp_link' => 'https://wa.me/1234567890',
            'facebook' => 'https://facebook.com/tupagina',
            'instagram' => 'https://instagram.com/tupagina',
            'opening_hours' => json_encode([
                ['days' => 'Lunes a Viernes', 'hours' => '8:00 AM - 10:00 PM'],
                ['days' => 'Sábado', 'hours' => '9:00 AM - 11:00 PM'],
                ['days' => 'Domingo', 'hours' => '10:00 AM - 9:00 PM']
            ]),
            'meta_title' => 'Inicio - Tu Sitio Web',
            'meta_description' => 'Bienvenido a nuestro sitio web, descubre nuestros productos y servicios',
            'is_active' => true
        ]);

        $this->info('Página de inicio creada exitosamente!');
        $this->info('ID: ' . $page->id);
        $this->info('Título: ' . $page->title);
        $this->info('Slug: ' . $page->slug);

        return 0;
    }
}
