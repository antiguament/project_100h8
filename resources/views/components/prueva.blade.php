<?php
// Conectar a la base de datos usando la clase personalizada
require_once app_path('Database/Conexion.php');

try {
    $objConexion = new App\Database\Conexion();

    // Consultar categorías (asumiendo tabla 'categories' o 'categorias')
    $categorias = $objConexion->consultar("SELECT * FROM categories WHERE is_active = 1 ORDER BY name LIMIT 10");

    // Consultar productos (asumiendo tabla 'products' o 'productos')
    $productos = $objConexion->consultar("SELECT * FROM products WHERE is_active = 1 ORDER BY name LIMIT 10");

    $conexionExitosa = true;

} catch (Exception $e) {
    $conexionExitosa = false;
    $errorMensaje = $e->getMessage();
    $categorias = [];
    $productos = [];
}
?>

<div style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem; font-family: 'Inter', sans-serif;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 15px; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        <h1 style="margin: 0; font-size: 2.5rem; font-weight: 700; text-align: center;">🧪 Prueba de Conexión a Base de Datos</h1>
        <p style="margin: 0.5rem 0 0; text-align: center; opacity: 0.9; font-size: 1.1rem;">
            Componente de prueba para verificar la funcionalidad de la base de datos
        </p>
    </div>

    <!-- Estado de Conexión -->
    <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <h2 style="margin: 0 0 1rem; color: #333; font-size: 1.5rem;">📊 Estado de Conexión</h2>

        @if($conexionExitosa)
            <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 8px; display: flex; align-items: center;">
                <span style="font-size: 1.5rem; margin-right: 0.5rem;">✅</span>
                <div>
                    <strong>Conexión Exitosa</strong>
                    <p style="margin: 0.25rem 0 0;">La base de datos está funcionando correctamente.</p>
                </div>
            </div>
        @else
            <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 8px; display: flex; align-items: center;">
                <span style="font-size: 1.5rem; margin-right: 0.5rem;">❌</span>
                <div>
                    <strong>Error de Conexión</strong>
                    <p style="margin: 0.25rem 0 0;">{{ $errorMensaje }}</p>
                </div>
            </div>
        @endif
    </div>

    @if($conexionExitosa)
        <!-- Estadísticas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📂</div>
                <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">{{ count($categorias) }}</div>
                <div style="opacity: 0.9;">Categorías Activas</div>
            </div>

            <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📦</div>
                <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">{{ count($productos) }}</div>
                <div style="opacity: 0.9;">Productos Activos</div>
            </div>

            <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">⚡</div>
                <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">100%</div>
                <div style="opacity: 0.9;">Conexión Estable</div>
            </div>
        </div>

        <!-- Tabla de Categorías -->
        <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h2 style="margin: 0 0 1.5rem; color: #333; font-size: 1.5rem;">📂 Categorías (Primeros 10 registros)</h2>

            @if(count($categorias) > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">ID</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">Nombre</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">Slug</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">Descripción</th>
                                <th style="padding: 1rem; text-align: center; font-weight: 600;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr style="border-bottom: 1px solid #eee; transition: background 0.2s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 1rem; font-weight: 500; color: #333;">{{ $categoria['id'] }}</td>
                                    <td style="padding: 1rem; font-weight: 500; color: #333;">{{ $categoria['name'] }}</td>
                                    <td style="padding: 1rem; font-size: 0.9rem; color: #666;">{{ $categoria['slug'] }}</td>
                                    <td style="padding: 1rem; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #666;">
                                        {{ $categoria['description'] ?? 'Sin descripción' }}
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <span style="background: {{ $categoria['is_active'] ? '#d4edda' : '#f8d7da' }}; color: {{ $categoria['is_active'] ? '#155724' : '#721c24' }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                            {{ $categoria['is_active'] ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 8px;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📂</div>
                    <h3 style="color: #666; margin-bottom: 0.5rem;">No hay categorías disponibles</h3>
                    <p style="color: #999;">La tabla de categorías está vacía o no existe.</p>
                </div>
            @endif
        </div>

        <!-- Tabla de Productos -->
        <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h2 style="margin: 0 0 1.5rem; color: #333; font-size: 1.5rem;">📦 Productos (Primeros 10 registros)</h2>

            @if(count($productos) > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">ID</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">Nombre</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600;">Categoría</th>
                                <th style="padding: 1rem; text-align: right; font-weight: 600;">Precio</th>
                                <th style="padding: 1rem; text-align: center; font-weight: 600;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr style="border-bottom: 1px solid #eee; transition: background 0.2s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 1rem; font-weight: 500; color: #333;">{{ $producto['id'] }}</td>
                                    <td style="padding: 1rem; font-weight: 500; color: #333;">{{ $producto['name'] }}</td>
                                    <td style="padding: 1rem; font-size: 0.9rem; color: #666;">{{ $producto['category_id'] }}</td>
                                    <td style="padding: 1rem; text-align: right; font-weight: 600; color: #28a745;">
                                        ${{ number_format($producto['price'], 0, ',', '.') }}
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <span style="background: {{ $producto['is_active'] ? '#d4edda' : '#f8d7da' }}; color: {{ $producto['is_active'] ? '#155724' : '#721c24' }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                            {{ $producto['is_active'] ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 8px;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📦</div>
                    <h3 style="color: #666; margin-bottom: 0.5rem;">No hay productos disponibles</h3>
                    <p style="color: #999;">La tabla de productos está vacía o no existe.</p>
                </div>
            @endif
        </div>

        <!-- Información del Sistema -->
        <div style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h2 style="margin: 0 0 1.5rem; color: #333; font-size: 1.5rem;">🔧 Información del Sistema</h2>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                    <h4 style="margin: 0 0 0.5rem; color: #333;">📍 Configuración de Base de Datos</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">
                        <strong>Host:</strong> {{ getenv('DB_HOST') ?: 'No configurado' }}<br>
                        <strong>Base de datos:</strong> {{ getenv('DB_DATABASE') ?: 'No configurado' }}<br>
                        <strong>Usuario:</strong> {{ getenv('DB_USERNAME') ?: 'No configurado' }}
                    </p>
                </div>

                <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                    <h4 style="margin: 0 0 0.5rem; color: #333;">⚙️ Estado de PHP</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">
                        <strong>Versión PHP:</strong> {{ PHP_VERSION }}<br>
                        <strong>PDO MySQL:</strong> {{ extension_loaded('pdo_mysql') ? 'Disponible' : 'No disponible' }}<br>
                        <strong>Archivo .env:</strong> {{ file_exists('.env') ? 'Encontrado' : 'No encontrado' }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Responsive Design */
@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr !important;
    }

    table {
        font-size: 0.8rem;
    }

    th, td {
        padding: 0.5rem !important;
    }

    h1 {
        font-size: 2rem !important;
    }

    h2 {
        font-size: 1.3rem !important;
    }
}

@media (max-width: 480px) {
    .grid {
        grid-template-columns: 1fr !important;
        gap: 1rem !important;
    }

    table {
        font-size: 0.7rem;
    }

    .stats-grid {
        grid-template-columns: 1fr 1fr !important;
    }
}
</style>