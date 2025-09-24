<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Product::with('category');
        
        // Obtener todas las categorías para el selector
        $categories = Category::orderBy('name')->get();
        
        // Filtrar por categoría si se proporciona y no está vacía
        if ($request->has('category_id') && $request->filled('category_id')) {
            $category = Category::findOrFail($request->category_id);
            $query->where('category_id', $category->id);
            
            return view('admin.products.index', [
                'products' => $query->latest()->paginate(10),
                'category' => $category,
                'title' => "Productos en la categoría: {$category->name}",
                'categories' => $categories,
            ]);
        }
        
        $products = $query->latest()->paginate(10);
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $categories = Category::where('is_active', true)->get();
        $selectedCategoryId = $request->input('category_id');
        
        return view('admin.products.create', compact('categories', 'selectedCategoryId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'preferencia_uno' => 'nullable|string|max:255',
            'preferencia_dos' => 'nullable|string|max:255',
            'preferencia_tres' => 'nullable|string|max:255',
            'opciones_preferencia_uno' => 'nullable|array',
            'opciones_preferencia_dos' => 'nullable|array',
            'opciones_preferencia_tres' => 'nullable|array',
            'max_selecciones_uno' => 'nullable|integer|min:1|max:3',
            'max_selecciones_dos' => 'nullable|integer|min:1|max:3',
            'max_selecciones_tres' => 'nullable|integer|min:1|max:3',
        ]);

        // Procesar opciones de preferencias
        foreach (['uno', 'dos', 'tres'] as $pref) {
            $opcionesKey = "opciones_preferencia_$pref";
            $maxKey = "max_selecciones_$pref";
            
            if (isset($validated[$opcionesKey]) && is_array($validated[$opcionesKey])) {
                // Filtrar valores vacíos y limpiar el array
                $opciones = array_filter($validated[$opcionesKey], function($value) {
                    return !empty(trim($value));
                });
                $validated[$opcionesKey] = array_values($opciones); // Reindexar el array
            } else {
                $validated[$opcionesKey] = [];
            }
            
            // Si no se proporciona un valor para max_selecciones, establecer el valor por defecto
            if (!isset($validated[$maxKey])) {
                $validated[$maxKey] = 1;
            }
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($product->id),
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'remove_image' => 'sometimes|boolean',
            'preferencia_uno' => 'nullable|string|max:255',
            'preferencia_dos' => 'nullable|string|max:255',
            'preferencia_tres' => 'nullable|string|max:255',
            'opciones_preferencia_uno' => 'nullable|array',
            'opciones_preferencia_dos' => 'nullable|array',
            'opciones_preferencia_tres' => 'nullable|array',
            'max_selecciones_uno' => 'nullable|integer|min:1|max:3',
            'max_selecciones_dos' => 'nullable|integer|min:1|max:3',
            'max_selecciones_tres' => 'nullable|integer|min:1|max:3',
        ]);
        
        // Procesar opciones de preferencias
        foreach (['uno', 'dos', 'tres'] as $pref) {
            $opcionesKey = "opciones_preferencia_$pref";
            $maxKey = "max_selecciones_$pref";
            
            if (isset($validated[$opcionesKey]) && is_array($validated[$opcionesKey])) {
                // Filtrar valores vacíos y limpiar el array
                $opciones = array_filter($validated[$opcionesKey], function($value) {
                    return !empty(trim($value));
                });
                $validated[$opcionesKey] = array_values($opciones); // Reindexar el array
            } else {
                $validated[$opcionesKey] = [];
            }
            
            // Si no se proporciona un valor para max_selecciones, mantener el valor actual
            if (!isset($validated[$maxKey])) {
                $validated[$maxKey] = $product->{$maxKey} ?? 1;
            }
        }

        if ($request->has('remove_image') && $request->remove_image) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
                $validated['image'] = null;
            }
        } elseif ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Eliminar la imagen si existe
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}
