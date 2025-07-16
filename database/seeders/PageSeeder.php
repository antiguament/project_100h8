<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {
        Page::firstOrCreate(
            ['slug' => 'inicio'],
            [
                'title' => 'Bienvenido a Nuestro Sitio',
                'hero_title' => 'Bienvenido a Nuestro Sitio',
                'hero_subtitle' => 'Descubre nuestros productos y servicios',
                'features' => json_encode([
                    [
                        'title' => 'Calidad Garantizada',
                        'description' => 'Productos de la más alta calidad para nuestros clientes',
                        'icon' => 'fas fa-check-circle'
                    ],
                    [
                        'title' => 'Atención Personalizada',
                        'description' => 'Nuestro equipo está listo para ayudarte',
                        'icon' => 'fas fa-headset'
                    ],
                    [
                        'title' => 'Envíos Rápidos',
                        'description' => 'Recibe tus productos en tiempo récord',
                        'icon' => 'fas fa-shipping-fast'
                    ]
                ]),
                'specialties' => json_encode([]),
                'testimonials' => json_encode([]),
                'address' => 'Calle Principal #123, Ciudad',
                'phone' => '+1 234 567 890',
                'email' => 'contacto@tudominio.com',
                'whatsapp' => '1234567890',
                'facebook' => 'https://facebook.com/tupagina',
                'instagram' => 'https://instagram.com/tupagina',
                'whatsapp_link' => 'https://wa.me/1234567890',
                'opening_hours' => json_encode([
                    'Lunes a Viernes' => '9:00 AM - 6:00 PM',
                    'Sábado' => '9:00 AM - 2:00 PM',
                    'Domingo' => 'Cerrado'
                ]),
                'meta_title' => 'Inicio - Tu Sitio Web',
                'meta_description' => 'Bienvenido a nuestro sitio web, descubre nuestros productos y servicios',
                'is_active' => true
            ]
        );
    }
}
