<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('hero_title');
            $table->text('hero_subtitle');
            $table->string('hero_image')->nullable();
            
            // Secciones de características
            $table->json('features')->nullable();
            
            // Sección de especialidades
            $table->json('specialties')->nullable();
            
            // Testimonios
            $table->json('testimonials')->nullable();
            
            // Información de contacto
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('whatsapp');
            
            // Redes sociales
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('whatsapp_link');
            
            // Horarios
            $table->json('opening_hours');
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
