<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicCategoryController extends Controller
{
    /**
     * Muestra la lista de categorías en la vista pública
     */
    public function index(): View
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('vista-1', compact('categories'));
    }

    /**
     * Muestra los productos de una categoría específica usando su slug
     */
    public function show(Category $category): View
    {
        // Cargar los productos activos de la categoría
        $products = $category->products()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('categories.show', compact('category', 'products'));
    }

    /**
     * Muestra los productos de una categoría específica (método antiguo por ID)
     */
    public function showProducts($categoryId): View
    {
        $category = Category::findOrFail($categoryId);
        $products = Product::where('category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('vista-2', compact('category', 'products'));
    }

    /**
     * Muestra los detalles de un producto específico
     */
    public function showProduct($productId): View
    {
        $product = Product::with('category')
            ->where('is_active', true)
            ->findOrFail($productId);
            
        // Obtener productos relacionados (misma categoría, excluyendo el actual)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('vista-3', compact('product', 'relatedProducts'));
    }
}
