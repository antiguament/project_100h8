<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Obtener la página de inicio
            $page = $this->getHomePage();
            
            // Si no se encontró la página, redirigir con un mensaje de error
            if (!$page) {
                return redirect()->back()->with('error', 'La página de inicio no está configurada correctamente.');
            }
            
            // Procesar los campos JSON
            $this->processJsonFields($page);
            
            // Registrar datos para depuración
            $this->logPageData($page);
            
            // Retornar la vista con los datos de la página
            return view('welcome', compact('page'));
            
        } catch (\Exception $e) {
            Log::error('Error al cargar la página de inicio: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            // Mostrar una página de error personalizada
            return response()->view('errors.custom', [
                'message' => 'Error al cargar la página de inicio',
                'error' => config('app.debug') ? $e->getMessage() : 'Por favor, intente nuevamente más tarde.'
            ], 500);
        }
    }
    
    /**
     * Obtiene la página de inicio de la base de datos
     */
    protected function getHomePage()
    {
        $page = Page::where('slug', 'inicio')->first();
        
        // Si no existe la página, crear una por defecto
        if (!$page) {
            $page = $this->createDefaultHomePage();
        }
        
        return $page;
    }
    
    /**
     * Crea una página de inicio por defecto
     */
    protected function createDefaultHomePage()
    {
        try {
            return Page::create([
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
        } catch (\Exception $e) {
            Log::error('Error al crear la página de inicio por defecto: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Procesa los campos JSON de la página
     */
    protected function processJsonFields(&$page)
    {
        $jsonFields = ['features', 'specialties', 'testimonials', 'opening_hours'];
        
        foreach ($jsonFields as $field) {
            if (isset($page->$field)) {
                if (is_string($page->$field)) {
                    $page->$field = json_decode($page->$field, true);
                }
                
                if (!is_array($page->$field)) {
                    $page->$field = [];
                }
            } else {
                $page->$field = [];
            }
        }
    }
    
    /**
     * Registra los datos de la página para depuración
     */
    protected function logPageData($page)
    {
        Log::debug('Datos de la página cargados:', [
            'id' => $page->id,
            'title' => $page->title,
            'slug' => $page->slug,
            'has_features' => !empty($page->features),
            'has_specialties' => !empty($page->specialties),
            'has_testimonials' => !empty($page->testimonials),
            'has_opening_hours' => !empty($page->opening_hours),
            'updated_at' => $page->updated_at
        ]);
    }
}
