<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illine\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// Configurar el logger para ver la salida
$logger = Log::getLogger();
$logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Level::Info));

try {
    echo "Iniciando prueba de actualización de página...\n";
    
    // Obtener la primera página
    $page = DB::table('pages')->first();
    
    if (!$page) {
        echo "No se encontraron páginas en la base de datos.\n";
        exit(1);
    }
    
    echo "Página encontrada - ID: {$page->id}, Título: {$page->title}\n";
    
    // Datos de prueba para actualizar
    $testTitle = 'Título de prueba ' . time();
    
    // Actualizar el título
    $updated = DB::table('pages')
        ->where('id', $page->id)
        ->update([
            'title' => $testTitle,
            'updated_at' => now(),
        ]);
    
    if ($updated) {
        echo "✅ Página actualizada correctamente. Nuevo título: {$testTitle}\n";
        
        // Verificar la actualización
        $updatedPage = DB::table('pages')->find($page->id);
        if ($updatedPage && $updatedPage->title === $testTitle) {
            echo "✅ Verificación exitosa: El título se actualizó correctamente en la base de datos.\n";
        } else {
            echo "❌ Error: La verificación falló. El título no se actualizó en la base de datos.\n";
        }
    } else {
        echo "❌ Error al actualizar la página.\n";
        
        // Verificar si hay un error de SQL
        try {
            DB::table('pages')->where('id', 999999)->update(['title' => 'test']);
        } catch (\Exception $e) {
            echo "Error de SQL: " . $e->getMessage() . "\n";
        }
    }
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
    
    // Intentar obtener más información del error
    if (method_exists($e, 'getSql')) {
        echo "SQL: " . $e->getSql() . "\n";
        echo "Bindings: " . print_r($e->getBindings(), true) . "\n";
    }
}

echo "Prueba completada.\n";
