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
    Route::get('/categoria/{category:slug}', 'show')->name('category.show');
});

// Product routes - Using route model binding with slug
Route::get('/producto/{product:slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

// Fallback route for product URLs with ID (in case slug is missing)
Route::get('/producto/id/{product}', [App\Http\Controllers\ProductController::class, 'showById'])->name('products.show.by.id');

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

// Ruta de bienvenida para usuarios autenticados
Route::get('/welcome', [\App\Http\Controllers\WelcomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('welcome');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('welcome');
    })->name('dashboard');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de administración
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Dashboard de administración
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas de recursos
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

// Ruta de contacto
Route::get('/contacto', function () {
    return view('contact');
})->name('contact');

// Route for AJAX product filtering
Route::get('/filter-products', [App\Http\Controllers\HomeController::class, 'filterProducts'])->name('products.filter');