<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el panel de control del administrador.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Cargar estadísticas para el dashboard
        $categories = Category::withCount('products')
            ->latest()
            ->take(5)
            ->get();
            
        $products = Product::with('category')
            ->latest()
            ->take(5)
            ->get();
            
        $pages = Page::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('categories', 'products', 'pages'));
    }
}
