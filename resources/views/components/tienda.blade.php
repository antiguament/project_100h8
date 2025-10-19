<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allaletera - Tienda Veneciana</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Usamos una fuente sans-serif legible para el cuerpo del texto para mejorar la UX en móvil -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --venice-blue: #0A2E36; /* Azul Oscuro (Base) */
            --venice-teal: #0D4D5A; /* Teal Oscuro */
            --venice-turquoise: #117A8A; /* Turquesa */
            --venice-light: #14B8C6; /* Turquesa Claro */
            --venice-accent: #0EE4EB; /* Cian brillante */
            --venice-gold: #D4AF37; /* Dorado estándar */
            --venice-gold-light: #F1E5AC; /* Dorado Suave/Crema */
            --venice-canal: #00C2CB; /* Canal/Agua */
            --light: #F0FDFA; /* Blanco muy suave */
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
            font-family: 'Inter', sans-serif; /* Usamos Inter para legibilidad en cuerpo de texto */
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Títulos usan la fuente de lujo */
        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }
        
        /* Contenedor principal (Simulación de pantalla de móvil) */
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: rgba(10, 46, 54, 0.95);
            min-height: 100vh;
            box-shadow: 0 0 80px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            padding-bottom: 80px; /* Espacio para el footer fijo */
        }
        
        /* Fondo decorativo mejorado */
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
        
        /* Header */
        .app-header {
            position: sticky; /* Sticky para una mejor experiencia móvil */
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
        
        /* Contenido principal */
        .main-content {
            padding: 24px 16px 0;
            z-index: 10;
            position: relative;
        }
        
        /* Hero Section */
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
        
        /* Categorías */
        .categories-container {
            margin: 0 -16px;
            padding: 0 0 10px 0;
            border-bottom: 2px solid rgba(0, 194, 203, 0.1);
            margin-bottom: 20px;
            position: relative;
        }

        .categories {
            display: flex;
            overflow-x: auto;
            padding: 0 16px;
            scrollbar-width: none;
            gap: 12px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .categories::-webkit-scrollbar {
            display: none;
        }

        /* Indicadores de scroll para categorías */
        .categories-container::before,
        .categories-container::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 10px;
            width: 20px;
            pointer-events: none;
            z-index: 2;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .categories-container::before {
            left: 0;
            background: linear-gradient(to right, var(--venice-blue), transparent);
        }

        .categories-container::after {
            right: 0;
            background: linear-gradient(to left, var(--venice-blue), transparent);
        }

        .categories-container.has-scroll-left::before {
            opacity: 1;
        }

        .categories-container.has-scroll-right::after {
            opacity: 1;
        }
        
        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--light);
            transition: all 0.3s ease;
            min-width: 90px;
            padding: 5px;
            border-radius: var(--border-radius-sm);
            background: rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--venice-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            box-shadow: var(--shadow-teal);
            overflow: hidden;
        }
        
        .category-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .category-item.active .category-icon {
            background: linear-gradient(135deg, var(--venice-gold), #B8860B);
            transform: scale(1.05);
            box-shadow: var(--gold-glow);
            border-color: var(--venice-gold-light);
        }
        
        .category-name {
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            color: var(--venice-light);
            transition: color 0.3s ease;
            white-space: nowrap;
        }
        
        .category-item.active .category-name {
            color: var(--venice-gold);
            font-weight: 700;
        }
        
        /* Productos */
        .products-section {
            padding-bottom: 24px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--venice-gold-light);
            margin: 0;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--venice-accent), var(--venice-gold));
            border-radius: 3px;
        }
        
        .view-all {
            font-size: 0.9rem;
            color: var(--venice-accent);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 10px;
            background: rgba(0, 194, 203, 0.15);
            border: 1px solid rgba(0, 194, 203, 0.3);
            transition: background 0.2s;
        }
        
        .view-all:hover {
            background: rgba(0, 194, 203, 0.3);
        }

        .view-all i {
            margin-left: 5px;
            font-size: 0.8em;
        }
        
        .food-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 15px;
        }
        
        /* Tarjetas de productos */
        .food-card {
            background: linear-gradient(145deg, rgba(13, 77, 90, 0.9), rgba(10, 46, 54, 0.95));
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-teal);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(0, 194, 203, 0.3);
            position: relative;
        }

        .view-details-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--venice-gold), #B8860B);
            color: var(--venice-blue);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3);
            font-size: 1rem;
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 4;
        }

        .view-details-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(212, 175, 55, 0.5);
            background: linear-gradient(135deg, var(--venice-gold-light), var(--venice-gold));
        }
        
        .food-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-teal), var(--glow);
        }
        
        .food-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-bottom: 1px solid rgba(0, 194, 203, 0.2);
            transition: transform 0.5s ease;
        }

        .food-card:hover .food-image {
            transform: scale(1.05);
        }
        
        .food-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--venice-gold);
            color: var(--venice-blue);
            font-size: 0.7rem;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            box-shadow: var(--gold-glow);
            z-index: 3;
            letter-spacing: 0.5px;
        }
        
        .food-details {
            padding: 16px;
        }
        
        .food-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: var(--venice-gold-light);
            line-height: 1.3;
        }
        
        .food-description {
            font-size: 0.85rem;
            color: var(--venice-light);
            margin: 0 0 16px 0;
            line-height: 1.4;
            opacity: 0.7;
            font-family: 'Inter', sans-serif;
            height: 38px; /* Altura fija para evitar CLS */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .food-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .food-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--venice-accent);
            text-shadow: 0 0 5px rgba(0, 194, 203, 0.3);
        }
        
        .add-to-cart {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 194, 203, 0.3);
            font-size: 1.1rem;
        }
        
        .add-to-cart:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 194, 203, 0.5);
        }

        .add-to-cart.success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            animation: pulse 0.5s ease;
        }
        
        /* Footer Navigation (Nueva adición) */
        .footer-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            background: var(--venice-blue);
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.5);
            border-top: 1px solid rgba(0, 194, 203, 0.2);
            z-index: 60;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top-left-radius: var(--border-radius-lg);
            border-top-right-radius: var(--border-radius-lg);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--venice-teal);
            transition: color 0.3s ease;
            padding: 5px;
            border-radius: 10px;
        }

        .nav-item i {
            font-size: 1.5rem;
            color: var(--venice-light);
            transition: color 0.3s ease;
        }

        .nav-item span {
            font-size: 0.7rem;
            margin-top: 4px;
            color: var(--venice-light);
            font-weight: 600;
        }

        .nav-item.active i, .nav-item:hover i {
            color: var(--venice-gold);
            text-shadow: var(--gold-glow);
        }

        .nav-item.active span, .nav-item:hover span {
            color: var(--venice-gold-light);
        }
        
        /* Animaciones */
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
    </style>
