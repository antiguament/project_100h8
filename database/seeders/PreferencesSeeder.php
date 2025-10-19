<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener productos existentes
        $productos = DB::table('products')->where('is_active', true)->get();

        foreach ($productos as $producto) {
            // Definir preferencias basadas en el nombre del producto
            $preferencias = $this->getPreferenciasPorProducto($producto->name);

            DB::table('products')->where('id', $producto->id)->update([
                'preferencia_uno' => $preferencias['preferencia_uno']['nombre'] ?? null,
                'opciones_preferencia_uno' => isset($preferencias['preferencia_uno']['opciones']) ?
                    json_encode($preferencias['preferencia_uno']['opciones']) : null,
                'max_selecciones_uno' => $preferencias['preferencia_uno']['max_selecciones'] ?? 1,

                'preferencia_dos' => $preferencias['preferencia_dos']['nombre'] ?? null,
                'opciones_preferencia_dos' => isset($preferencias['preferencia_dos']['opciones']) ?
                    json_encode($preferencias['preferencia_dos']['opciones']) : null,
                'max_selecciones_dos' => $preferencias['preferencia_dos']['max_selecciones'] ?? 1,

                'preferencia_tres' => $preferencias['preferencia_tres']['nombre'] ?? null,
                'opciones_preferencia_tres' => isset($preferencias['preferencia_tres']['opciones']) ?
                    json_encode($preferencias['preferencia_tres']['opciones']) : null,
                'max_selecciones_tres' => $preferencias['preferencia_tres']['max_selecciones'] ?? 1,
            ]);
        }
    }

    /**
     * Obtener preferencias específicas por producto
     */
    private function getPreferenciasPorProducto($nombreProducto)
    {
        $preferenciasBase = [
            'preferencia_uno' => ['nombre' => null, 'opciones' => [], 'max_selecciones' => 1],
            'preferencia_dos' => ['nombre' => null, 'opciones' => [], 'max_selecciones' => 1],
            'preferencia_tres' => ['nombre' => null, 'opciones' => [], 'max_selecciones' => 1],
        ];

        // Convertir a minúsculas para comparación
        $nombreLower = strtolower($nombreProducto);

        // Preferencias para pescados
        if (strpos($nombreLower, 'pescado') !== false || strpos($nombreLower, 'filete') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Tipo de cocción',
                'opciones' => ['Plancha', 'Horno', 'Frito', 'Al vapor'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Salsa',
                'opciones' => ['Blanca', 'Roja', 'Verde', 'De ajo', 'Sin salsa'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_tres'] = [
                'nombre' => 'Acompañamiento',
                'opciones' => ['Arroz blanco', 'Papas fritas', 'Ensalada', 'Verduras al vapor'],
                'max_selecciones' => 1
            ];
        }

        // Preferencias para carnes
        elseif (strpos($nombreLower, 'carne') !== false || strpos($nombreLower, 'res') !== false ||
                strpos($nombreLower, 'pollo') !== false || strpos($nombreLower, 'cerdo') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Punto de cocción',
                'opciones' => ['Muy hecho', 'Al punto', 'Poco hecho', 'Término medio'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Salsa',
                'opciones' => ['BBQ', 'Champiñones', 'Roquefort', 'Mostaza', 'Sin salsa'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_tres'] = [
                'nombre' => 'Extra',
                'opciones' => ['Queso', 'Cebolla caramelizada', 'Champiñones', 'Panceta', 'Ninguno'],
                'max_selecciones' => 1
            ];
        }

        // Preferencias para pastas
        elseif (strpos($nombreLower, 'pasta') !== false || strpos($nombreLower, 'espagueti') !== false ||
                strpos($nombreLower, 'fettuccine') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Tipo de salsa',
                'opciones' => ['Bolognesa', 'Carbonara', 'Pesto', 'Alfredo', 'Marinara'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Proteína extra',
                'opciones' => ['Pollo', 'Carne molida', 'Champiñones', 'Salchicha', 'Ninguna'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_tres'] = [
                'nombre' => 'Tipo de queso',
                'opciones' => ['Parmesano', 'Mozzarella', 'Ricotta', 'Sin queso'],
                'max_selecciones' => 1
            ];
        }

        // Preferencias para pizzas
        elseif (strpos($nombreLower, 'pizza') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Tamaño',
                'opciones' => ['Personal', 'Mediana', 'Grande', 'Familiar'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Borde',
                'opciones' => ['Normal', 'Queso', 'Catalana', 'Sin borde'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_tres'] = [
                'nombre' => 'Extra',
                'opciones' => ['Aceitunas', 'Champiñones', 'Pepperoni', 'Ninguno'],
                'max_selecciones' => 1
            ];
        }

        // Preferencias para ensaladas
        elseif (strpos($nombreLower, 'ensalada') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Tipo de aderezo',
                'opciones' => ['Vinagreta', 'Mostaza', 'César', 'Mil islas', 'Sin aderezo'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Proteína',
                'opciones' => ['Pollo', 'Atún', 'Queso', 'Huevo', 'Sin proteína'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_tres'] = [
                'nombre' => 'Tostadas',
                'opciones' => ['Con tostadas', 'Sin tostadas'],
                'max_selecciones' => 1
            ];
        }

        // Preferencias para bebidas
        elseif (strpos($nombreLower, 'bebida') !== false || strpos($nombreLower, 'jugo') !== false ||
                strpos($nombreLower, 'refresco') !== false || strpos($nombreLower, 'agua') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Temperatura',
                'opciones' => ['Normal', 'Con hielo', 'Sin hielo'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Endulzante',
                'opciones' => ['Normal', 'Light', 'Sin azúcar'],
                'max_selecciones' => 1
            ];
            // Sin tercera preferencia para bebidas
        }

        // Preferencias para postres
        elseif (strpos($nombreLower, 'postre') !== false || strpos($nombreLower, 'helado') !== false ||
                strpos($nombreLower, 'torta') !== false || strpos($nombreLower, 'flan') !== false) {
            $preferenciasBase['preferencia_uno'] = [
                'nombre' => 'Porciones',
                'opciones' => ['Individual', 'Para 2', 'Para 4'],
                'max_selecciones' => 1
            ];
            $preferenciasBase['preferencia_dos'] = [
                'nombre' => 'Salsa',
                'opciones' => ['Chocolate', 'Caramelo', 'Fresa', 'Sin salsa'],
                'max_selecciones' => 1
            ];
            // Sin tercera preferencia para postres
        }

        return $preferenciasBase;
    }
}