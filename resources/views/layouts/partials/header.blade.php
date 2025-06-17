@php
    use App\Facades\Cart;
@endphp

<header class="shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categorias') ? 'active' : '' }}" 
                           href="{{ route('categorias') }}">
                            Categorías
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" 
                           href="{{ route('cart.index') }}">
                            Mi Carrito
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <!-- Carrito de compras -->
                    <div class="dropdown me-3">
                        <a href="{{ route('cart.index') }}" 
                           class="btn btn-outline-primary position-relative" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false"
                           style="border-radius: 2rem; padding: 0.4rem 1rem;">
                            <i class="fas fa-shopping-cart me-1"></i>
                            <span>Carrito</span>
                            @php $cartCount = Cart::count(); @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                                    {{ $cartCount }}
                                </span>
                            @else
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count d-none">
                                    0
                                </span>
                            @endif
                        </a>
                        <!-- Mini carrito desplegable -->
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                            <div id="mini-cart-content">
                                @include('cart.mini-cart-content')
                            </div>
                            <div class="d-grid gap-2 mt-2">
                                <a href="{{ route('cart.index') }}" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Ver carrito completo
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Autenticación -->
                    @if (Route::has('login'))
                        <div class="d-flex">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary me-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                                    Iniciar Sesión
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <script>
        // Mostrar/ocultar el mini carrito al hacer hover
        document.addEventListener('DOMContentLoaded', function() {
            const cartDropdown = document.querySelector('.dropdown');
            
            if (cartDropdown) {
                const cartButton = cartDropdown.querySelector('[data-bs-toggle="dropdown"]');
                
                // Mostrar al hacer hover
                cartDropdown.addEventListener('mouseenter', function() {
                    const dropdown = new bootstrap.Dropdown(cartButton);
                    dropdown.show();
                });
                
                // Ocultar al salir
                cartDropdown.addEventListener('mouseleave', function() {
                    const dropdown = bootstrap.Dropdown.getInstance(cartButton);
                    if (dropdown) {
                        dropdown.hide();
                    }
                });
                
                // Cargar el mini carrito al abrir el menú
                cartButton.addEventListener('show.bs.dropdown', function() {
                    fetch('{{ route("cart.mini") }}')
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('mini-cart-content').innerHTML = html;
                        });
                });
            }
            
            // Actualizar el contador del carrito cuando se agrega un producto
            window.addEventListener('cart-updated', function() {
                // Actualizar el contador del carrito
                fetch('{{ route("cart.count") }}')
                    .then(response => response.json())
                    .then(data => {
                        const cartCounts = document.querySelectorAll('.cart-count');
                        
                        cartCounts.forEach(countEl => {
                            if (data.count > 0) {
                                countEl.textContent = data.count;
                                countEl.classList.remove('d-none');
                            } else {
                                countEl.textContent = '0';
                                countEl.classList.add('d-none');
                            }
                        });
                        
                        // Actualizar el mini carrito
                        fetch('{{ route("cart.mini") }}')
                            .then(response => response.text())
                            .then(html => {
                                document.getElementById('mini-cart-content').innerHTML = html;
                            });
                    });
            });
            
            // Cargar el mini carrito al abrir el menú
            cartDropdown.addEventListener('show.bs.dropdown', function() {
                fetch('{{ route("cart.mini") }}')
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('mini-cart-content').innerHTML = html;
                    });
            });
        });
    </script>
</header>
