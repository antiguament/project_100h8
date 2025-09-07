<nav class="bottom-nav">
    <a href="{{ route('welcome') }}" class="nav-item {{ request()->routeIs('welcome') ? 'active' : '' }}" data-tooltip="Inicio">
        <div class="nav-icon">
            <i class="fas fa-home"></i>
            @if(request()->routeIs('welcome'))
                <span class="nav-pulse"></span>
            @endif
        </div>
        <span class="nav-text">Inicio</span>
    </a>
    
    <a href="#" class="nav-item" data-tooltip="Explorar">
        <div class="nav-icon">
            <i class="fas fa-compass"></i>
        </div>
        <span class="nav-text">Explorar</span>
    </a>
    
    <a href="{{ route('cart.index') }}" class="nav-item nav-cart" data-tooltip="Carrito">
        <div class="nav-icon">
            <i class="fas fa-shopping-cart"></i>
            @if(isset($cartCount) && $cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
            @endif
        </div>
        <span class="nav-text">Carrito</span>
    </a>
    
    <a href="#" class="nav-item" data-tooltip="Favoritos">
        <div class="nav-icon">
            <i class="fas fa-heart"></i>
        </div>
        <span class="nav-text">Favoritos</span>
    </a>
    
    <a href="#" class="nav-item" data-tooltip="Perfil">
        <div class="nav-icon">
            <i class="fas fa-user"></i>
        </div>
        <span class="nav-text">Perfil</span>
    </a>
</nav>

@push('styles')
<style>
    /* Bottom Navigation */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: white;
        padding: 8px 0 12px;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
        z-index: 1000;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        max-width: 480px;
        margin: 0 auto;
        border-radius: 24px 24px 0 0;
    }
    
    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #6b7280;
        position: relative;
        padding: 8px 12px;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex: 1;
        max-width: 20%;
    }
    
    .nav-item::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #00c6fb 0%, #00b0d9 100%);
        border-radius: 0 0 4px 4px;
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .nav-item:hover {
        color: #00b0d9;
        transform: translateY(-4px);
    }
    
    .nav-item:hover .nav-icon {
        background: rgba(0, 198, 251, 0.1);
        transform: scale(1.1);
    }
    
    .nav-item.active {
        color: #00b0d9;
        transform: translateY(-4px);
    }
    
    .nav-item.active .nav-icon {
        color: #00b0d9;
        transform: scale(1.1);
    }
    
    .nav-item.active::before {
        transform: translateX(-50%) scaleX(1);
        opacity: 1;
    }
    
    .nav-icon {
        position: relative;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 4px;
        transition: all 0.3s ease;
    }
    
    .nav-pulse {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        background: #00c6fb;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(0, 198, 251, 0.7);
        }
        70% {
            transform: scale(1.1);
            box-shadow: 0 0 0 6px rgba(0, 198, 251, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(0, 198, 251, 0);
        }
    }
    
    .nav-text {
        font-size: 0.7rem;
        font-weight: 500;
        margin-top: 2px;
    }
    
    .nav-cart .nav-icon {
        position: relative;
    }
    
    .cart-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #EF4444;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
    }
    
    .nav-cart {
        position: relative;
    }
    
    .nav-cart .nav-icon {
        position: relative;
    }
    
    /* Tooltip */
    [data-tooltip] {
        position: relative;
        cursor: pointer;
    }
    
    [data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(-8px);
        background: #1e293b;
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.7rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
        z-index: 1001;
    }
    
    [data-tooltip]:hover::before {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(-2px);
        border-width: 5px;
        border-style: solid;
        border-color: #1e293b transparent transparent transparent;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }
    
    [data-tooltip]:hover::after,
    [data-tooltip]:hover::before {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(-12px);
    }
    
    /* Animation */
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    .nav-item:hover .nav-icon {
        animation: bounce 0.6s ease;
    }
    
    /* Responsive */
    @media (max-width: 400px) {
        .nav-icon {
            width: 38px;
            height: 38px;
            font-size: 1.1rem;
        }
        
        .nav-text {
            font-size: 0.65rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add active class on click
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Add ripple effect
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple-effect');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Actualizar el contador del carrito dinámicamente
        function updateCartCount() {
            fetch('{{ route("cart.count") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                const cartBadge = document.querySelector('.cart-badge');
                const navCart = document.querySelector('.nav-cart .nav-icon');
                
                if (data.count > 0) {
                    if (!cartBadge) {
                        const badge = document.createElement('span');
                        badge.className = 'cart-badge';
                        badge.textContent = data.count;
                        navCart.appendChild(badge);
                    } else {
                        cartBadge.textContent = data.count;
                    }
                } else if (cartBadge) {
                    cartBadge.remove();
                }
            });
        }
        
        // Actualizar el contador cada 30 segundos
        setInterval(updateCartCount, 30000);
        
        // También actualizar cuando se agrega un producto (evento personalizado)
        document.addEventListener('cartUpdated', updateCartCount);
        
        // Actualizar al cargar la página
        updateCartCount();
    });
</script>

<style>
    .ripple-effect {
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(0, 198, 251, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple {
        to {
            transform: translate(-50%, -50%) scale(2);
            opacity: 0;
        }
    }
</style>
@endpush
