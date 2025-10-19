<?php
session_start();

// Eliminar un registro específico del carrito
if (isset($_GET['eliminar'])) {
    $indice = $_GET['eliminar'];
    if (isset($_SESSION['miSesion1'][$indice])) {
        unset($_SESSION['miSesion1'][$indice]);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Vaciar carrito completo
if (isset($_GET['vaciar'])) {
    unset($_SESSION['miSesion1']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Conectar a la base de datos usando la clase personalizada
require_once app_path('Database/Conexion.php');

try {
    $objConexion = new \App\Database\Conexion();

    // Consultar productos con preferencias para la galería
    $productos = $objConexion->consultar("SELECT id, name, description, price, image, category_id,
        preferencia_uno, opciones_preferencia_uno, max_selecciones_uno,
        preferencia_dos, opciones_preferencia_dos, max_selecciones_dos,
        preferencia_tres, opciones_preferencia_tres, max_selecciones_tres
        FROM products WHERE is_active = 1 ORDER BY name");

    // Consultar categorías activas
    $categorias = $objConexion->consultar("SELECT id, name, description, image FROM categories WHERE is_active = 1 ORDER BY name");

} catch (Exception $e) {
    $productos = [];
    $categorias = [];
    // Mensaje de error visible pero estilizado
    echo "<div style='background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 1rem; border-radius: 0.5rem; margin: 1rem; font-family: sans-serif;'>Error al cargar datos: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Productos</title>
    <!-- Incluir FontAwesome para los iconos (si no está ya incluido) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --venice-blue: #0A2E36;
            --venice-teal: #0D4D5A;
            --venice-turquoise: #117A8A;
            --venice-light: #14B8C6;
            --venice-accent: #0EE4EB;
            --venice-gold: #D4AF37;
            --venice-gold-light: #F1E5AC;
            --venice-canal: #00C2CB;
            --light: #F0FDFA;
            --shadow-teal: 0 4px 25px rgba(0, 194, 203, 0.25);
            --shadow-gold: 0 4px 20px rgba(212, 175, 55, 0.3);
            --glow: 0 0 18px rgba(0, 194, 203, 0.6);
            --gold-glow: 0 0 12px rgba(212, 175, 55, 0.7);
            --border-radius-lg: 20px;
            --border-radius-sm: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--venice-blue) 0%, #081d21 100%);
            color: var(--light);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: rgba(10, 46, 54, 0.95);
            min-height: 100vh;
            box-shadow: 0 0 80px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            padding-bottom: 80px;
        }

        .app-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 10% 20%, rgba(20, 184, 198, 0.1) 0%, transparent 40%),
                       radial-gradient(circle at 90% 80%, rgba(212, 175, 55, 0.08) 0%, transparent 40%);
            z-index: 0;
            pointer-events: none;
        }

        .app-header {
            position: sticky;
            top: 0;
            width: 100%;
            max-width: 480px;
            z-index: 50;
            background: var(--venice-blue);
            padding: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            border-bottom-left-radius: var(--border-radius-sm);
            border-bottom-right-radius: var(--border-radius-sm);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--venice-gold-light);
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: var(--gold-glow);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 800;
            font-size: 1.3rem;
            box-shadow: var(--glow);
        }

        .gold-accent {
            color: var(--venice-gold);
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.6);
        }

        .header-icons {
            font-size: 1.3rem;
        }

        .header-icons i {
            margin-left: 20px;
            color: var(--venice-gold);
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .header-icons i:hover {
            color: var(--venice-accent);
        }

        .main-content {
            padding: 24px 16px 0;
            z-index: 10;
            position: relative;
        }

        .hero {
            margin-bottom: 30px;
            padding: 10px 0;
        }

        .hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--venice-gold-light);
        }

        .hero p {
            color: var(--venice-light);
            font-size: 1rem;
            font-weight: 400;
            opacity: 0.8;
            font-family: 'Inter', sans-serif;
        }

        .gallery-section {
            padding-bottom: 24px;
        }

        .gallery-filter {
            padding: 0px 15px;
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .gallery-filter .filter-item {
            color: var(--venice-gold-light);
            font-size: 18px;
            text-transform: uppercase;
            display: inline-block;
            margin: 0 10px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            line-height: 2.2;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: var(--border-radius-sm);
            background: rgba(0, 194, 203, 0.1);
            border: 1px solid rgba(0, 194, 203, 0.2);
        }

        .gallery-filter .filter-item.active {
            color: var(--venice-accent);
            border-color: var(--venice-accent);
            background: rgba(0, 194, 203, 0.2);
            box-shadow: var(--glow);
        }

        .gallery-filter .filter-item:hover {
            background: rgba(0, 194, 203, 0.15);
            transform: translateY(-2px);
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 15px;
        }

        .gallery-item {
            background: linear-gradient(145deg, rgba(13, 77, 90, 0.9), rgba(10, 46, 54, 0.95));
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-teal);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(0, 194, 203, 0.3);
            position: relative;
            display: block !important;
            opacity: 1 !important;
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-teal), var(--glow);
        }

        .gallery-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-bottom: 1px solid rgba(0, 194, 203, 0.2);
            transition: transform 0.5s ease;
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.05);
        }

        .gallery-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--venice-gold);
            color: var(--venice-blue);
            font-size: 0.7rem;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 12px;
            box-shadow: var(--gold-glow);
            z-index: 3;
            letter-spacing: 0.5px;
        }

        .gallery-details {
            padding: 16px;
        }

        .gallery-name {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: var(--venice-gold-light);
            line-height: 1.3;
        }

        .gallery-description {
            font-size: 0.85rem;
            color: var(--venice-light);
            margin: 0 0 12px 0;
            line-height: 1.4;
            opacity: 0.7;
            font-family: 'Inter', sans-serif;
            height: 32px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .view-image-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 194, 203, 0.3);
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            gap: 8px;
        }

        .view-image-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 194, 203, 0.5);
        }

        /* --- Animaciones JS --- */
        .gallery-item.show {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .gallery-item.hide {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }
        
        .image-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .image-modal-content {
            background: linear-gradient(145deg, var(--venice-teal), var(--venice-blue));
            border-radius: var(--border-radius-lg);
            max-width: 90%;
            max-height: 90%;
            overflow: hidden;
            box-shadow: var(--shadow-teal), var(--glow);
            position: relative;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: scale(0.9) translateY(-20px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 35px;
            height: 35px;
            background: var(--venice-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--venice-blue);
            font-weight: bold;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 194, 203, 0.5);
        }

        .modal-image {
            width: 100%;
            max-height: 60vh;
            object-fit: contain;
            display: block;
        }

        .modal-info {
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--venice-gold-light);
        }

        .modal-description {
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
            margin: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(46, 204, 113, 0); }
            100% { transform: scale(1); }
        }

        /* Responsive */
        @media(max-width: 991px) {
            .gallery-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width: 767px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .gallery-filter .filter-item {
                margin-bottom: 10px;
                font-size: 14px;
                padding: 6px 12px;
            }

            .hero h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="app-header">
            <a href="{{ route('welcome') }}" class="logo">
                <div class="logo-icon">A</div>
                <span>Alla<span class="gold-accent">letera</span></span>
            </a>
            <div class="header-icons">
                <i class="fas fa-search"></i>
                <i class="fas fa-bell"></i>
                <div class="cart-icon-container" onclick="showCart()" style="position: relative; cursor: pointer;">
                    <i class="fas fa-shopping-cart" style="color: var(--venice-gold); font-size: 1.3rem;"></i>
                    <span class="cart-counter" style="position: absolute; top: -8px; right: -8px; background: var(--venice-accent); color: var(--venice-blue); border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: bold; display: none;">0</span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <div class="hero fade-in" style="animation-delay: 0s;">
                <h1>Galería de Imágenes</h1>
                <p>Descubre nuestras deliciosas creaciones culinarias en imágenes de alta calidad.</p>
            </div>

            <!-- Gallery Section -->
            <div class="gallery-section">
                <div class="gallery-filter fade-in" style="animation-delay: 0.2s;">
                    <span class="filter-item active" data-filter="all">Todas las Imágenes</span>
                    <?php foreach($categorias as $categoria): ?>
                        <span class="filter-item" data-filter="<?php echo $categoria['id']; ?>"><?php echo $categoria['name']; ?></span>
                    <?php endforeach; ?>
                </div>

                <div class="gallery-grid" id="gallery-container">
                    <?php if (!empty($productos)): ?>
                        <?php foreach($productos as $index => $producto): ?>
                            <div class="gallery-item fade-in show <?php echo $producto['category_id']; ?>" style="animation-delay: <?php echo $index * 0.08; ?>s;">
                                <img src="<?php echo $producto['image'] ? '/storage/' . $producto['image'] : 'https://placehold.co/400x200/117A8A/F1E5AC?text=IMG'; ?>"
                                     alt="<?php echo $producto['name']; ?>"
                                     class="gallery-image"
                                     onerror="this.src='https://placehold.co/400x200/117A8A/F1E5AC?text=ALLALETERA'">
                                <div class="gallery-details">
                                    <h3 class="gallery-name"><?php echo $producto['name']; ?></h3>
                                    <p class="gallery-description"><?php echo $producto['description'] ?? 'Producto delicioso'; ?></p>
                                    <button type="button" class="view-image-btn" onclick="openImageModal('<?php echo $producto['image'] ? '/storage/' . $producto['image'] : 'https://placehold.co/400x200/117A8A/F1E5AC?text=IMG'; ?>', '<?php echo addslashes($producto['name']); ?>', '<?php echo addslashes($producto['description'] ?? 'Producto delicioso'); ?>')">
                                        <i class="fas fa-eye"></i>
                                        Ver Imagen
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: rgba(13, 77, 90, 0.5); border-radius: var(--border-radius-lg);">
                            <i class="fas fa-images" style="font-size: 4rem; color: var(--venice-light); opacity: 0.6; margin-bottom: 20px;"></i>
                            <h3 style="color: var(--venice-gold-light); margin-bottom: 10px;">No hay productos disponibles</h3>
                            <p style="color: var(--venice-light); opacity: 0.8;">Estamos trabajando para agregar nuevas imágenes pronto.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <!-- Footer Navigation -->
        <footer class="footer-nav">
            <a href="{{ route('welcome') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('vista-1') }}" class="nav-item">
                <i class="fas fa-box-open"></i>
                <span>Productos</span>
            </a>
            <a href="{{ route('galeria.imagenes') }}" class="nav-item active">
                <i class="fas fa-images"></i>
                <span>Galería</span>
            </a>
            <a href="{{ route('cart.index') }}" class="nav-item" onclick="showCart(); return false;">
                <i class="fas fa-shopping-cart"></i>
                <span>Carrito</span>
                <div class="cart-counter-nav" style="position: absolute; top: -5px; right: -5px; background: var(--venice-accent); color: var(--venice-blue); border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; font-weight: bold; display: none;">0</div>
            </a>
        </footer>
    </div>

    <!-- Modal para mostrar imágenes ampliadas -->
    <div id="imageModal" class="image-modal-overlay" style="display: none;">
        <div class="image-modal-content">
            <button class="modal-close" onclick="closeImageModal()">×</button>
            <img id="modalImage" src="" alt="" class="modal-image">
            <div class="modal-info">
                <h3 id="modalTitle" class="modal-title"></h3>
                <p id="modalDescription" class="modal-description"></p>
            </div>
        </div>
    </div>

<script>
    // Variables globales para filtros
    const filterContainer = document.querySelector(".gallery-filter");
    const galleryItems = document.querySelectorAll(".gallery-item");

    // Sistema de filtrado
    filterContainer.addEventListener("click", (event) => {
        if(event.target.classList.contains("filter-item")) {
            // Remover clase active de todos los filtros
            filterContainer.querySelector(".active").classList.remove("active");
            // Agregar clase active al filtro seleccionado
            event.target.classList.add("active");
            const filterValue = event.target.getAttribute("data-filter");

            galleryItems.forEach((item) => {
                if(item.classList.contains(filterValue) || filterValue === 'all') {
                    item.classList.remove("hide");
                    item.classList.add("show");
                    item.style.display = 'block';
                    item.style.opacity = '1';
                    item.style.visibility = 'visible';
                } else {
                    item.classList.remove("show");
                    item.classList.add("hide");
                    item.style.display = 'none';
                    item.style.opacity = '0';
                    item.style.visibility = 'hidden';
                }
            });
        }
    });

    // Función para abrir modal de imagen
    function openImageModal(imageSrc, title, description) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('imageModal').style.display = 'flex';
    }

    // Función para cerrar modal de imagen
    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    // Cerrar modal al hacer click fuera
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Cerrar modal con tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('imageModal').style.display === 'flex') {
            closeImageModal();
        }
    });

    // Función para mostrar el carrito (placeholder)
    function showCart() {
        // Aquí puedes implementar la lógica del carrito
        alert('Funcionalidad del carrito próximamente');
    }

    // Inicializar contador del carrito
    function updateCartCounter() {
        // Aquí puedes actualizar el contador del carrito desde la sesión PHP
        // Por ahora es un placeholder
    }

    // Inicializar al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCounter();
    });
</script>
</body>
</html>
