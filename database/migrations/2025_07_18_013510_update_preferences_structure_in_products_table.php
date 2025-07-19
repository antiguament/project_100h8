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
        Schema::table('products', function (Blueprint $table) {
            // Cambiar las columnas de preferencias a tipo JSON para almacenar múltiples opciones
            $table->json('opciones_preferencia_uno')->nullable()->after('preferencia_uno');
            $table->json('opciones_preferencia_dos')->nullable()->after('preferencia_dos');
            $table->json('opciones_preferencia_tres')->nullable()->after('preferencia_tres');
            
            // Agregar columnas para el número máximo de selecciones permitidas
            $table->tinyInteger('max_selecciones_uno')->default(1)->after('opciones_preferencia_uno');
            $table->tinyInteger('max_selecciones_dos')->default(1)->after('opciones_preferencia_dos');
            $table->tinyInteger('max_selecciones_tres')->default(1)->after('opciones_preferencia_tres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revertir los cambios si es necesario
            $table->dropColumn([
                'opciones_preferencia_uno',
                'opciones_preferencia_dos',
                'opciones_preferencia_tres',
                'max_selecciones_uno',
                'max_selecciones_dos',
                'max_selecciones_tres'
            ]);
        });
    }
};
