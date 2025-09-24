<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('gallery_images')) {
            // Si por alguna razón no existe, créala completa
            Schema::create('gallery_images', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('file_path');
                $table->string('alt_text')->nullable();
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('ordering')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
            return;
        }

        Schema::table('gallery_images', function (Blueprint $table) {
            if (!Schema::hasColumn('gallery_images', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('gallery_images', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('gallery_images', 'file_path')) {
                $table->string('file_path');
            }
            if (!Schema::hasColumn('gallery_images', 'alt_text')) {
                $table->string('alt_text')->nullable();
            }
            if (!Schema::hasColumn('gallery_images', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('gallery_images', 'ordering')) {
                $table->unsignedInteger('ordering')->nullable();
            }
            if (!Schema::hasColumn('gallery_images', 'created_at')) {
                $table->timestamps();
            }
            if (!Schema::hasColumn('gallery_images', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        // En down no eliminamos columnas condicionalmente para evitar pérdida de datos accidental.
        // Si necesitas revertir, hazlo manualmente.
    }
};
