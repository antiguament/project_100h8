<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illwarem\Illuminate\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Obtener la página
$page = \App\Models\Page::find(1);

if (!$page) {
    die("No se encontró la página con ID 1");
}

echo "<h1>Información de la Imagen</h1>";
echo "<p><strong>ID de la página:</strong> " . $page->id . "</p>";
echo "<p><strong>Título:</strong> " . htmlspecialchars($page->title) . "</p>";
echo "<p><strong>hero_image:</strong> " . htmlspecialchars($page->hero_image) . "</p>";
echo "<p><strong>hero_image_url:</strong> " . htmlspecialchars($page->hero_image_url) . "</p>";

// Mostrar la imagen si existe
if ($page->hero_image_url) {
    echo "<h2>Vista previa de la imagen:</h2>";
    echo "<img src='" . htmlspecialchars($page->hero_image_url) . "' style='max-width: 500px;' alt='Vista previa'>";
    
    // Verificar si el archivo existe
    $imagePath = storage_path('app/public/' . $page->hero_image);
    echo "<p><strong>Ruta del archivo:</strong> " . htmlspecialchars($imagePath) . "</p>";
    echo "<p><strong>¿Existe el archivo?:</strong> " . (file_exists($imagePath) ? 'Sí' : 'No') . "</p>";
    
    // Mostrar información del archivo
    if (file_exists($imagePath)) {
        echo "<p><strong>Tamaño del archivo:</strong> " . filesize($imagePath) . " bytes</p>";
        echo "<p><strong>Tipo MIME:</strong> " . mime_content_type($imagePath) . "</p>";
    }
} else {
    echo "<p>No hay imagen configurada para esta página.</p>";
}

// Mostrar información del enlace simbólico
$linkPath = public_path('storage');
$targetPath = readlink($linkPath);

echo "<h2>Información del enlace simbólico:</h2>";
echo "<p><strong>Ruta del enlace:</strong> " . htmlspecialchars($linkPath) . "</p>";
echo "<p><strong>Destino del enlace:</strong> " . htmlspecialchars($targetPath) . "</p>";
echo "<p><strong>¿Existe el enlace?:</strong> " . (is_link($linkPath) ? 'Sí' : 'No') . "</p>";

// Mostrar permisos
echo "<h2>Permisos:</h2>";
if (file_exists($imagePath)) {
    $perms = fileperms($imagePath);
    echo "<p><strong>Permisos del archivo:</strong> " . substr(sprintf('%o', $perms), -4) . "</p>";
}

if (is_link($linkPath)) {
    $perms = fileperms($linkPath);
    echo "<p><strong>Permisos del enlace:</strong> " . substr(sprintf('%o', $perms), -4) . "</p>";
}
