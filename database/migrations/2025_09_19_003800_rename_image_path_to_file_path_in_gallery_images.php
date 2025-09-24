<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('gallery_images')) {
            $columns = collect(DB::select("SHOW COLUMNS FROM gallery_images"))->pluck('Field')->all();
            $hasImagePath = in_array('image_path', $columns);
            $hasFilePath = in_array('file_path', $columns);

            // Si existe image_path y no existe file_path, renombrar
            if ($hasImagePath && !$hasFilePath) {
                // Detectar tipo de image_path para mantener compatibilidad (asumimos VARCHAR(255))
                DB::statement("ALTER TABLE gallery_images CHANGE image_path file_path VARCHAR(255) NOT NULL");
            }
            
            // Si ambas existen (inconsistencia), asegurar que file_path sea NOT NULL y dejar image_path nullable temporalmente
            if ($hasImagePath && $hasFilePath) {
                DB::statement("ALTER TABLE gallery_images MODIFY file_path VARCHAR(255) NOT NULL");
                // Opcional: podríamos copiar datos si image_path tiene contenido y file_path está vacío
                DB::statement("UPDATE gallery_images SET file_path = COALESCE(file_path, image_path) WHERE (file_path IS NULL OR file_path = '') AND image_path IS NOT NULL");
                // Luego eliminar image_path
                DB::statement("ALTER TABLE gallery_images DROP COLUMN image_path");
            }
        }
    }

    public function down(): void
    {
        // No revertimos el cambio de nombre para evitar pérdida de datos. Si necesitas revertir:
        // ALTER TABLE gallery_images CHANGE file_path image_path VARCHAR(255) NOT NULL;
    }
};
