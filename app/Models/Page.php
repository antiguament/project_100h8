<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'features',
        'specialties',
        'testimonials',
        'address',
        'phone',
        'email',
        'whatsapp',
        'facebook',
        'instagram',
        'whatsapp_link',
        'opening_hours',
        'meta_title',
        'meta_description',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'specialties' => 'array',
        'testimonials' => 'array',
        'opening_hours' => 'array',
        'is_active' => 'boolean'
    ];
    
    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Log when a model is being saved
        static::saving(function ($model) {
            Log::info('Guardando página', [
                'id' => $model->id,
                'slug' => $model->slug,
                'changes' => $model->getDirty(),
                'original' => $model->getOriginal()
            ]);
        });

        // Log when a model is saved
        static::saved(function ($model) {
            Log::info('Página guardada exitosamente', [
                'id' => $model->id,
                'slug' => $model->slug,
                'wasRecentlyCreated' => $model->wasRecentlyCreated,
                'attributes' => $model->getAttributes()
            ]);
        });

        // Log when a model is being updated
        static::updating(function ($model) {
            Log::info('Actualizando página', [
                'id' => $model->id,
                'slug' => $model->slug,
                'changes' => $model->getDirty(),
                'original' => $model->getOriginal()
            ]);
        });

        // Log when a model is updated
        static::updated(function ($model) {
            Log::info('Página actualizada exitosamente', [
                'id' => $model->id,
                'slug' => $model->slug,
                'changes' => $model->getChanges(),
                'original' => $model->getOriginal()
            ]);
        });
    }

    public static function rules($id = null)
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $id,
            'hero_title' => 'required|string',
            'hero_subtitle' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'whatsapp_link' => 'required|url|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'boolean',
            'features' => 'nullable|array',
            'specialties' => 'nullable|array',
            'testimonials' => 'nullable|array',
            'opening_hours' => 'required|array'
        ];
    }

    /**
     * Obtiene la URL completa de la imagen del héroe
     *
     * @return string|null
     */
    public function getHeroImageUrlAttribute()
    {
        if (empty($this->hero_image)) {
            return null;
        }
        
        // Verificar si la URL ya es completa (empieza con http)
        if (strpos($this->hero_image, 'http') === 0) {
            return $this->hero_image;
        }
        
        // Usar la ruta de Laravel para servir la imagen
        $filename = basename($this->hero_image);
        return route('page.image', ['filename' => $filename]);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
