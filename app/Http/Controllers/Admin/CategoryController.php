<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Store method called', ['request' => $request->all(), 'files' => $request->hasFile('image')]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'is_active' => 'boolean',
        ], [
            'image.max' => 'La imagen no debe pesar más de 50MB',
            'image.mimes' => 'El archivo debe ser una imagen (jpeg, png, jpg, gif, webp)',
            'image.uploaded' => 'El archivo es demasiado grande. El tamaño máximo permitido es 50MB',
        ]);

        \Log::info('Validation passed', ['validated' => $validated]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Ensure the directory exists
            $directory = storage_path('app/public/categories');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Move the file to the correct location
            $image->move($directory, $imageName);
            
            // Store the relative path in the database
            $validated['image'] = 'categories/' . $imageName;
            
            \Log::info('Image uploaded successfully', [
                'original_name' => $image->getClientOriginalName(),
                'saved_path' => $validated['image'],
                'full_path' => $directory . '/' . $imageName,
                'file_exists' => file_exists($directory . '/' . $imageName)
            ]);
        }

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        // Cargar el recuento de productos
        $category->loadCount('products');
        
        // Cargar los productos de esta categoría con paginación
        $products = $category->products()->latest()->paginate(5);
        
        return view('admin.categories.show', compact('category', 'products'));
    }
    
    /**
     * Display a listing of the products for a specific category.
     */
    public function products(Category $category)
    {
        $products = $category->products()
            ->with('category')
            ->latest()
            ->paginate(10);
            
        return view('admin.products.index', [
            'products' => $products,
            'category' => $category,
            'title' => "Productos en la categoría: {$category->name}"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'is_active' => 'boolean',
            'remove_image' => 'nullable|boolean',
        ], [
            'image.max' => 'La imagen no debe pesar más de 50MB',
            'image.mimes' => 'El archivo debe ser una imagen (jpeg, png, jpg, gif, webp)',
            'image.uploaded' => 'El archivo es demasiado grande. El tamaño máximo permitido es 50MB',
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image) {
            if ($category->image) {
                $oldImagePath = storage_path('app/public/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $validated['image'] = null;
            }
        }
        // Handle new image upload
        elseif ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                $oldImagePath = storage_path('app/public/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Ensure the directory exists
            $directory = storage_path('app/public/categories');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Move the file to the correct location
            $image->move($directory, $imageName);
            $validated['image'] = 'categories/' . $imageName;
        }

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }
}
