<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Obtener todas las páginas sin paginación para depuración
            $allPages = Page::all();
            \Log::info('Total de páginas en la base de datos:', ['count' => $allPages->count()]);
            
            if ($allPages->isNotEmpty()) {
                \Log::info('Primera página encontrada:', $allPages->first()->toArray());
            } else {
                \Log::warning('No se encontraron páginas en la base de datos');
                // Crear una página de ejemplo si no hay ninguna
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
                    'meta_description' => 'Descripción SEO'
                ]);
                \Log::info('Página de ejemplo creada:', $page->toArray());
            }
            
            // Obtener páginas con paginación para la vista
            $pages = Page::latest()->paginate(10);
            
            // Pasar los datos a la vista de manera explícita
            return view('admin.pages.index', [
                'pages' => $pages
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error en PageController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar las páginas');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatePageData($request);
        
        // Handle file upload
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }
        
        // Create the page
        $page = Page::create($data);
        
        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Página creada exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        // Asegurarse de que los campos JSON sean arrays
        $page->features = is_string($page->features) ? json_decode($page->features, true) : ($page->features ?? []);
        $page->specialties = is_string($page->specialties) ? json_decode($page->specialties, true) : ($page->specialties ?? []);
        $page->testimonials = is_string($page->testimonials) ? json_decode($page->testimonials, true) : ($page->testimonials ?? []);
        $page->opening_hours = is_string($page->opening_hours) ? json_decode($page->opening_hours, true) : ($page->opening_hours ?? []);
        
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        // Iniciar transacción de base de datos
        \DB::beginTransaction();
        
        try {
            // Registrar la solicitud entrante para depuración
            \Log::info('=== INICIO DE ACTUALIZACIÓN DE PÁGINA ===');
            \Log::info('Solicitud recibida:', [
                'page_id' => $page->id,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'request_data' => $request->except(['_token', '_method', 'files']),
                'files' => $request->hasFile('hero_image') ? 'Archivo recibido' : 'Sin archivo'
            ]);
            
            // Obtener los datos actuales antes de la actualización
            $originalData = $page->toArray();
            \Log::info('Datos actuales en la base de datos:', $originalData);
            
            // Validar los datos y obtener los datos validados
            $data = $this->validatePageData($request, $page->id);
            \Log::info('Datos validados para actualización:', $data);
            
            // Manejar carga de archivo de imagen
            if ($request->hasFile('hero_image')) {
                \Log::info('Procesando nueva imagen de héroe');
                
                // Eliminar imagen anterior si existe
                if ($page->hero_image) {
                    $deleted = Storage::disk('public')->delete($page->hero_image);
                    \Log::info('Imagen anterior ' . ($deleted ? 'eliminada' : 'no pudo ser eliminada') . ':', [
                        'path' => $page->hero_image
                    ]);
                }
                
                // Guardar la nueva imagen
                $path = $request->file('hero_image')->store('pages', 'public');
                $data['hero_image'] = $path;
                \Log::info('Nueva imagen guardada:', ['path' => $path]);
            }
            
            // Actualizar campos uno por uno para asegurar la persistencia
            $changes = [];
            foreach ($data as $key => $value) {
                if (array_key_exists($key, $page->getAttributes()) && $page->$key != $value) {
                    $changes[$key] = [
                        'old' => $page->$key,
                        'new' => $value
                    ];
                    $page->$key = $value;
                }
            }
            
            if (empty($changes)) {
                \Log::info('No se detectaron cambios para actualizar');
                return redirect()
                    ->route('admin.pages.edit', $page)
                    ->with('info', 'No se detectaron cambios para actualizar');
            }
            
            \Log::info('Cambios detectados:', $changes);
            
            // Forzar el guardado y verificar el resultado
            $saved = $page->save();
            
            if (!$saved) {
                throw new \Exception('No se pudo guardar el registro en la base de datos');
            }
            
            // Confirmar la transacción
            \DB::commit();
            
            // Recargar el modelo desde la base de datos
            $page->refresh();
            
            // Verificar en la base de datos directamente
            $dbPage = \DB::table('pages')->where('id', $page->id)->first();
            
            // Registrar la actualización exitosa
            \Log::info('✅ PÁGINA ACTUALIZADA EXITOSAMENTE', [
                'page_id' => $page->id,
                'changes' => $page->getChanges(),
                'database_record' => (array)$dbPage
            ]);
            
            // Limpiar caché
            \Cache::forget('page_'.$page->slug);
            \Cache::forget('all_pages');
            
            // Forzar recarga de la página sin caché
            return redirect()
                ->route('admin.pages.edit', $page)
                ->with('success', 'Página actualizada exitosamente')
                ->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);
                
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            \DB::rollBack();
            
            \Log::error('Error al actualizar la página: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar la página: ' . $e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // Delete image if exists
        if ($page->hero_image) {
            Storage::disk('public')->delete($page->hero_image);
        }
        
        $page->delete();
        
        return redirect()->route('admin.pages.index')
            ->with('success', 'Página eliminada exitosamente');
    }
    
    /**
     * Validate page data
     */
    /**
     * Actualización directa en la base de datos para evitar problemas con Eloquent
     */
    public function directUpdate(Request $request, $id)
    {
        try {
            \Log::info('=== INICIO DE ACTUALIZACIÓN DIRECTA ===');
            \Log::info('Solicitud recibida:', [
                'page_id' => $id,
                'request_data' => $request->except(['_token', '_method', 'files'])
            ]);
            
            // Obtener la página directamente de la base de datos
            $page = \DB::table('pages')->where('id', $id)->first();
            
            if (!$page) {
                throw new \Exception('Página no encontrada');
            }
            
            // Obtener solo los campos permitidos
            $allowedFields = [
                'title', 'slug', 'hero_title', 'hero_subtitle', 'hero_image',
                'address', 'phone', 'email', 'whatsapp', 'facebook', 'instagram',
                'whatsapp_link', 'meta_title', 'meta_description', 'is_active',
                'features', 'specialties', 'testimonials', 'opening_hours'
            ];
            
            $updateData = [];
            
            // Procesar campos regulares
            foreach ($request->only($allowedFields) as $key => $value) {
                if (!in_array($key, ['features', 'specialties', 'testimonials', 'opening_hours'])) {
                    $updateData[$key] = $value;
                }
            }
            
            // Procesar campos JSON
            $jsonFields = ['features', 'specialties', 'testimonials', 'opening_hours'];
            foreach ($jsonFields as $field) {
                if ($request->has($field)) {
                    $value = $request->input($field);
                    $updateData[$field] = is_array($value) ? json_encode($value) : $value;
                }
            }
            
            // Manejar is_active
            $updateData['is_active'] = $request->has('is_active') ? 1 : 0;
            
            // Manejar carga de imagen
            if ($request->hasFile('hero_image')) {
                $path = $request->file('hero_image')->store('pages', 'public');
                $updateData['hero_image'] = $path;
                
                // Eliminar imagen anterior si existe
                if ($page->hero_image) {
                    Storage::disk('public')->delete($page->hero_image);
                }
            }
            
            // Actualizar la base de datos directamente
            $updated = \DB::table('pages')
                ->where('id', $id)
                ->update($updateData);
            
            if (!$updated) {
                throw new \Exception('No se pudo actualizar el registro');
            }
            
            // Limpiar caché
            \Cache::forget('page_'.$page->slug);
            \Cache::forget('all_pages');
            
            \Log::info('✅ ACTUALIZACIÓN DIRECTA EXITOSA', [
                'page_id' => $id,
                'changes' => $updateData
            ]);
            
            return redirect()
                ->route('admin.pages.edit', $id)
                ->with('success', 'Página actualizada exitosamente')
                ->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);
                
        } catch (\Exception $e) {
            \Log::error('Error en actualización directa: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar la página: ' . $e->getMessage());
        }
    }
    
    /**
     * Validate page data
     */
    protected function validatePageData(Request $request, $pageId = null)
    {
        // Obtener las reglas de validación del modelo
        $rules = Page::rules($pageId);
        
        // Validar los datos del request
        $validatedData = $request->validate($rules);
        
        // Inicializar el array de datos que se devolverá
        $data = [];
        
        // Procesar campos JSON
        $jsonFields = ['features', 'specialties', 'testimonials', 'opening_hours'];
        
        foreach ($jsonFields as $field) {
            if ($request->has($field) && is_array($request->input($field))) {
                $jsonData = [];
                
                // Procesar cada elemento del array
                foreach ($request->input($field) as $index => $item) {
                    if (is_array($item)) {
                        // Filtrar valores vacíos o nulos
                        $filteredItem = array_filter($item, function($value) {
                            return $value !== null && $value !== '';
                        });
                        
                        // Solo agregar si hay datos válidos
                        if (!empty($filteredItem)) {
                            $jsonData[] = $filteredItem;
                        }
                    }
                }
                
                // Codificar a JSON solo si hay datos
                $data[$field] = !empty($jsonData) 
                    ? json_encode($jsonData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                    : null;
                    
                // Si el campo es requerido y está vacío, establecer un array vacío codificado
                if (strpos($rules[$field] ?? '', 'required') !== false && empty($jsonData)) {
                    $data[$field] = json_encode([]);
                }
            } else {
                // Si el campo es requerido, establecer un array vacío codificado
                if (isset($rules[$field]) && strpos($rules[$field], 'required') !== false) {
                    $data[$field] = json_encode([]);
                } else {
                    $data[$field] = null;
                }
            }
            
            // Log para depuración
            \Log::info("Campo {$field} procesado", [
                'raw' => $request->input($field),
                'processed' => $data[$field],
                'is_required' => strpos($rules[$field] ?? '', 'required') !== false
            ]);
        }
        
        // Asegurar que los campos no JSON también se incluyan
        foreach ($validatedData as $key => $value) {
            if (!in_array($key, $jsonFields)) {
                $data[$key] = $value;
            }
        }
        
        // Asegurar que is_active sea un booleano
        $data['is_active'] = $request->has('is_active');
        
        // Log para depuración
        \Log::info('Datos validados antes de retornar', [
            'data' => $data,
            'request_data' => $request->all(),
            'validated_data' => $validatedData
        ]);
        
        return $data;
    }
}
