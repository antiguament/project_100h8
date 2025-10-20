<?php
// Conectar a la base de datos usando la clase personalizada
require_once app_path('Database/Conexion.php');
use App\Database\Conexion;

try {
    $objConexion = new Conexion();

    // Consultar categorías activas
    $categorias = $objConexion->consultar("SELECT id, name, description, image FROM categories WHERE is_active = 1 ORDER BY name");

    // Consultar productos activos
    $productos = $objConexion->consultar("SELECT id, name, description, price, image, category_id FROM products WHERE is_active = 1 ORDER BY name LIMIT 12");

} catch (Exception $e) {
    $categorias = [];
    $productos = [];
    echo "<div style='background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 1rem; border-radius: 0.5rem; margin: 1rem;'>Error al conectar con la base de datos: " . $e->getMessage() . "</div>";
}
?>

<div style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem; font-family: 'Inter', sans-serif;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 15px; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        <h1 style="margin: 0; font-size: 2.5rem; font-weight: 700; text-align: center;">🛍️ Nuestra Tienda</h1>
        <p style="margin: 0.5rem 0 0; text-align: center; opacity: 0.9; font-size: 1.1rem;">
            Descubre nuestros productos por categoría
        </p>
    </div>

    <!-- Estadísticas -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📂</div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;"><?php echo count($categorias); ?></div>
            <div style="opacity: 0.9;">Categorías Activas</div>
        </div>

        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📦</div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;"><?php echo count($productos); ?></div>
            <div style="opacity: 0.9;">Productos Disponibles</div>
        </div>

        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">⚡</div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">100%</div>
            <div style="opacity: 0.9;">Conexión Estable</div>
        </div>
    </div>

    <!-- Categorías -->
    <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <h2 style="margin: 0 0 1.5rem; color: #333; font-size: 1.5rem;">📂 Categorías Disponibles</h2>

        <?php if (!empty($categorias)): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <?php foreach ($categorias as $categoria): ?>
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; transition: all 0.3s ease; transform: translateY(0); border: 1px solid #e5e7eb;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'">
                        <?php if ($categoria['image']): ?>
                            <div style="position: relative; overflow: hidden;">
                                <img src="/storage/<?php echo $categoria['image']; ?>"
                                     alt="<?php echo $categoria['name']; ?>"
                                     style="width: 100%; height: 192px; object-fit: cover; transition: transform 0.3s ease;">
                                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(0,0,0,0.2)'" onmouseout="this.style.background='rgba(0,0,0,0)'"></div>
                            </div>
                        <?php else: ?>
                            <div style="width: 100%; height: 192px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 3rem; color: #9ca3af;"></i>
                            </div>
                        <?php endif; ?>

                        <div style="padding: 1.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.75rem; color: #1f2937;"><?php echo $categoria['name']; ?></h3>
                            <?php if ($categoria['description']): ?>
                                <p style="color: #6b7280; margin-bottom: 1rem; line-height: 1.6;"><?php echo substr($categoria['description'], 0, 120) . (strlen($categoria['description']) > 120 ? '...' : ''); ?></p>
                            <?php endif; ?>
                            <a href="categoria.php?id=<?php echo $categoria['id']; ?>"
                               style="display: inline-block; width: 100%; text-align: center; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s ease; font-weight: 600; transform: scale(1);" onmouseover="this.style.transform='scale(1.05)'; this.style.background='linear-gradient(135deg, #2563eb 0%, #7c3aed 100%)'" onmouseout="this.style.transform='scale(1)'; this.style.background='linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%)'">
                                <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>Ver Productos
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 4rem; background: #f8f9fa; border-radius: 8px;">
                <div style="max-width: 28rem; margin: 0 auto;">
                    <i class="fas fa-store" style="font-size: 8rem; color: #d1d5db; margin-bottom: 1.5rem;"></i>
                    <h3 style="font-size: 1.875rem; font-weight: bold; color: #374151; margin-bottom: 1rem;">No hay categorías disponibles</h3>
                    <p style="color: #6b7280; font-size: 1.125rem;">Estamos trabajando para agregar nuevas categorías pronto.</p>
                    <div style="margin-top: 1.5rem;">
                        <i class="fas fa-clock" style="font-size: 2.5rem; color: #60a5fa;"></i>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Productos -->
    <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <h2 style="margin: 0 0 1.5rem; color: #333; font-size: 1.5rem;">📦 Productos Destacados</h2>

        <?php if (!empty($productos)): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <?php foreach ($productos as $producto): ?>
                    <div style="background: linear-gradient(145deg, rgba(13, 77, 90, 0.9), rgba(10, 46, 54, 0.95)); border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; border: 1px solid rgba(0, 194, 203, 0.3); position: relative;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                        <?php if ($producto['image']): ?>
                            <img src="/storage/<?php echo $producto['image']; ?>"
                                 alt="<?php echo $producto['name']; ?>"
                                 style="width: 100%; height: 180px; object-fit: cover; border-bottom: 1px solid rgba(0, 194, 203, 0.2); transition: transform 0.5s ease;">
                        <?php else: ?>
                            <div style="width: 100%; height: 180px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(0, 194, 203, 0.2);">
                                <i class="fas fa-image" style="font-size: 3rem; color: #9ca3af;"></i>
                            </div>
                        <?php endif; ?>

                        <div style="padding: 1.5rem;">
                            <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0 0 0.5rem 0; color: #ffffff; line-height: 1.3;"><?php echo $producto['name']; ?></h3>
                            <p style="font-size: 0.85rem; color: #e0f2fe; margin: 0 0 1rem 0; line-height: 1.4; opacity: 0.8; height: 38px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                <?php echo $producto['description'] ?? 'Producto delicioso'; ?>
                            </p>

                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 1.25rem; font-weight: 800; color: #0ee4eb; text-shadow: 0 0 5px rgba(0, 194, 203, 0.3);">
                                    $<?php echo number_format($producto['price'], 0, ',', '.'); ?>
                                </span>
                                <button type="button" style="width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #14b8c6, #0ee4eb); color: #0a2e36; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 194, 203, 0.3); font-size: 1.1rem;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 15px rgba(0, 194, 203, 0.5)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 203, 0.3)'">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 4rem; background: #f8f9fa; border-radius: 8px;">
                <div style="max-width: 28rem; margin: 0 auto;">
                    <i class="fas fa-box-open" style="font-size: 8rem; color: #d1d5db; margin-bottom: 1.5rem;"></i>
                    <h3 style="font-size: 1.875rem; font-weight: bold; color: #374151; margin-bottom: 1rem;">No hay productos disponibles</h3>
                    <p style="color: #6b7280; font-size: 1.125rem;">Estamos trabajando para agregar nuevos productos pronto.</p>
                    <div style="margin-top: 1.5rem;">
                        <i class="fas fa-clock" style="font-size: 2.5rem; color: #60a5fa;"></i>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Información del Sistema -->
    <div style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <h2 style="margin: 0 0 1.5rem; color: #333; font-size: 1.5rem;">🔧 Información del Sistema</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                <h4 style="margin: 0 0 0.5rem; color: #333;">📍 Configuración de Base de Datos</h4>
                <p style="margin: 0; color: #666; font-size: 0.9rem;">
                    <strong>Host:</strong> <?php echo getenv('DB_HOST') ?: 'No configurado'; ?><br>
                    <strong>Base de datos:</strong> <?php echo getenv('DB_DATABASE') ?: 'No configurado'; ?><br>
                    <strong>Usuario:</strong> <?php echo getenv('DB_USERNAME') ?: 'No configurado'; ?><br>
                    <strong>Estado:</strong> <span style="color: #28a745; font-weight: bold;">Conectado ✅</span>
                </p>
            </div>

            <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                <h4 style="margin: 0 0 0.5rem; color: #333;">⚙️ Estado de PHP</h4>
                <p style="margin: 0; color: #666; font-size: 0.9rem;">
                    <strong>Versión PHP:</strong> <?php echo PHP_VERSION; ?><br>
                    <strong>PDO MySQL:</strong> <?php echo extension_loaded('pdo_mysql') ? 'Disponible ✅' : 'No disponible ❌'; ?><br>
                    <strong>Archivo .env:</strong> <?php echo file_exists('.env') ? 'Encontrado ✅' : 'No encontrado ❌'; ?><br>
                    <strong>Entorno:</strong> Producción
                </p>
            </div>
        </div>
    </div>
</div>

<style>
/* Responsive Design */
@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr !important;
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
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
</style>