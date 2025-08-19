<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
        'preferencia_uno',
        'preferencia_dos',
        'preferencia_tres',
        'opciones_preferencia_uno',
        'opciones_preferencia_dos',
        'opciones_preferencia_tres',
        'max_selecciones_uno',
        'max_selecciones_dos',
        'max_selecciones_tres'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
        'is_active' => 'boolean',
        'opciones_preferencia_uno' => 'array',
        'opciones_preferencia_dos' => 'array',
        'opciones_preferencia_tres' => 'array',
    ];

    /**
     * The attributes that should be set to their respective default values.
     *
     * @var array
     */
    protected $attributes = [
        'opciones_preferencia_uno' => '[]',
        'opciones_preferencia_dos' => '[]',
        'opciones_preferencia_tres' => '[]',
        'max_selecciones_uno' => 1,
        'max_selecciones_dos' => 1,
        'max_selecciones_tres' => 1,
    ];

    /**
     * Get the URL of the product's image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        
        // Si la imagen ya es una URL completa, la devolvemos tal cual
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        
        // Usamos la ruta de Laravel para servir la imagen
        return route('product.image', ['filename' => basename($this->image)]);
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        
        // Si la imagen está en storage, generamos la URL correcta
        if (str_starts_with($this->image, 'public/')) {
            return asset(Storage::url($this->image));
        }
        
        // Para rutas relativas en storage
        return asset('storage/' . ltrim($this->image, '/'));
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
