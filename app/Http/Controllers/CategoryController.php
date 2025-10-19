<?php
// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Obtener todas las categorías
     */
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'description', 'image_url', 'is_active']);
            
        return response()->json($categories);
    }

    /**
     * Obtener productos por categoría
     */
    public function getProducts($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        
        $products = Product::where('category_id', $categoryId)
            ->where('is_active', true)
            ->with('category')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image_url' => $product->image_url,
                    'rating' => $product->rating,
                    'review_count' => $product->review_count,
                    'category_name' => $product->category->name,
                    'created_at' => $product->created_at,
                    'is_active' => $product->is_active
                ];
            });
            
        return response()->json($products);
    }

    /**
     * Obtener categoría específica
     */
    public function show($id)
    {
        $category = Category::withCount(['products' => function($query) {
            $query->where('is_active', true);
        }])->findOrFail($id);
        
        return response()->json($category);
    }
}