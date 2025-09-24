<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'alt_text',
        'is_active',
        'ordering',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ordering' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Valores por defecto (adaptación de la sugerencia del usuario)
    // Nota: en este proyecto el campo se llama "file_path" (no "image_path").
    protected $attributes = [
        'title' => '',
        'description' => null,
        'alt_text' => null,
        // Descomenta la siguiente línea si quieres un fallback de ruta cuando no se cargue archivo
        // 'file_path' => 'gallery/default-image.jpg',
        'is_active' => true,
    ];
}
