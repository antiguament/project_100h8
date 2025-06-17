<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- Estilos en línea -->
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7ff;
            color: #333;
            line-height: 1.6;
        }
        
        .min-h-screen {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
            padding: 2rem 0;
        }
        
        /* Animaciones básicas */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    <!-- Estilos específicos de la página -->
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Contenido principal -->
    <div class="min-h-screen">
        @includeWhen(View::hasSection('header'), 'layouts.partials.header')
        
        <div class="content-wrapper">
            @yield('content')
        </div>
        
        @includeWhen(View::hasSection('footer'), 'layouts.partials.footer')
    </div>

    <!-- Estilos para el botón flotante del carrito -->
    <style>
        .floating-cart-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .floating-cart-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 12px;
            min-width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #dc3545;
            color: white;
        }
        
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1050;
            transition: right 0.3s ease;
            padding: 20px;
            overflow-y: auto;
        }
        
        .cart-sidebar.show {
            right: 0;
        }
        
        .cart-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }
        
        .cart-overlay.show {
            display: block;
        }
        
        .cart-item-quantity {
            display: flex;
            align-items: center;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            user-select: none;
        }
        
        .quantity-input {
            width: 40px;
            height: 30px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-left: none;
            border-right: none;
        }
    </style>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script src="{{ asset('js/custom.js') }}"></script>
    
    <!-- Scripts específicos de la página -->
    @stack('scripts')
    
    <!-- Botón flotante del carrito -->
    <button id="floatingCartBtn" class="btn btn-primary btn-lg rounded-circle p-3 floating-cart-btn">
        <i class="fas fa-shopping-cart"></i>
        <span id="cartBadge" class="cart-badge">0</span>
    </button>
    
    <!-- Sidebar del carrito -->
    <div id="cartOverlay" class="cart-overlay"></div>
    <div id="cartSidebar" class="cart-sidebar">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Mi Carrito</h4>
            <button id="closeCartSidebar" class="btn btn-link text-dark p-0">
                <i class="fas fa-times fa-lg"></i>
            </button>
        </div>
        
        <div id="cartItemsContainer">
            <!-- Los productos del carrito se cargarán aquí dinámicamente -->
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tu carrito está vacío</p>
            </div>
        </div>
        
        <div id="cartSummary" class="mt-4 pt-3 border-top d-none">
            <div class="d-flex justify-content-between mb-3">
                <h5>Total:</h5>
                <h5 id="cartTotal">$0.00</h5>
            </div>
            <a href="{{ route('cart.index') }}" class="btn btn-primary w-100 mb-2">
                Ver carrito completo
            </a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-outline-primary w-100">
                Finalizar compra
            </a>
        </div>
    </div>
    
    <!-- Scripts en línea -->
    <script>
        // Inicialización de componentes
        document.addEventListener('DOMContentLoaded', function() {
            // Tooltips de Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Popovers de Bootstrap
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
            
            // Funcionalidad del carrito flotante
            const $floatingCartBtn = $('#floatingCartBtn');
            const $cartOverlay = $('#cartOverlay');
            const $cartSidebar = $('#cartSidebar');
            const $closeCartSidebar = $('#closeCartSidebar');
            const $cartItemsContainer = $('#cartItemsContainer');
            const $cartSummary = $('#cartSummary');
            const $cartBadge = $('#cartBadge');
            const $cartTotal = $('#cartTotal');
            
            // Abrir el carrito
            function openCart() {
                $cartOverlay.addClass('show');
                $cartSidebar.addClass('show');
                $('body').css('overflow', 'hidden');
                loadCart();
            }
            
            // Cerrar el carrito
            function closeCart() {
                $cartOverlay.removeClass('show');
                $cartSidebar.removeClass('show');
                $('body').css('overflow', '');
            }
            
            // Cargar el carrito
            function loadCart() {
                $.get('{{ route("cart.mini") }}')
                    .done(function(response) {
                        $cartItemsContainer.html(response);
                        updateCartBadge();
                        updateCartTotal();
                        
                        // Mostrar/ocultar resumen según si hay productos
                        const hasItems = $('.cart-item').length > 0;
                        $cartSummary.toggleClass('d-none', !hasItems);
                    })
                    .fail(function() {
                        $cartItemsContainer.html('<div class="alert alert-danger">Error al cargar el carrito</div>');
                    });
            }
            
            // Actualizar el contador del carrito
            function updateCartBadge() {
                const count = $('.cart-item').length;
                $cartBadge.text(count);
                $cartBadge.toggle(count > 0);
            }
            
            // Actualizar el total del carrito
            function updateCartTotal() {
                let total = 0;
                $('.cart-item').each(function() {
                    const price = parseFloat($(this).data('price'));
                    const quantity = parseInt($(this).find('.quantity-input').val());
                    total += price * quantity;
                });
                $cartTotal.text('$' + total.toFixed(2));
            }
            
            // Eventos
            $floatingCartBtn.on('click', openCart);
            $cartOverlay.on('click', closeCart);
            $closeCartSidebar.on('click', closeCart);
            
            // Delegación de eventos para los botones de cantidad
            $(document).on('click', '.quantity-btn', function() {
                const $input = $(this).siblings('.quantity-input');
                let value = parseInt($input.val());
                const max = parseInt($input.attr('max')) || 99;
                
                if ($(this).hasClass('minus') && value > 1) {
                    $input.val(value - 1).trigger('change');
                } else if ($(this).hasClass('plus') && value < max) {
                    $input.val(value + 1).trigger('change');
                }
                
                updateCartItem($input.closest('.cart-item'));
            });
            
            // Actualizar cantidad manualmente
            $(document).on('change', '.quantity-input', function() {
                updateCartItem($(this).closest('.cart-item'));
            });
            
            // Eliminar producto
            $(document).on('click', '.remove-item', function(e) {
                e.preventDefault();
                const $item = $(this).closest('.cart-item');
                const productId = $item.data('id');
                
                $.post('{{ route("cart.remove") }}', {
                    _token: '{{ csrf_token() }}',
                    id: productId
                })
                .done(function() {
                    $item.fadeOut(300, function() {
                        $(this).remove();
                        updateCartBadge();
                        updateCartTotal();
                        
                        // Ocultar resumen si no hay productos
                        if ($('.cart-item').length === 0) {
                            $cartSummary.addClass('d-none');
                            $cartItemsContainer.html(`
                                <div class="text-center py-5">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tu carrito está vacío</p>
                                </div>
                            `);
                        }
                    });
                })
                .fail(function() {
                    alert('Error al eliminar el producto');
                });
            });
            
            // Función para actualizar un producto en el carrito
            function updateCartItem($item) {
                const productId = $item.data('id');
                const quantity = $item.find('.quantity-input').val();
                
                $.post('{{ route("cart.update") }}', {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    quantity: quantity
                })
                .done(function() {
                    updateCartTotal();
                })
                .fail(function() {
                    alert('Error al actualizar la cantidad');
                });
            }
            
            // Cerrar con la tecla ESC
            $(document).keyup(function(e) {
                if (e.key === 'Escape') {
                    closeCart();
                }
            });
            
            // Actualizar el contador al cargar la página
            updateCartBadge();
        });
    </script>
    
    <!-- Ejecutar scripts específicos de la página si existen
            if (typeof pageInit === 'function') {
                pageInit();
            }
        });
        
        // Función para mostrar mensajes flash
        function showFlashMessage(type, message) {
            // Implementar lógica para mostrar mensajes flash
            console.log(`${type}: ${message}`);
        }
    </script>
    
    <!-- Scripts de seguimiento (opcional) -->
    @if(env('APP_ENV') === 'production')
        <!-- Google Analytics u otros scripts de seguimiento -->
    @endif
</body>
</html>
