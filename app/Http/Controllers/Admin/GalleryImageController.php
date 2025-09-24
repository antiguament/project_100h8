<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $images = GalleryImage::orderByRaw('COALESCE(ordering, 999999), id DESC')->paginate(20);
        return view('admin.gallery-images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.gallery-images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Si viene un solo archivo 'file', normalizar a 'files[]'
        if ($request->hasFile('file') && !$request->hasFile('files')) {
            $request->files->set('files', [$request->file('file')]);
        }

        $validated = $request->validate([
            'files' => 'required|array',
            // Usar solo mimes para permitir SVG en todas las versiones
            'files.*' => 'required|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'is_active' => 'sometimes|boolean',
        ]);

        $created = 0;
        foreach ($request->file('files', []) as $uploaded) {
            $path = $uploaded->store('gallery', 'public');
            GalleryImage::create([
                // Establecer valores por defecto para evitar errores si la columna es NOT NULL
                'title' => $request->input('title', ''),
                'description' => $request->input('description', null),
                'alt_text' => $request->input('alt_text', null),
                'file_path' => $path,
                'is_active' => $request->boolean('is_active', true),
            ]);
            $created++;
        }

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', "Se cargaron {$created} imagen(es) a la galería.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryImage $gallery_image): View
    {
        return view('admin.gallery-images.edit', ['image' => $gallery_image]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryImage $gallery_image)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'alt_text' => 'nullable|string|max:255',
            'ordering' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            // Usar solo mimes para permitir SVG en todas las versiones
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'remove_image' => 'sometimes|boolean',
        ]);

        // Manejo de imagen
        if ($request->boolean('remove_image')) {
            if ($gallery_image->file_path) {
                Storage::disk('public')->delete($gallery_image->file_path);
            }
            $validated['file_path'] = null;
        } elseif ($request->hasFile('file')) {
            if ($gallery_image->file_path) {
                Storage::disk('public')->delete($gallery_image->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('gallery', 'public');
        }

        // Normalizar is_active (checkbox)
        $validated['is_active'] = $request->has('is_active');

        $gallery_image->update($validated);

        return redirect()
            ->route('admin.gallery-images.edit', $gallery_image)
            ->with('success', 'Imagen actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryImage $gallery_image)
    {
        if ($gallery_image->file_path) {
            Storage::disk('public')->delete($gallery_image->file_path);
        }
        $gallery_image->delete();

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Imagen eliminada correctamente.');
    }
}
