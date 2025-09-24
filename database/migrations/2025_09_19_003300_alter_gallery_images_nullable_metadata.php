<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('gallery_images')) {
            // Asegurar que file_path sea NOT NULL
            if (Schema::hasColumn('gallery_images', 'file_path')) {
                DB::statement("ALTER TABLE gallery_images MODIFY file_path VARCHAR(255) NOT NULL");
            }
            // Hacer columnas de metadatos NULL por defecto
            if (Schema::hasColumn('gallery_images', 'title')) {
                DB::statement("ALTER TABLE gallery_images MODIFY title VARCHAR(255) NULL");
            }
            if (Schema::hasColumn('gallery_images', 'description')) {
                DB::statement("ALTER TABLE gallery_images MODIFY description TEXT NULL");
            }
            if (Schema::hasColumn('gallery_images', 'alt_text')) {
                DB::statement("ALTER TABLE gallery_images MODIFY alt_text VARCHAR(255) NULL");
            }
        }
    }

    public function down(): void
    {
        // No revertimos a NOT NULL para evitar romper datos existentes.
    }
};