</head>
<body>
    <div class="app-container">
        
        <!-- Header -->
        <header class="app-header">
            <a href="/" class="logo">
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
                <h1>Sabores de la Serenísima</h1>
                <p>Una selección exquisita de la mejor gastronomía y artesanía veneciana, a un toque de distancia.</p>
            </div>
            
            <!-- Categories -->
            <div class="categories-container fade-in" style="animation-delay: 0.2s;">
                <div class="categories" id="categories-container">
                    <!-- Las categorías se cargarán con JavaScript -->
                </div>
            </div>
            
            <!-- Products Section -->
            <div class="products-section">
                <div class="section-header fade-in" style="animation-delay: 0.4s;">
                    <h2 class="section-title" id="section-title">Nuestras Recomendaciones</h2>
                    <a href="#" class="view-all">
                        Ver Menú Completo
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="food-grid" id="products-container">
                    <!-- Los productos se cargarán con JavaScript -->
                </div>
            </div>
        </main>

        <!-- Footer Navigation (Nuevo) -->
        <footer class="footer-nav">
            <a href="#" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-box-open"></i>
                <span>Pedidos</span>
            </a>
            <a href="#" class="nav-item" onclick="showCart(); return false;">
                <i class="fas fa-shopping-cart"></i>
                <span>Carrito</span>
                <div class="cart-counter-nav" style="position: absolute; top: -5px; right: -5px; background: var(--venice-accent); color: var(--venice-blue); border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; font-weight: bold; display: none;">0</div>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>
        </footer>
    </div>

<?php
// Conectar a la base de datos usando la clase personalizada
require_once app_path('Database/Conexion.php');
use App\Database\Conexion;

