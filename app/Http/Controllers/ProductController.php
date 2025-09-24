<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Eager load related data if needed
        $product->load('category');
        
        // Get related products (products from the same category)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
    
    /**
     * Display the specified product by ID (fallback for missing slugs).
     */
    public function showById($id)
    {
        $product = Product::findOrFail($id);
        
        // Redirect to the slug-based URL if the product has a slug
        if ($product->slug) {
            return redirect()->route('products.show', $product->slug, 301);
        }
        
        // If no slug is available, just show the product
        $product->load('category');
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
