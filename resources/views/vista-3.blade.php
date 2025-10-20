



<x-layout meta-title="inicio" meta-description="home description">



<br><br><br><br>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product->name; ?> | <?php echo config('app.name'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .product-detail-container {
            background: linear-gradient(145deg, rgba(13, 77, 90, 0.9), rgba(10, 46, 54, 0.95));
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-teal);
            margin-bottom: 20px;
        }

        .product-image-section {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .product-image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info-section {
            padding: 20px;
        }

        .product-category {
            display: inline-block;
            background: var(--venice-accent);
            color: var(--venice-blue);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--venice-gold-light);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 800;
            color: var(--venice-accent);
            text-shadow: 0 0 5px rgba(0, 194, 203, 0.3);
            margin-bottom: 15px;
        }

        .product-description {
            color: var(--venice-light);
            margin-bottom: 20px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .quantity-section {
            margin-bottom: 20px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--venice-accent);
            background: transparent;
            color: var(--venice-accent);
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: var(--venice-accent);
            color: var(--venice-blue);
        }

        .quantity-display {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--venice-light);
            min-width: 30px;
            text-align: center;
        }

        .preferences-section {
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(0, 194, 203, 0.1);
            border-radius: var(--border-radius-sm);
            border: 1px solid rgba(0, 194, 203, 0.2);
        }

        .preferences-title {
            color: var(--venice-accent);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 0 3px rgba(0, 194, 203, 0.3);
        }

        .preference-group {
            background: rgba(255,255,255,0.05);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .preference-title {
            color: var(--venice-gold-light);
            font-size: 0.9rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .preference-options {
            display: grid;
            gap: 8px;
        }

        .preference-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .preference-input {
            accent-color: var(--venice-accent);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .preference-label {
            color: var(--venice-light);
            font-size: 0.85rem;
            cursor: pointer;
            margin: 0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-primary {
            flex: 1;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border: none;
            padding: 15px;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: scale(1.02);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.1);
            color: var(--venice-light);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 15px;
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.2);
        }

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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
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
                <i class="fas fa-arrow-left" onclick="history.back()"></i>
                <div class="cart-icon-container" onclick="showCart()" style="position: relative; cursor: pointer;">
                    <i class="fas fa-shopping-cart" style="color: var(--venice-gold); font-size: 1.3rem;"></i>
                    <span class="cart-counter" style="position: absolute; top: -8px; right: -8px; background: var(--venice-accent); color: var(--venice-blue); border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: bold; display: none;">0</span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Product Detail Container -->
            <div class="product-detail-container fade-in">
                <!-- Product Image -->
                <div class="product-image-section">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-box-open" style="font-size: 4rem; color: #9ca3af;"></i>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="product-info-section">
                    <!-- Category -->
                    <div class="product-category">{{ $product->category->name }}</div>

                    <!-- Name and Price -->
                    <h1 class="product-name">{{ $product->name }}</h1>
                    <div class="product-price">${{ number_format($product->price, 2) }}</div>

                    <!-- Description -->
                    <div class="product-description">
                        {{ $product->description ?? 'No hay descripción disponible para este producto.' }}
                    </div>

                    <!-- Quantity Section -->
                    <div class="quantity-section">
                        <h4 style="color: var(--venice-gold-light); margin-bottom: 10px; font-size: 1rem;">Cantidad</h4>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                            <span class="quantity-display" id="quantity-display">1</span>
                            <button class="quantity-btn" onclick="changeQuantity(1)">+</button>
                        </div>
                    </div>

                    <!-- Preferences Section -->
                    @php
                        $preferences = [
                            'uno' => [
                                'titulo' => $product->preferencia_uno,
                                'opciones' => $product->opciones_preferencia_uno ?? [],
                                'max_selecciones' => $product->max_selecciones_uno ?? 1
                            ],
                            'dos' => [
                                'titulo' => $product->preferencia_dos,
                                'opciones' => $product->opciones_preferencia_dos ?? [],
                                'max_selecciones' => $product->max_selecciones_dos ?? 1
                            ],
                            'tres' => [
                                'titulo' => $product->preferencia_tres,
                                'opciones' => $product->opciones_preferencia_tres ?? [],
                                'max_selecciones' => $product->max_selecciones_tres ?? 1
                            ]
                        ];
                    @endphp

                    @if($product->preferencia_uno || $product->preferencia_dos || $product->preferencia_tres)
                    <div class="preferences-section">
                        <h4 class="preferences-title">🍽️ Personaliza tu pedido</h4>
                        <div style="display: grid; gap: 15px;">
                            @foreach(['uno', 'dos', 'tres'] as $prefNum)
                                @if(!empty($preferences[$prefNum]['titulo']) && count($preferences[$prefNum]['opciones']) > 0)
                                <div class="preference-group">
                                    <h5 class="preference-title">
                                        {{ $preferences[$prefNum]['titulo'] }}
                                        <small style="color: var(--venice-accent); font-size: 0.75rem;">
                                            (Máx. {{ $preferences[$prefNum]['max_selecciones'] }})
                                        </small>
                                    </h5>
                                    <div class="preference-options" data-max-selections="{{ $preferences[$prefNum]['max_selecciones'] }}">
                                        @foreach($preferences[$prefNum]['opciones'] as $index => $opcion)
                                            @if(!empty(trim($opcion)))
                                            <div class="preference-option">
                                                @if($preferences[$prefNum]['max_selecciones'] > 1)
                                                    <!-- Checkbox para múltiples selecciones -->
                                                    <input type="checkbox"
                                                           class="preference-input preference-option"
                                                           name="preferencia_{{ $prefNum }}_{{ $product->id }}[]"
                                                           value="{{ $opcion }}"
                                                           id="pref-{{ $prefNum }}-{{ $product->id }}-{{ $index }}"
                                                           data-pref="{{ $prefNum }}">
                                                @else
                                                    <!-- Radio button para selección única -->
                                                    <input type="radio"
                                                           class="preference-input"
                                                           name="preference_{{ $prefNum }}_{{ $product->id }}"
                                                           value="{{ $opcion }}"
                                                           id="pref-{{ $prefNum }}-{{ $product->id }}-{{ $index }}"
                                                           onchange="updateSelectedPreference('{{ $prefNum }}', {{ $product->id }}, '{{ $opcion }}')">
                                                @endif
                                                <label class="preference-label" for="pref-{{ $prefNum }}-{{ $product->id }}-{{ $index }}">
                                                    {{ $opcion }}
                                                </label>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="btn-primary" onclick="addToCartFromDetail({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->image_url }}')">
                            <i class="fas fa-shopping-cart"></i>
                            Agregar al Carrito
                        </button>
                        <button class="btn-secondary" onclick="history.back()">
                            <i class="fas fa-arrow-left"></i>
                            Volver
                        </button>
                    </div>
                </div>
            </div>

            <!-- Shopping Cart Section (similar to tienda component) -->
            <?php if(isset($_SESSION['miSesion1']) && count($_SESSION['miSesion1']) > 0): ?>
            <div style="background: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); padding: 1.5rem; margin-top: 20px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">
                        <i class="fas fa-shopping-cart" style="color: #3b82f6; margin-right: 0.75rem;"></i>
                        Carrito de Compras
                    </h2>
                    <a href="?vaciar=1" style="background: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; transition: background 0.2s ease;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                        <i class="fas fa-trash" style="margin-right: 0.5rem;"></i>Vaciar Carrito
                    </a>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white;">
                                <th style="padding: 0.75rem 1rem; text-align: left; border-radius: 0.75rem 0 0 0;">Producto</th>
                                <th style="padding: 0.75rem 1rem; text-align: center;">Cantidad</th>
                                <th style="padding: 0.75rem 1rem; text-align: center;">Precio</th>
                                <th style="padding: 0.75rem 1rem; text-align: center;">Subtotal</th>
                                <th style="padding: 0.75rem 1rem; text-align: center; border-radius: 0 0.75rem 0 0;">Acción</th>
                            </tr>
                        </thead>
                        <tbody style="border: 1px solid #e5e7eb;">
                            <?php
                            $total = 0;
                            foreach ($_SESSION['miSesion1'] as $indice => $item):
                                $subtotal = $item['cantidad'] * $item['valor'];
                                $total += $subtotal;
                            ?>
                                <tr style="transition: background 0.2s ease;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 1rem;">
                                        <div style="display: flex; align-items: center;">
                                            <div>
                                                <h4 style="font-weight: 600; color: #1f2937;"><?php echo $item['nombre']; ?></h4>
                                                <?php if (isset($item['pedido_nota2']) && !empty($item['pedido_nota2'])): ?>
                                                    <p style="font-size: 0.875rem; color: #6b7280;">Nota: <?php echo $item['pedido_nota2']; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <span style="background: #f3f4f6; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600;"><?php echo $item['cantidad']; ?></span>
                                    </td>
                                    <td style="padding: 1rem; text-align: center; font-weight: 600; color: #1f2937;">
                                        $<?php echo number_format($item['valor'], 0, ',', '.'); ?>
                                    </td>
                                    <td style="padding: 1rem; text-align: center; font-weight: bold; color: #2563eb;">
                                        $<?php echo number_format($subtotal, 0, ',', '.'); ?>
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <a href="?eliminar=<?php echo $indice; ?>"
                                           style="background: #ef4444; color: white; padding: 0.5rem 0.75rem; border-radius: 0.5rem; text-decoration: none; transition: background 0.2s ease; display: inline-block;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr style="background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); font-weight: bold;">
                                <td colspan="3" style="padding: 1rem; text-align: right; font-size: 1.125rem;">TOTAL:</td>
                                <td style="padding: 1rem; text-align: center; font-size: 1.25rem; color: #16a34a;">
                                    $<?php echo number_format($total, 0, ',', '.'); ?>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 1rem;">
                    <a href="factura3.php"
                       style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s ease; font-weight: 600; transform: scale(1);" onmouseover="this.style.transform='scale(1.05)'; this.style.background='linear-gradient(135deg, #059669 0%, #047857 100%)'" onmouseout="this.style.transform='scale(1)'; this.style.background='linear-gradient(135deg, #10b981 0%, #059669 100%)'">
                        <i class="fas fa-credit-card" style="margin-right: 0.5rem;"></i>Enviar Factura
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </main>

        <!-- Footer Navigation -->
        <footer class="footer-nav">
            <a href="/" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-box-open"></i>
                <span>Pedidos</span>
            </a>
            <a href="#" class="nav-item active" onclick="showCart(); return false;">
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

    <!-- JavaScript for functionality -->
    <script>
        // Quantity controls
        let currentQuantity = 1;

        function changeQuantity(change) {
            const display = document.getElementById('quantity-display');
            currentQuantity += change;

            // Limit between 1 and 99
            if (currentQuantity < 1) currentQuantity = 1;
            if (currentQuantity > 99) currentQuantity = 99;

            display.textContent = currentQuantity;
        }

        // Add to cart from product detail
        function addToCartFromDetail(productId, name, price, imageUrl) {
            // Get selected quantity
            const quantity = currentQuantity;

            // Get selected preferences
            const selectedPreferencesFinal = {
                preferencia1: getSelectedPreferences(productId, 'uno'),
                preferencia2: getSelectedPreferences(productId, 'dos'),
                preferencia3: getSelectedPreferences(productId, 'tres')
            };

            // Create product object
            const product = {
                id: productId,
                nombre: name,
                valor: price,
                cantidad: quantity,
                subtotal: price * quantity,
                imagen: imageUrl,
                id_categoria: 1, // You might want to get this from the product data
                id_cliente: 1,
                id_empleado: 25,
                id_sucursal: 1,
                pedido_numero: 360,
                fecha: new Date().toISOString().slice(0, 19).replace('T', ' '),
                pedido_nota2: '',
                pedido_nota3: 'detalle',
                ...selectedPreferencesFinal
            };

            // Add to cart
            if (!window.cart) {
                window.cart = [];
            }

            // Check if product already in cart
            const existingProduct = window.cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.cantidad += quantity;
                existingProduct.subtotal = existingProduct.cantidad * existingProduct.valor;
            } else {
                window.cart.push(product);
            }

            // Save to localStorage
            localStorage.setItem('tienda_cart', JSON.stringify(window.cart));

            // Update cart counter
            updateCartCounter();

            // Show success message
            alert('Producto agregado al carrito exitosamente!');

            console.log('Producto agregado al carrito:', product);
            console.log('Carrito actual:', window.cart);
        }

        // Get selected preferences helper
        function getSelectedPreferences(productId, prefType) {
            const checkboxes = document.querySelectorAll(`input[name="preferencia_${prefType}_${productId}[]"]:checked`);
            const radio = document.querySelector(`input[name="preference_${prefType}_${productId}"]:checked`);

            if (checkboxes.length > 0) {
                return Array.from(checkboxes).map(cb => cb.value).join(', ');
            } else if (radio) {
                return radio.value;
            }

            return '';
        }

        // Update cart counter
        function updateCartCounter() {
            const cartCounters = document.querySelectorAll('.cart-counter, .cart-count, .cart-counter-nav');
            cartCounters.forEach(counter => {
                if (window.cart) {
                    const totalItems = window.cart.reduce((sum, item) => sum + item.cantidad, 0);
                    counter.textContent = totalItems;
                    counter.style.display = totalItems > 0 ? 'flex' : 'none';
                }
            });
        }

        // Show cart modal
        function showCart() {
            if (!window.cart || window.cart.length === 0) {
                showEmptyCartMessage();
                return;
            }

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

            modal.className = 'cart-modal-overlay';
            document.body.appendChild(modal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });

            document.addEventListener('keydown', function closeModal(e) {
                if (e.key === 'Escape') {
                    modal.remove();
                    document.removeEventListener('keydown', closeModal);
                }
            });
        }

        // Show empty cart message
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

        // Remove from cart
        function removeFromCart(index) {
            if (window.cart && window.cart[index]) {
                window.cart.splice(index, 1);
                localStorage.setItem('tienda_cart', JSON.stringify(window.cart));
                updateCartCounter();

                const modal = document.querySelector('.cart-modal-overlay');
                if (modal) {
                    modal.remove();
                    showCart();
                }

                console.log('Producto removido del carrito. Carrito actual:', window.cart);
            }
        }

        // Clear cart
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

        // Función para mostrar formulario de entrega
        function showDeliveryForm() {
            if (!window.cart || window.cart.length === 0) {
                alert('Tu carrito está vacío');
                return;
            }

            const total = window.cart.reduce((sum, item) => sum + item.subtotal, 0);

            // Crear modal del formulario de entrega
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
                    max-width: 500px;
                    width: 90%;
                    max-height: 90vh;
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
                    " onclick="this.closest('.delivery-modal-overlay').remove()">×</div>

                    <div style="padding: 20px;">
                        <h2 style="
                            font-size: 1.8rem;
                            color: var(--venice-gold-light);
                            margin-bottom: 20px;
                            text-align: center;
                            font-weight: 700;
                        ">📋 Datos de Entrega</h2>

                        <form id="delivery-form" style="display: grid; gap: 20px;">
                            <div>
                                <label style="color: var(--venice-gold-light); font-weight: 600; display: block; margin-bottom: 8px;">👤 Nombre Completo *</label>
                                <input type="text" id="customer-name" required style="
                                    width: 100%;
                                    padding: 12px;
                                    border: 2px solid rgba(0, 194, 203, 0.3);
                                    border-radius: var(--border-radius-sm);
                                    background: rgba(255, 255, 255, 0.1);
                                    color: var(--venice-light);
                                    font-size: 1rem;
                                    outline: none;
                                    transition: border-color 0.3s ease;
                                " placeholder="Ingresa tu nombre completo">
                            </div>

                            <div>
                                <label style="color: var(--venice-gold-light); font-weight: 600; display: block; margin-bottom: 8px;">📞 Teléfono de Contacto *</label>
                                <input type="tel" id="customer-phone" required style="
                                    width: 100%;
                                    padding: 12px;
                                    border: 2px solid rgba(0, 194, 203, 0.3);
                                    border-radius: var(--border-radius-sm);
                                    background: rgba(255, 255, 255, 0.1);
                                    color: var(--venice-light);
                                    font-size: 1rem;
                                    outline: none;
                                    transition: border-color 0.3s ease;
                                " placeholder="Ej: +57 300 123 4567">
                            </div>

                            <div>
                                <label style="color: var(--venice-gold-light); font-weight: 600; display: block; margin-bottom: 8px;">📍 Dirección de Entrega *</label>
                                <textarea id="customer-address" required rows="3" style="
                                    width: 100%;
                                    padding: 12px;
                                    border: 2px solid rgba(0, 194, 203, 0.3);
                                    border-radius: var(--border-radius-sm);
                                    background: rgba(255, 255, 255, 0.1);
                                    color: var(--venice-light);
                                    font-size: 1rem;
                                    outline: none;
                                    transition: border-color 0.3s ease;
                                    resize: vertical;
                                " placeholder="Ingresa tu dirección completa"></textarea>
                            </div>

                            <div>
                                <label style="color: var(--venice-gold-light); font-weight: 600; display: block; margin-bottom: 8px;">💳 Método de Pago</label>
                                <select id="payment-method" style="
                                    width: 100%;
                                    padding: 12px;
                                    border: 2px solid rgba(0, 194, 203, 0.3);
                                    border-radius: var(--border-radius-sm);
                                    background: rgba(255, 255, 255, 0.1);
                                    color: var(--venice-light);
                                    font-size: 1rem;
                                    outline: none;
                                    transition: border-color 0.3s ease;
                                ">
                                    <option value="efectivo" style="background: var(--venice-blue); color: var(--venice-light);">💵 Efectivo</option>
                                    <option value="transferencia" style="background: var(--venice-blue); color: var(--venice-light);">🏦 Transferencia Bancaria</option>
                                    <option value="tarjeta" style="background: var(--venice-blue); color: var(--venice-light);">💳 Tarjeta de Crédito/Débito</option>
                                </select>
                            </div>

                            <div>
                                <label style="color: var(--venice-gold-light); font-weight: 600; display: block; margin-bottom: 8px;">📝 Notas Adicionales</label>
                                <textarea id="order-notes" rows="2" style="
                                    width: 100%;
                                    padding: 12px;
                                    border: 2px solid rgba(0, 194, 203, 0.3);
                                    border-radius: var(--border-radius-sm);
                                    background: rgba(255, 255, 255, 0.1);
                                    color: var(--venice-light);
                                    font-size: 1rem;
                                    outline: none;
                                    transition: border-color 0.3s ease;
                                    resize: vertical;
                                " placeholder="Instrucciones especiales, referencias, etc."></textarea>
                            </div>

                            <!-- Resumen del pedido -->
                            <div style="
                                background: rgba(0, 194, 203, 0.1);
                                border: 1px solid rgba(0, 194, 203, 0.3);
                                border-radius: var(--border-radius-sm);
                                padding: 15px;
                            ">
                                <h3 style="color: var(--venice-accent); margin-bottom: 10px; font-size: 1.1rem;">🛒 Resumen del Pedido</h3>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span style="color: var(--venice-light);">Productos:</span>
                                    <span style="color: var(--venice-gold-light); font-weight: 600;">${window.cart.length} items</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: bold;">
                                    <span style="color: var(--venice-gold-light);">Total a Pagar:</span>
                                    <span style="color: var(--venice-accent); font-size: 1.4rem;">$${total.toLocaleString()}</span>
                                </div>
                            </div>
                        </form>

                        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 25px;">
                            <button onclick="this.closest('.delivery-modal-overlay').remove()" style="
                                background: rgba(255,255,255,0.1);
                                color: var(--venice-light);
                                border: 1px solid rgba(255,255,255,0.2);
                                padding: 12px 20px;
                                border-radius: var(--border-radius-sm);
                                cursor: pointer;
                                transition: all 0.3s ease;
                                font-size: 1rem;
                            " onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Regresar
                            </button>
                            <button onclick="sendToWhatsApp()" style="
                                background: linear-gradient(135deg, var(--venice-accent), var(--venice-light));
                                color: var(--venice-blue);
                                border: none;
                                padding: 12px 24px;
                                border-radius: var(--border-radius-sm);
                                font-weight: 700;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                font-size: 1rem;
                                flex: 1;
                            " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fab fa-whatsapp" style="margin-right: 8px;"></i>Enviar por WhatsApp
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
                .delivery-modal-overlay {
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
                }
            `;
            document.head.appendChild(style);

            // Agregar clase para facilitar el cierre
            modal.className = 'delivery-modal-overlay';

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

            // Enfocar primer campo
            setTimeout(() => {
                document.getElementById('customer-name').focus();
            }, 300);
        }

        // Función para finalizar compra - Envío por WhatsApp
        function checkout() {
            showDeliveryForm();
        }

        // Función para enviar a WhatsApp con datos del formulario
        function sendToWhatsApp() {
            const form = document.getElementById('delivery-form');

            // Validar formulario
            const name = document.getElementById('customer-name').value.trim();
            const phone = document.getElementById('customer-phone').value.trim();
            const address = document.getElementById('customer-address').value.trim();
            const paymentMethod = document.getElementById('payment-method').value;
            const notes = document.getElementById('order-notes').value.trim();

            if (!name || !phone || !address) {
                alert('Por favor completa todos los campos obligatorios (*)');
                return;
            }

            const total = window.cart.reduce((sum, item) => sum + item.subtotal, 0);

            // Crear mensaje para WhatsApp
            let mensaje = `🛒 *PEDIDO DE ALLALETERA*\n\n`;
            mensaje += `📅 Fecha: ${new Date().toLocaleDateString('es-ES')}\n`;
            mensaje += `⏰ Hora: ${new Date().toLocaleTimeString('es-ES')}\n\n`;

            mensaje += `👤 *DATOS DEL CLIENTE:*\n`;
            mensaje += `Nombre: ${name}\n`;
            mensaje += `Teléfono: ${phone}\n`;
            mensaje += `Dirección: ${address}\n`;
            mensaje += `Método de Pago: ${paymentMethod === 'efectivo' ? '💵 Efectivo' : paymentMethod === 'transferencia' ? '🏦 Transferencia' : '💳 Tarjeta'}\n`;
            if (notes) {
                mensaje += `Notas: ${notes}\n`;
            }
            mensaje += `\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n`;

            mensaje += `📋 *PRODUCTOS:*\n`;
            window.cart.forEach((item, index) => {
                mensaje += `\n${index + 1}. *${item.nombre}*\n`;
                mensaje += `   Cantidad: ${item.cantidad}\n`;
                mensaje += `   Precio unitario: $${item.valor.toLocaleString()}\n`;
                mensaje += `   Subtotal: $${item.subtotal.toLocaleString()}\n`;

                // Agregar preferencias si existen
                if (item.preferencia1 || item.preferencia2 || item.preferencia3) {
                    mensaje += `   🍽️ *Personalización:*\n`;
                    if (item.preferencia1) mensaje += `   • ${item.preferencia1}\n`;
                    if (item.preferencia2) mensaje += `   • ${item.preferencia2}\n`;
                    if (item.preferencia3) mensaje += `   • ${item.preferencia3}\n`;
                }

                if (item.pedido_nota2) {
                    mensaje += `   📝 Nota: ${item.pedido_nota2}\n`;
                }
            });

            mensaje += `\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n`;
            mensaje += `💰 *TOTAL A PAGAR: $${total.toLocaleString()}*\n`;
            mensaje += `━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n`;

            mensaje += `✅ *PEDIDO CONFIRMADO*\n`;
            mensaje += `¡Gracias por tu pedido! Nos pondremos en contacto pronto para confirmar la entrega.\n\n`;
            mensaje += `#Allaletera #PedidoEnLinea`;

            // Codificar el mensaje para URL
            const mensajeCodificado = encodeURIComponent(mensaje);

            // Número de WhatsApp (cambiar por el número real)
            const numeroWhatsApp = '573001234567'; // Cambiar por el número real

            // Crear URL de WhatsApp
            const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensajeCodificado}`;

            // Cerrar modal
            document.querySelector('.delivery-modal-overlay').remove();

            // Abrir WhatsApp en nueva ventana
            window.open(urlWhatsApp, '_blank');

            // Mostrar confirmación
            alert('¡Pedido enviado por WhatsApp!\n\nRevisa la nueva pestaña para confirmar tu pedido.');

            console.log('Pedido enviado por WhatsApp:', {
                cliente: { name, phone, address, paymentMethod, notes },
                mensaje: mensaje,
                total: total,
                productos: window.cart.length
            });
        }

        // Handle preference validation
        function handlePreferenceValidation() {
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('preference-option')) {
                    const prefType = e.target.getAttribute('data-pref');
                    const productId = e.target.name.match(/\d+/)[0];
                    const maxSelections = parseInt(e.target.closest('.preference-options').getAttribute('data-max-selections'));

                    if (maxSelections > 1) {
                        const checkedBoxes = document.querySelectorAll(`input[name="preferencia_${prefType}_${productId}[]"]:checked`);

                        if (checkedBoxes.length > maxSelections) {
                            e.target.checked = false;
                            alert(`Solo puedes seleccionar hasta ${maxSelections} opción(es) para esta preferencia`);
                        }
                    }
                }
            });
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            handlePreferenceValidation();

            // Load cart from localStorage
            const savedCart = localStorage.getItem('tienda_cart');
            if (savedCart) {
                window.cart = JSON.parse(savedCart);
                updateCartCounter();
            }
        });
    </script>
</body>
</html>
  






</x-layout>
