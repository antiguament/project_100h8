<?php

use Illuminate\Support\Facades\DB;

// Cargar el autoloader de Composer
require __DIR__.'/vendor/autoload.php';

// Inicializar la aplicación Laravel
$app = require_once __DIR__.'/bootstrap/app.php';

// Ejecutar la aplicación
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Prueba de actualización de página ===\n\n";

try {
    // Obtener la primera página
    $page = DB::table('pages')->first();
    
    if (!$page) {
        echo "❌ No se encontraron páginas en la base de datos.\n";
        exit(1);
    }
    
    echo "ℹ️  Página encontrada - ID: {$page->id}, Título actual: {$page->title}\n";
    
    // Crear un título de prueba único
    $testTitle = 'Título de prueba ' . date('Y-m-d H:i:s');
    
    echo "🔄 Intentando actualizar el título a: {$testTitle}\n";
    
    // Actualizar SOLO el título
    $affected = DB::table('pages')
        ->where('id', $page->id)
        ->update(['title' => $testTitle]);
    
    if ($affected === 1) {
        echo "✅ Actualización exitosa. Filas afectadas: {$affected}\n";
        
        // Verificar la actualización
        $updatedPage = DB::table('pages')->find($page->id);
        if ($updatedPage && $updatedPage->title === $testTitle) {
            echo "✅ Verificación exitosa: El título se actualizó correctamente.\n";
            echo "   Nuevo título: {$updatedPage->title}\n";
        } else {
            echo "❌ Error: La verificación falló. El título no coincide.\n";
            if ($updatedPage) {
                echo "    Título en BD: {$updatedPage->title}\n";
            } else {
                echo "    No se pudo recuperar la página actualizada.\n";
            }
        }
    } else {
        echo "❌ Error: No se pudo actualizar el registro. Filas afectadas: {$affected}\n";
    }
    
} catch (\Exception $e) {
    echo "❌ Error inesperado:\n";
    echo "   Mensaje: " . $e->getMessage() . "\n";
    echo "   Archivo: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    // Mostrar el error SQL si está disponible
    if (method_exists($e, 'getSql')) {
        echo "   SQL: " . $e->getSql() . "\n";
        if (method_exists($e, 'getBindings')) {
            echo "   Bindings: " . print_r($e->getBindings(), true) . "\n";
        }
    }
}

echo "\nPrueba completada.\n";
