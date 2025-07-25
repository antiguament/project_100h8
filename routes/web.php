<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
use App\Models\Page;

// Ruta de la página de inicio
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

use App\Http\Controllers\PublicCategoryController;
use App\Http\Controllers\CartController;

// Rutas del carrito
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add/{id}', 'add')->name('cart.add');
    Route::post('/cart/update', 'update')->name('cart.update');
    Route::post('/cart/remove', 'remove')->name('cart.remove');
    Route::post('/cart/clear', 'clear')->name('cart.clear');
    Route::get('/cart/checkout', 'checkout')->name('cart.checkout');
    Route::get('/cart/count', 'count')->name('cart.count');
    Route::get('/cart/mini', 'mini')->name('cart.mini');
    Route::post('/cart/send-whatsapp', 'sendToWhatsApp')->name('cart.send.whatsapp');
});

// Rutas de categorías públicas
Route::controller(PublicCategoryController::class)->group(function () {
    Route::get('/vista-1', 'index')->name('vista-1');
    Route::get('/categoria/{categoryId}/productos', 'showProducts')->name('categoria.productos');
    Route::get('/producto/{productId}', 'showProduct')->name('producto.detalle');
});

// Ruta para servir imágenes de productos
Route::get('/images/products/{filename}', function ($filename) {
    $path = storage_path('app/public/products/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'image/png', // Se ajustará automáticamente al tipo de imagen
    ]);
})->name('product.image');

// Ruta para servir imágenes de categorías
Route::get('/images/categories/{filename}', function ($filename) {
    // Primero intentar con la ruta estándar de Laravel
    $path = storage_path('app/public/categories/' . $filename);
    
    if (!file_exists($path)) {
        // Si no existe, intentar con la ruta directa
        $path = public_path('storage/categories/' . $filename);
        if (!file_exists($path)) {
            // Intentar con la ruta relativa
            $path = base_path('storage/app/public/categories/' . $filename);
            if (!file_exists($path)) {
                // Si aún no se encuentra, intentar cualquier otro directorio posible
                $path = storage_path('app/public/categories/' . $filename);
                if (!file_exists($path)) {
                    // Si todo falla, devolver una imagen de placeholder
                    $path = public_path('images/placeholder.jpg');
                    if (!file_exists($path)) {
                        abort(404, 'No se pudo encontrar la imagen: ' . $filename);
                    }
                }
            }
        }
    }

    $file = new \Illuminate\Http\File($path);
    $mime = $file->getMimeType();
    
    return response()->file($path, [
        'Content-Type' => $mime,
        'Cache-Control' => 'public, max-age=31536000',
        'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000)
    ]);
})->name('category.image');

// Ruta de prueba para verificar la configuración de almacenamiento
Route::get('/test-storage', function() {
    $testPath = storage_path('app/public/categories');
    $publicPath = public_path('storage');
    $isLinked = is_link($publicPath);
    $linkTarget = $isLinked ? readlink($publicPath) : 'No es un enlace simbólico';
    $storageExists = file_exists($testPath);
    $publicStorageExists = file_exists($publicPath);
    $categories = [];
    $categoryImages = [];
    
    // Obtener las categorías de la base de datos
    $dbCategories = \App\Models\Category::whereNotNull('image')->get();
    
    // Verificar archivos en el directorio de almacenamiento
    if ($storageExists) {
        $files = array_diff(scandir($testPath), ['..', '.']);
        $categories = array_map(function($file) use ($testPath) {
            return [
                'name' => $file,
                'path' => $testPath . '/' . $file,
                'exists' => file_exists($testPath . '/' . $file),
                'url' => asset('storage/categories/' . $file),
                'storage_url' => url('storage/categories/' . $file),
                'direct_url' => url('images/categories/' . $file),
            ];
        }, $files);
    }
    
    // Verificar las imágenes de las categorías en la base de datos
    foreach ($dbCategories as $category) {
        $categoryImages[] = [
            'id' => $category->id,
            'name' => $category->name,
            'image_path' => $category->image,
            'full_path' => storage_path('app/public/' . $category->image),
            'exists' => file_exists(storage_path('app/public/' . $category->image)),
            'asset_url' => asset('storage/' . $category->image),
            'url' => url('storage/' . $category->image),
            'direct_url' => url('images/categories/' . basename($category->image)),
        ];
    }
    
    return view('test-storage', [
        'testPath' => $testPath,
        'publicPath' => $publicPath,
        'isLinked' => $isLinked,
        'linkTarget' => $linkTarget,
        'storageExists' => $storageExists,
        'publicStorageExists' => $publicStorageExists,
        'categories' => $categories,
        'dbCategories' => $dbCategories,
        'categoryImages' => $categoryImages,
    ]);
});

// Ruta temporal para servir imágenes de páginas
Route::get('/images/pages/{filename}', function ($filename) {
    $path = storage_path('app/public/pages/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'image/png', // Se ajustará automáticamente al tipo de imagen
    ]);
})->name('page.image');

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del panel de administración
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        // Rutas de categorías
        Route::resource('categories', CategoryController::class)->names('admin.categories');
        
        // Rutas de productos
        Route::resource('products', ProductController::class)->names('admin.products');
        
        // Ruta para ver productos por categoría
        Route::get('categories/{category}/products', [CategoryController::class, 'products'])
             ->name('admin.categories.products');
        
        // Rutas para la administración de páginas
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class)
             ->names('admin.pages')
             ->except(['show']);
             
        // Ruta para actualización directa de páginas
        Route::post('pages/direct-update/{page}', [\App\Http\Controllers\Admin\PageController::class, 'directUpdate'])
             ->name('admin.pages.direct-update');
    });
});