try {
    $objConexion = new Conexion();

    // Consultar categorías activas
    $categorias = $objConexion->consultar("SELECT id, name, description, image FROM categories WHERE is_active = 1 ORDER BY name");

    // Consultar productos activos con preferencias
    $productos = $objConexion->consultar("SELECT id, name, description, price, image, category_id,
        preferencia_uno, opciones_preferencia_uno,
        preferencia_dos, opciones_preferencia_dos,
        preferencia_tres, opciones_preferencia_tres
        FROM products WHERE is_active = 1 ORDER BY name");

    // Debug: Mostrar datos del primer producto
    if (!empty($productos)) {
        echo "<!-- DEBUG PRODUCTO: " . json_encode($productos[0]) . " -->";
    }

} catch (Exception $e) {
    $categorias = [];
    $productos = [];
    echo "<div style='background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 1rem; border-radius: 0.5rem; margin: 1rem;'>Error al conectar con la base de datos: " . $e->getMessage() . "</div>";
}
?>

    <script>
        // Convertir datos PHP a JavaScript
        const categoriesData = [
            { id: 'all', name: "Todos los Productos", icon: "fas fa-star", image_url: "", is_image: false },
            <?php foreach($categorias as $categoria): ?>
            {
                id: <?php echo $categoria['id']; ?>,
                name: "<?php echo addslashes($categoria['name']); ?>",
                icon: "fas fa-utensils",
                image_url: "<?php echo $categoria['image'] ? '/storage/' . $categoria['image'] : ''; ?>",
                is_image: <?php echo $categoria['image'] ? 'true' : 'false'; ?>
            },
            <?php endforeach; ?>
        ];

        const productsData = {
            'all': [
                <?php foreach($productos as $producto): ?>
                {
                    id: <?php echo $producto['id']; ?>,
                    name: "<?php echo addslashes($producto['name']); ?>",
                    description: "<?php echo addslashes($producto['description'] ?? 'Producto delicioso'); ?>",
                    price: <?php echo $producto['price']; ?>,
                    image_url: "<?php echo $producto['image'] ? (filter_var($producto['image'], FILTER_VALIDATE_URL) ? $producto['image'] : '/storage/' . $producto['image']) : 'https://placehold.co/500x120/117A8A/F1E5AC?text=IMG'; ?>",
                    is_new: <?php echo rand(1, 5) == 1 ? 'true' : 'false'; ?>,
                    categoryId: <?php echo $producto['category_id']; ?>,
                    preferences: {
                        uno: {
                            nombre: "<?php echo addslashes($producto['preferencia_uno'] ?? ''); ?>",
                            opciones: <?php
                                $opciones = [];
                                if (!empty($producto['opciones_preferencia_uno'])) {
                                    $decoded = json_decode($producto['opciones_preferencia_uno'], true);
                                    if (is_array($decoded)) {
                                        $opciones = $decoded;
                                    }
                                }
                                echo json_encode($opciones);
                            ?>
                        },
                        dos: {
                            nombre: "<?php echo addslashes($producto['preferencia_dos'] ?? ''); ?>",
                            opciones: <?php
                                $opciones = [];
                                if (!empty($producto['opciones_preferencia_dos'])) {
                                    $decoded = json_decode($producto['opciones_preferencia_dos'], true);
                                    if (is_array($decoded)) {
                                        $opciones = $decoded;
                                    }
                                }
                                echo json_encode($opciones);
                            ?>
                        },
                        tres: {
                            nombre: "<?php echo addslashes($producto['preferencia_tres'] ?? ''); ?>",
                            opciones: <?php
                                $opciones = [];
                                if (!empty($producto['opciones_preferencia_tres'])) {
                                    $decoded = json_decode($producto['opciones_preferencia_tres'], true);
                                    if (is_array($decoded)) {
                                        $opciones = $decoded;
                                    }
                                }
                                echo json_encode($opciones);
                            ?>
                        }
                    }
                },
                <?php endforeach; ?>
            ],
            <?php
            // Crear arrays por categoría
            $productosPorCategoria = [];
            foreach($productos as $producto) {
                $catId = $producto['category_id'];
                if (!isset($productosPorCategoria[$catId])) {
                    $productosPorCategoria[$catId] = [];
                }
                $productosPorCategoria[$catId][] = $producto;
            }

            foreach($productosPorCategoria as $catId => $prods): ?>
            <?php echo $catId; ?>: [
                <?php foreach($prods as $producto): ?>
                {
                    id: <?php echo $producto['id']; ?>,
                    name: "<?php echo addslashes($producto['name']); ?>",
                    description: "<?php echo addslashes($producto['description'] ?? 'Producto delicioso'); ?>",
                    price: <?php echo $producto['price']; ?>,
                    image_url: "<?php echo $producto['image'] ? '/storage/' . $producto['image'] : 'https://placehold.co/500x120/117A8A/F1E5AC?text=IMG'; ?>",
                    is_new: <?php echo rand(1, 5) == 1 ? 'true' : 'false'; ?>,
                    categoryId: <?php echo $producto['category_id']; ?>
                },
                <?php endforeach; ?>
            ],
            <?php endforeach; ?>
        };

        let currentCategoryId = 'all';

        // Inicializar la página
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
            loadProducts(currentCategoryId); // Carga inicial

            // Inicializar carrito desde localStorage si existe
            const savedCart = localStorage.getItem('tienda_cart');
            if (savedCart) {
                try {
                    window.cart = JSON.parse(savedCart);
                    updateCartCounter();
                } catch (e) {
                    window.cart = [];
                }
            } else {
                window.cart = [];
            }

            // Inicializar indicadores de scroll
            updateScrollIndicators();

            document.getElementById('categories-container').addEventListener('click', function(e) {
                const categoryItem = e.target.closest('.category-item');
                if (categoryItem) {
                    e.preventDefault();
                    const categoryId = categoryItem.getAttribute('data-category-id');

                    // Actualizar estado activo
                    document.querySelectorAll('.category-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    categoryItem.classList.add('active');

                    // Hacer scroll suave hacia la categoría seleccionada
                    categoryItem.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });

                    // Actualizar título de sección
                    const categoryName = categoryItem.querySelector('.category-name').textContent;
                    document.getElementById('section-title').textContent = categoryName;

                    loadProducts(categoryId);
                    currentCategoryId = categoryId;
                }
            });

            // Event listeners para scroll de categorías
            const categoriesContainer = document.querySelector('.categories');
            if (categoriesContainer) {
                categoriesContainer.addEventListener('scroll', updateScrollIndicators);

                // Soporte para mouse wheel (rotor del mouse)
                categoriesContainer.addEventListener('wheel', function(e) {
                    e.preventDefault();
                    const delta = e.deltaY || e.deltaX;
                    const scrollAmount = 100; // Ajusta la velocidad de scroll

                    if (Math.abs(delta) > 0) {
                        categoriesContainer.scrollLeft += delta > 0 ? scrollAmount : -scrollAmount;
                    }
                }, { passive: false });

                // Soporte para touch en móviles
                let isScrolling = false;
                categoriesContainer.addEventListener('touchstart', () => {
                    isScrolling = true;
                });

                categoriesContainer.addEventListener('touchend', () => {
                    setTimeout(() => {
                        isScrolling = false;
                        updateScrollIndicators();
                    }, 150);
                });
            }

            document.getElementById('products-container').addEventListener('click', function(e) {
                const button = e.target.closest('.add-to-cart');
                if (button) {
                    const productId = button.getAttribute('data-product-id');

                    // Feedback visual
                    const initialIcon = button.querySelector('i').className;

                    button.classList.add('success');
                    button.innerHTML = '<i class="fas fa-check"></i>';

                    setTimeout(() => {
                        button.classList.remove('success');
                        button.innerHTML = `<i class="${initialIcon}"></i>`;
                    }, 1000);

                    console.log(`Producto ${productId} agregado al carrito.`);
                }
            });

            // Soporte para redimensionamiento de ventana
            window.addEventListener('resize', updateScrollIndicators);
        });

        // Función para actualizar indicadores de scroll
        function updateScrollIndicators() {
            const categoriesContainer = document.querySelector('.categories');
            const containerWrapper = document.querySelector('.categories-container');

            if (!categoriesContainer || !containerWrapper) return;

            const scrollLeft = categoriesContainer.scrollLeft;
            const scrollWidth = categoriesContainer.scrollWidth;
            const clientWidth = categoriesContainer.clientWidth;

            // Verificar si hay scroll disponible a la izquierda
            const hasScrollLeft = scrollLeft > 0;

            // Verificar si hay scroll disponible a la derecha
            const hasScrollRight = scrollLeft < (scrollWidth - clientWidth - 1);

            // Actualizar clases CSS
            containerWrapper.classList.toggle('has-scroll-left', hasScrollLeft);
            containerWrapper.classList.toggle('has-scroll-right', hasScrollRight);
        }

        // Cargar categorías
        function loadCategories() {
            const categoriesContainer = document.getElementById('categories-container');
            let categoriesHTML = '';

            categoriesData.forEach(category => {
                const isActive = category.id === currentCategoryId ? 'active' : '';

                let iconOrImage = '';
                if (category.is_image && category.image_url) {
                    // Usar imagen para categorías con imagen
                    iconOrImage = `<img src="${category.image_url}" alt="${category.name}" onerror="this.onerror=null; this.src='https://placehold.co/60x60/117A8A/F1E5AC?text=IMG'">`;
                } else {
                    // Usar icono
                    iconOrImage = `<i class="${category.icon}" style="color: var(--venice-blue); font-size: 1.5rem;"></i>`;
                }

                categoriesHTML += `
                    <div class="category-item ${isActive}" data-category-id="${category.id}">
                        <div class="category-icon">
                            ${iconOrImage}
                        </div>
                        <span class="category-name">${category.name}</span>
                    </div>
                `;
            });

            categoriesContainer.innerHTML = categoriesHTML;

            // Actualizar indicadores de scroll después de cargar categorías
            setTimeout(updateScrollIndicators, 100);
        }

        // Cargar productos
        function loadProducts(categoryId) {
            const productsContainer = document.getElementById('products-container');
            // Usamos 'all' como fallback si la categoría no existe o es 'all'
            const products = productsData[categoryId] || productsData['all'];
            let productsHTML = '';

            if (products && products.length > 0) {
                products.forEach((product, index) => {
                    productsHTML += `
                        <div class="food-card fade-in" style="animation-delay: ${index * 0.08}s;">
                            ${product.is_new ? '<span class="food-badge">NOVITÀ</span>' : ''}
                            <a href="{{ url('/producto') }}/${product.id}" class="view-details-btn">
                                <i class="fas fa-eye"></i>
                            </a>
                            <img src="${product.image_url}" alt="${product.name}" class="food-image" onerror="this.onerror=null; this.src='https://placehold.co/500x120/117A8A/F1E5AC?text=ALLALETERA'">
                            <div class="food-details">
                                <h3 class="food-name">${product.name}</h3>
                                <p class="food-description">${product.description}</p>
                                <div class="food-footer">
                                    <span class="food-price">$${product.price.toFixed(2)}</span>
                                    <button type="button" class="add-to-cart" data-product-id="${product.id}" onclick="addToCart(${product.id}, '${product.name.replace(/'/g, '\\\'')}', ${product.price}, '${product.image_url}', ${product.categoryId})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                productsHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                        <i class="fas fa-box-open" style="font-size: 4rem; color: var(--venice-light); opacity: 0.5; margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--venice-gold-light); margin-bottom: 0.5rem;">No hay productos disponibles</h3>
                        <p style="color: var(--venice-light); opacity: 0.7;">Pronto agregaremos más productos a esta categoría.</p>
                    </div>
                `;
            }

            productsContainer.innerHTML = productsHTML;
        }

        // Función para mostrar detalles del producto
        function showProductDetails(productId, name, description, price, imageUrl, isNew, preferencesJson) {
            console.log('Preferences JSON:', preferencesJson); // Debug

            // Parsear las preferencias
            let preferences = {};
            try {
                preferences = JSON.parse(preferencesJson) || {};
                console.log('Parsed preferences:', preferences); // Debug
            } catch (e) {
                console.error('Error parsing preferences:', e); // Debug
                preferences = {};
            }

            // Crear objeto producto con los parámetros
            const product = {
                id: productId,
                name: name,
                description: description,
                price: price,
                image_url: imageUrl,
                is_new: isNew,
                preferences: preferences
            };

            console.log('Product object:', product); // Debug

            // Crear modal de detalles
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                animation: fadeIn 0.3s ease;
            `;

            modal.innerHTML = `
                <div style="
                    background: linear-gradient(145deg, var(--venice-teal), var(--venice-blue));
                    border-radius: var(--border-radius-lg);
                    max-width: 400px;
                    width: 90%;
                    max-height: 80vh;
                    overflow-y: auto;
                    box-shadow: var(--shadow-teal), var(--glow);
                    position: relative;
                    animation: slideIn 0.3s ease;
                ">
                    <div style="
                        position: absolute;
                        top: 15px;
                        right: 15px;
                        width: 30px;
                        height: 30px;
                        background: var(--venice-accent);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        color: var(--venice-blue);
                        font-weight: bold;
                        z-index: 2;
                    " onclick="this.closest('.modal-overlay').remove()">×</div>

                    <img src="${product.image_url}" alt="${product.name}" style="
                        width: 100%;
                        height: 200px;
                        object-fit: cover;
                        border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
                    " onerror="this.src='https://placehold.co/400x200/117A8A/F1E5AC?text=ALLALETERA'">

                    <div style="padding: 20px;">
                        <h2 style="
                            font-size: 1.5rem;
                            color: var(--venice-gold-light);
                            margin-bottom: 10px;
                            font-weight: 700;
                        ">${product.name}</h2>

                        <p style="
                            color: var(--venice-light);
                            margin-bottom: 15px;
                            line-height: 1.6;
                            font-size: 0.95rem;
                        ">${product.description}</p>

                        <p style="
                            color: var(--venice-light);
                            margin-bottom: 15px;
                            line-height: 1.6;
                            font-size: 0.95rem;
                        ">${product.price}</p>











                        ${(product.preferences && product.preferences.uno && product.preferences.uno.nombre) || (product.preferences && product.preferences.dos && product.preferences.dos.nombre) || (product.preferences && product.preferences.tres && product.preferences.tres.nombre) ? `
                        <!-- Información detallada del producto -->
                        <div style="margin-bottom: 20px;">
                            <h3 style="color: var(--venice-gold-light); margin-bottom: 10px; font-size: 1.5rem;">${product.name}</h3>
                            <p style="color: var(--venice-light); margin-bottom: 15px; line-height: 1.6;">${product.description}</p>
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                                <span style="font-size: 2rem; font-weight: bold; color: var(--venice-accent);">$${product.price.toLocaleString()}</span>
                                <span style="background: var(--venice-accent); color: var(--venice-blue); padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Disponible</span>
                            </div>
                        </div>

                        <!-- Selector de cantidad -->
                        <div style="margin-bottom: 20px;">
                            <h4 style="color: var(--venice-gold-light); margin-bottom: 10px; font-size: 1rem;">Cantidad</h4>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <button onclick="changeQuantity(${product.id}, -1)" style="
                                    width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--venice-accent);
                                    background: transparent; color: var(--venice-accent); font-size: 1.2rem; cursor: pointer;
                                    display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;
                                " onmouseover="this.style.background='var(--venice-accent)'; this.style.color='var(--venice-blue)'" onmouseout="this.style.background='transparent'; this.style.color='var(--venice-accent)'">-</button>
                                <span id="quantity-${product.id}" style="font-size: 1.2rem; font-weight: bold; color: var(--venice-light); min-width: 30px; text-align: center;">1</span>
                                <button onclick="changeQuantity(${product.id}, 1)" style="
                                    width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--venice-accent);
                                    background: transparent; color: var(--venice-accent); font-size: 1.2rem; cursor: pointer;
                                    display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;
                                " onmouseover="this.style.background='var(--venice-accent)'; this.style.color='var(--venice-blue)'" onmouseout="this.style.background='transparent'; this.style.color='var(--venice-accent)'">+</button>
                            </div>
                        </div>

                        <!-- Sección de personalización -->
                        ${(product.preferences && product.preferences.uno && product.preferences.uno.nombre) || (product.preferences && product.preferences.dos && product.preferences.dos.nombre) || (product.preferences && product.preferences.tres && product.preferences.tres.nombre) ? `
                        <div style="
                            margin-bottom: 20px;
                            padding: 15px;
                            background: rgba(0, 194, 203, 0.1);
                            border-radius: var(--border-radius-sm);
                            border: 1px solid rgba(0, 194, 203, 0.2);
                        ">
                            <h4 style="
                                color: var(--venice-accent);
                                font-size: 1rem;
                                font-weight: 700;
                                margin-bottom: 15px;
                                text-shadow: 0 0 3px rgba(0, 194, 203, 0.3);
                            ">🍽️ Personaliza tu pedido</h4>
                            <div style="display: grid; gap: 20px;">
                                ${product.preferences.uno && product.preferences.uno.nombre && product.preferences.uno.opciones && product.preferences.uno.opciones.length > 0 ? `
                                    <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                        <h5 style="color: var(--venice-gold-light); font-size: 0.9rem; margin-bottom: 10px; font-weight: 600;">${product.preferences.uno.nombre}</h5>
                                        <div style="display: grid; gap: 8px;">
                                            ${product.preferences.uno.opciones.map((opcion, index) => `
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <input type="radio" id="pref-uno-${product.id}-${index}" name="preference_uno_${product.id}" value="${opcion}" style="
                                                        accent-color: var(--venice-accent);
                                                        width: 16px;
                                                        height: 16px;
                                                        cursor: pointer;
                                                    " onchange="updateSelectedPreference('uno', ${product.id}, '${opcion}')">
                                                    <label for="pref-uno-${product.id}-${index}" style="
                                                        color: var(--venice-light);
                                                        font-size: 0.85rem;
                                                        cursor: pointer;
                                                        margin: 0;
                                                    ">${opcion}</label>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                ` : ''}

                                ${product.preferences.dos && product.preferences.dos.nombre && product.preferences.dos.opciones && product.preferences.dos.opciones.length > 0 ? `
                                    <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                        <h5 style="color: var(--venice-gold-light); font-size: 0.9rem; margin-bottom: 10px; font-weight: 600;">${product.preferences.dos.nombre}</h5>
                                        <div style="display: grid; gap: 8px;">
                                            ${product.preferences.dos.opciones.map((opcion, index) => `
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <input type="radio" id="pref-dos-${product.id}-${index}" name="preference_dos_${product.id}" value="${opcion}" style="
                                                        accent-color: var(--venice-accent);
                                                        width: 16px;
                                                        height: 16px;
                                                        cursor: pointer;
                                                    " onchange="updateSelectedPreference('dos', ${product.id}, '${opcion}')">
                                                    <label for="pref-dos-${product.id}-${index}" style="
                                                        color: var(--venice-light);
                                                        font-size: 0.85rem;
                                                        cursor: pointer;
                                                        margin: 0;
                                                    ">${opcion}</label>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                ` : ''}

                                ${product.preferences.tres && product.preferences.tres.nombre && product.preferences.tres.opciones && product.preferences.tres.opciones.length > 0 ? `
                                    <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                        <h5 style="color: var(--venice-gold-light); font-size: 0.9rem; margin-bottom: 10px; font-weight: 600;">${product.preferences.tres.nombre}</h5>
                                        <div style="display: grid; gap: 8px;">
                                            ${product.preferences.tres.opciones.map((opcion, index) => `
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <input type="radio" id="pref-tres-${product.id}-${index}" name="preference_tres_${product.id}" value="${opcion}" style="
                                                        accent-color: var(--venice-accent);
                                                        width: 16px;
                                                        height: 16px;
                                                        cursor: pointer;
                                                    " onchange="updateSelectedPreference('tres', ${product.id}, '${opcion}')">
                                                    <label for="pref-tres-${product.id}-${index}" style="
                                                        color: var(--venice-light);
                                                        font-size: 0.85rem;
                                                        cursor: pointer;
                                                        margin: 0;
                                                    ">${opcion}</label>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                        ` : ''}

                        <!-- Botones de acción -->
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <button onclick="addToCartFromModal(${product.id})" style="
                                flex: 1;
                                background: linear-gradient(135deg, var(--venice-accent), var(--venice-light));
                                color: var(--venice-blue);
                                border: none;
                                padding: 15px;
                                border-radius: var(--border-radius-sm);
                                font-weight: 700;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                font-size: 1rem;
                            " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>Agregar al Carrito
                            </button>
                            <button onclick="closeModal()" style="
                                background: rgba(255,255,255,0.1);
                                color: var(--venice-light);
                                border: 1px solid rgba(255,255,255,0.2);
                                padding: 15px;
                                border-radius: var(--border-radius-sm);
                                cursor: pointer;
                                transition: all 0.3s ease;
                                font-size: 1rem;
                            " onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                <i class="fas fa-times" style="margin-right: 8px;"></i>Cerrar
                            </button>
                        </div>
                        ` : ''}

                        <div style="
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin-bottom: 20px;
                        ">
                            <span style="
                                font-size: 1.5rem;
                                font-weight: 800;
                                color: var(--venice-accent);
                                text-shadow: 0 0 5px rgba(0, 194, 203, 0.3);
                            ">$${product.price.toFixed(2)}</span>

                            ${product.is_new ? '<span style="background: var(--venice-gold); color: var(--venice-blue); padding: 4px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 700;">NOVITÀ</span>' : ''}
                        </div>

                        <div style="
                            display: flex;
                            gap: 10px;
                            justify-content: center;
                        ">
                            <button style="
                                flex: 1;
                                background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
                                color: var(--venice-blue);
                                border: none;
                                padding: 12px;
                                border-radius: var(--border-radius-sm);
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                gap: 8px;
                            " onclick="addToCartFromModal(${product.id})">
                                <i class="fas fa-plus"></i>
                                Agregar al Carrito
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Agregar estilos de animación
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from { transform: scale(0.9) translateY(-20px); opacity: 0; }
                    to { transform: scale(1) translateY(0); opacity: 1; }
                }
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.8);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 1000;
                    animation: fadeIn 0.3s ease;
                }
            `;
            document.head.appendChild(style);

            // Agregar clase para facilitar el cierre
            modal.className = 'modal-overlay';

            document.body.appendChild(modal);

            // Cerrar modal al hacer click fuera
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });

            // Cerrar con tecla Escape
            document.addEventListener('keydown', function closeModal(e) {
                if (e.key === 'Escape') {
                    modal.remove();
                    document.removeEventListener('keydown', closeModal);
                }
            });
        }

        // Función para agregar al carrito (desde tarjetas)
        function addToCart(productId, name, price, imageUrl, categoryId) {
            // Crear objeto del producto
            const product = {
                id: productId,
                nombre: name,
                valor: price,
                cantidad: 1,
                subtotal: price,
                imagen: imageUrl,
                id_categoria: categoryId,
                id_cliente: 1,
                id_empleado: 25,
                id_sucursal: 1,
                pedido_numero: 360,
                fecha: new Date().toISOString().slice(0, 19).replace('T', ' '),
                pedido_nota2: '',
                pedido_nota3: 'tienda'
            };

            // Agregar al carrito de sesión
            if (!window.cart) {
                window.cart = [];
            }

            // Verificar si el producto ya está en el carrito
            const existingProduct = window.cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.cantidad += 1;
                existingProduct.subtotal = existingProduct.cantidad * existingProduct.valor;
            } else {
                window.cart.push(product);
            }

            // Guardar en localStorage
            localStorage.setItem('tienda_cart', JSON.stringify(window.cart));

            // Actualizar contador del carrito
            updateCartCounter();

            // Feedback visual
            const button = document.querySelector(`.add-to-cart[data-product-id="${productId}"]`);
            if (button) {
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

                setTimeout(() => {
                    button.innerHTML = originalIcon;
                    button.style.background = '';
                }, 1000);
            }

            console.log('Producto agregado al carrito:', product);
            console.log('Carrito actual:', window.cart);
        }

        // Función para actualizar contador del carrito
        function updateCartCounter() {
            // Buscar elementos del contador del carrito
            const cartCounters = document.querySelectorAll('.cart-counter, .cart-count, .cart-counter-nav');
            cartCounters.forEach(counter => {
                if (window.cart) {
                    const totalItems = window.cart.reduce((sum, item) => sum + item.cantidad, 0);
                    counter.textContent = totalItems;
                    counter.style.display = totalItems > 0 ? 'flex' : 'none';
                }
            });
        }

        // Función para mostrar el carrito
        function showCart() {
            if (!window.cart || window.cart.length === 0) {
                // Mostrar mensaje de carrito vacío
                showEmptyCartMessage();
                return;
            }

            // Crear modal del carrito
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 2000;
                animation: fadeIn 0.3s ease;
            `;

            const total = window.cart.reduce((sum, item) => sum + item.subtotal, 0);

            modal.innerHTML = `
                <div style="
                    background: linear-gradient(145deg, var(--venice-teal), var(--venice-blue));
                    border-radius: var(--border-radius-lg);
                    max-width: 500px;
                    width: 90%;
                    max-height: 80vh;
                    overflow-y: auto;
                    box-shadow: var(--shadow-teal), var(--glow);
                    position: relative;
                    animation: slideIn 0.3s ease;
                ">
                    <div style="
                        position: absolute;
                        top: 15px;
                        right: 15px;
                        width: 30px;
                        height: 30px;
                        background: var(--venice-accent);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        color: var(--venice-blue);
                        font-weight: bold;
                        z-index: 2;
                    " onclick="this.closest('.cart-modal-overlay').remove()">×</div>

                    <div style="padding: 20px;">
                        <h2 style="
                            font-size: 1.8rem;
                            color: var(--venice-gold-light);
                            margin-bottom: 20px;
                            text-align: center;
                            font-weight: 700;
                        ">Tu Carrito de Compras</h2>

                        <div style="max-height: 400px; overflow-y: auto; margin-bottom: 20px;">
                            ${window.cart.map((item, index) => `
                                <div style="
                                    display: flex;
                                    align-items: center;
                                    background: rgba(255, 255, 255, 0.1);
                                    border-radius: 10px;
                                    padding: 15px;
                                    margin-bottom: 10px;
                                    border: 1px solid rgba(0, 194, 203, 0.2);
                                ">
                                    ${item.imagen ? `<img src="${item.imagen}" alt="${item.nombre}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 15px;">` : ''}
                                    <div style="flex: 1;">
                                        <h4 style="color: var(--venice-gold-light); margin: 0 0 5px 0; font-size: 1rem;">${item.nombre}</h4>
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: var(--venice-light); font-size: 0.9rem;">Cant: ${item.cantidad}</span>
                                            <span style="color: var(--venice-accent); font-weight: bold;">$${item.subtotal.toLocaleString()}</span>
                                        </div>
                                        ${item.preferencia1 || item.preferencia2 || item.preferencia3 ? `
                                            <div style="margin-top: 5px; font-size: 0.8rem; color: var(--venice-gold);">
                                                ${item.preferencia1 ? `• ${item.preferencia1}` : ''}
                                                ${item.preferencia2 ? ` • ${item.preferencia2}` : ''}
                                                ${item.preferencia3 ? ` • ${item.preferencia3}` : ''}
                                            </div>
                                        ` : ''}
                                    </div>
                                    <button onclick="removeFromCart(${index})" style="
                                        background: #ef4444;
                                        color: white;
                                        border: none;
                                        border-radius: 50%;
                                        width: 30px;
                                        height: 30px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        cursor: pointer;
                                        margin-left: 10px;
                                        font-size: 0.8rem;
                                    " onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `).join('')}
                        </div>

                        <div style="
                            border-top: 2px solid var(--venice-accent);
                            padding-top: 15px;
                            margin-bottom: 20px;
                        ">
                            <div style="
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                font-size: 1.2rem;
                                font-weight: bold;
                            ">
                                <span style="color: var(--venice-gold-light);">TOTAL:</span>
                                <span style="color: var(--venice-accent); font-size: 1.4rem;">$${total.toLocaleString()}</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <button onclick="clearCart()" style="
                                flex: 1;
                                background: linear-gradient(135deg, #ef4444, #dc2626);
                                color: white;
                                border: none;
                                padding: 12px;
                                border-radius: var(--border-radius-sm);
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                            " onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fas fa-trash" style="margin-right: 8px;"></i>Vaciar Carrito
                            </button>
                            <button onclick="checkout()" style="
                                flex: 1;
                                background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
                                color: var(--venice-blue);
                                border: none;
                                padding: 12px;
                                border-radius: var(--border-radius-sm);
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                            " onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fas fa-credit-card" style="margin-right: 8px;"></i>Finalizar Compra
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Agregar clase para facilitar el cierre
            modal.className = 'cart-modal-overlay';

            document.body.appendChild(modal);

            // Cerrar modal al hacer click fuera
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });

            // Cerrar con tecla Escape
            document.addEventListener('keydown', function closeModal(e) {
                if (e.key === 'Escape') {
                    modal.remove();
                    document.removeEventListener('keydown', closeModal);
                }
            });
        }

        // Función para mostrar mensaje de carrito vacío
        function showEmptyCartMessage() {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 2000;
                animation: fadeIn 0.3s ease;
            `;

            modal.innerHTML = `
                <div style="
                    background: linear-gradient(145deg, var(--venice-teal), var(--venice-blue));
                    border-radius: var(--border-radius-lg);
                    max-width: 400px;
                    width: 90%;
                    padding: 30px;
                    text-align: center;
                    box-shadow: var(--shadow-teal), var(--glow);
                    animation: slideIn 0.3s ease;
                ">
                    <i class="fas fa-shopping-cart" style="font-size: 4rem; color: var(--venice-gold); margin-bottom: 20px;"></i>
                    <h3 style="color: var(--venice-gold-light); margin-bottom: 15px; font-size: 1.5rem;">Tu carrito está vacío</h3>
                    <p style="color: var(--venice-light); margin-bottom: 25px; opacity: 0.8;">¡Agrega algunos productos deliciosos para comenzar!</p>
                    <button onclick="this.closest('.cart-modal-overlay').remove()" style="
                        background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
                        color: var(--venice-blue);
                        border: none;
                        padding: 12px 24px;
                        border-radius: var(--border-radius-sm);
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Continuar Comprando
                    </button>
                </div>
            `;

            modal.className = 'cart-modal-overlay';
            document.body.appendChild(modal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }

        // Función para remover item del carrito
        function removeFromCart(index) {
            if (window.cart && window.cart[index]) {
                window.cart.splice(index, 1);
                localStorage.setItem('tienda_cart', JSON.stringify(window.cart));
                updateCartCounter();

                // Actualizar el modal si está abierto
                const modal = document.querySelector('.cart-modal-overlay');
                if (modal) {
                    modal.remove();
                    showCart();
                }

                console.log('Producto removido del carrito. Carrito actual:', window.cart);
            }
        }

        // Función para vaciar carrito
        function clearCart() {
            window.cart = [];
            localStorage.removeItem('tienda_cart');
            updateCartCounter();

            const modal = document.querySelector('.cart-modal-overlay');
            if (modal) {
                modal.remove();
                showEmptyCartMessage();
            }

            console.log('Carrito vaciado');
        }

        // Función para finalizar compra
        function checkout() {
            // Aquí puedes implementar la lógica de checkout
            // Por ahora, solo mostramos un mensaje
            alert('Funcionalidad de checkout próximamente. Total: $' + window.cart.reduce((sum, item) => sum + item.subtotal, 0).toLocaleString());
        }

        // Almacenamiento temporal de preferencias seleccionadas
        const selectedPreferences = {};

        // Función para actualizar preferencias seleccionadas
        function updateSelectedPreference(type, productId, value) {
            if (!selectedPreferences[productId]) {
                selectedPreferences[productId] = {};
            }
            selectedPreferences[productId][type] = value;
            console.log('Preferencias actualizadas:', selectedPreferences);
        }

        // Función para cambiar cantidad en el modal
        function changeQuantity(productId, change) {
            const quantityElement = document.getElementById(`quantity-${productId}`);
            let currentQuantity = parseInt(quantityElement.textContent);
            currentQuantity += change;

            // Limitar entre 1 y 99
            if (currentQuantity < 1) currentQuantity = 1;
            if (currentQuantity > 99) currentQuantity = 99;

            quantityElement.textContent = currentQuantity;
        }

        // Función para agregar al carrito desde el modal
        function addToCartFromModal(productId) {
            // Obtener la cantidad seleccionada
            const quantityElement = document.getElementById(`quantity-${productId}`);
            const quantity = parseInt(quantityElement.textContent) || 1;

            // Obtener las preferencias seleccionadas del almacenamiento temporal
            const productPreferences = selectedPreferences[productId] || {};
            const selectedPreferencesFinal = {
                preferencia1: productPreferences.uno || '',
                preferencia2: productPreferences.dos || '',
                preferencia3: productPreferences.tres || ''
            };

            // Buscar el producto en los datos para obtener información completa
            let productData = null;
            for (const category in productsData) {
                if (productsData[category] && Array.isArray(productsData[category])) {
                    productData = productsData[category].find(p => p.id === productId);
                    if (productData) break;
                }
            }

            if (productData) {
                // Agregar al carrito con preferencias y cantidad
                const product = {
                    id: productData.id,
                    nombre: productData.name,
                    valor: productData.price,
                    cantidad: quantity,
                    subtotal: productData.price * quantity,
                    imagen: productData.image_url,
                    id_categoria: productData.categoryId,
                    id_cliente: 1,
                    id_empleado: 25,
                    id_sucursal: 1,
                    pedido_numero: 360,
                    fecha: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    pedido_nota2: '',
                    pedido_nota3: 'tienda',
                    ...selectedPreferencesFinal
                };

                // Agregar al carrito de sesión
                if (!window.cart) {
                    window.cart = [];
                }

                // Verificar si el producto ya está en el carrito
                const existingProduct = window.cart.find(item => item.id === productId);
                if (existingProduct) {
                    existingProduct.cantidad += 1;
                    existingProduct.subtotal = existingProduct.cantidad * existingProduct.valor;
                } else {
                    window.cart.push(product);
                }

                // Guardar en localStorage
                localStorage.setItem('tienda_cart', JSON.stringify(window.cart));

                // Actualizar contador del carrito
                updateCartCounter();

                console.log('Producto con preferencias agregado al carrito:', product);
                console.log('Carrito actual:', window.cart);
            }

            // Cerrar modal
            document.querySelector('.modal-overlay').remove();
        }
    </script>
</body>
</html>
