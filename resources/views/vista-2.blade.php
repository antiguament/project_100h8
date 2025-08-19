@extends('layouts.app-custom')

@section('title', $product->name . ' - Detalles del Producto')

@push('styles')
<style>
    :root {
        --primary: #00c6fb;
        --primary-dark: #0099cc;
        --secondary: #20e3b2;
        --accent: #ffd700;
        --success: #2ecc71;
        --danger: #e74c3c;
        --light-gray: #f8f9fa;
        --dark: #2c3e50;
        --gray: #6c757d;
        --border-radius: 12px;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        color: var(--primary);
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 500;
        transition: var(--transition);
    }
    
    .back-button:hover {
        color: var(--primary-dark);
        transform: translateX(-4px);
    }
    
    .back-button i {
        margin-right: 8px;
    }
    
    .product-detail-container {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .product-gallery {
        position: relative;
        height: 300px;
        overflow: hidden;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--accent);
        color: var(--dark);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }
    
    .product-info {
        padding: 1.5rem;
    }
    
    .product-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }
    
    .product-category {
        display: inline-block;
        background: rgba(32, 227, 178, 0.1);
        color: var(--secondary);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
    
    .product-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary);
        margin: 1rem 0;
    }
    
    .product-description {
        color: var(--gray);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .quantity-btn:hover {
        background: var(--light-gray);
    }
    
    .quantity-input {
        width: 60px;
        height: 40px;
        text-align: center;
        border: 1px solid #ddd;
        border-left: none;
        border-right: none;
        font-size: 1rem;
        font-weight: 600;
    }
    
    .btn-add-to-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-bottom: 1rem;
    }
    
    .btn-add-to-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    
    .btn-add-to-cart i {
        margin-right: 8px;
    }
    
    .product-meta {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
    }
    
    .meta-icon {
        width: 36px;
        height: 36px;
        background: var(--light-gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        color: var(--primary);
    }
    
    .meta-text {
        font-size: 0.85rem;
    }
    
    .meta-label {
        display: block;
        color: var(--gray);
        font-size: 0.75rem;
    }
    
    .meta-value {
        font-weight: 600;
        color: var(--dark);
    }
    
    @media (max-width: 768px) {
        .product-meta {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 576px) {
        .product-title {
            font-size: 1.5rem;
        }
        
        .product-price {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <a href="{{ url()->previous() }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    
    <div class="row">
        <!-- Product Detail -->
        <div class="col-lg-8">
            <div class="product-detail-container">
                <div class="product-gallery">
                    @if($product->is_new)
                        <span class="product-badge">Nuevo</span>
                    @endif
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                </div>
                
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    @if($product->category)
                        <span class="product-category">{{ $product->category->name }}</span>
                    @endif
                    
                    <div class="product-price">
                        ${{ number_format($product->price, 2) }}
                        @if($product->compare_price)
                            <small class="text-muted text-decoration-line-through ms-2">${{ number_format($product->compare_price, 2) }}</small>
                        @endif
                    </div>
                    
                    @if($product->description)
                        <div class="product-description">
                            {{ $product->description }}
                        </div>
                    @endif
                    
                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn minus" onclick="decrementQuantity()">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="quantity-input" onchange="validateQuantity({{ $product->stock }})">
                            <button type="button" class="quantity-btn plus" onclick="incrementQuantity({{ $product->stock }})">+</button>
                        </div>
                        
                        <button type="submit" class="btn-add-to-cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart"></i>
                            {{ $product->stock > 0 ? 'Agregar al carrito' : 'Producto agotado' }}
                        </button>
                    </form>
                    
                    <div class="product-meta">
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Disponibilidad</span>
                                <span class="meta-value">
                                    @if($product->stock > 5)
                                        En stock ({{ $product->stock }} disponibles)
                                    @elseif($product->stock > 0)
                                        Últimas {{ $product->stock }} unidades
                                    @else
                                        Agotado
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Envío</span>
                                <span class="meta-value">Envío gratuito</span>
                            </div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-undo"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Devoluciones</span>
                                <span class="meta-value">30 días</span>
                            </div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Pago seguro</span>
                                <span class="meta-value">100% protegido</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Shopping Cart Sidebar -->
        <div class="col-lg-4">
            <div class="cart-sidebar">
                <div class="cart-header">
                    <h2 class="cart-title">
                        <i class="fas fa-shopping-cart"></i>
                        Mi Carrito
                        <span class="cart-count">0</span>
                    </h2>
                </div>
                
                <div class="cart-items" id="cart-items">
                    <!-- Cart items will be dynamically added here -->
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Tu carrito está vacío</p>
                    </div>
                </div>
                
                <div class="cart-summary">
                    <div class="cart-totals">
                        <div class="cart-total-row">
                            <span class="cart-total-label">Subtotal</span>
                            <span class="cart-total-amount" id="cart-subtotal">$0.00</span>
                        </div>
                        <div class="cart-total-row">
                            <span class="cart-total-label">Envío</span>
                            <span class="cart-total-amount" id="cart-shipping">$0.00</span>
                        </div>
                        <div class="cart-total-row">
                            <span class="cart-total-label">Descuento</span>
                            <span class="cart-total-amount text-danger" id="cart-discount">-$0.00</span>
                        </div>
                        <div class="cart-total-row mt-3 pt-3 border-top">
                            <span class="cart-total-label">Total</span>
                            <span class="cart-total-amount grand-total" id="cart-total">$0.00</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout') }}" class="btn-checkout" id="checkout-btn" style="display: none;">
                        Proceder al pago
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Quantity Selector Functions
    function incrementQuantity(max) {
        const quantityInput = document.getElementById('quantity');
        let value = parseInt(quantityInput.value) || 1;
        if (value < max) {
            quantityInput.value = value + 1;
        } else {
            quantityInput.value = max;
        }
    }
    
    function decrementQuantity() {
        const quantityInput = document.getElementById('quantity');
        let value = parseInt(quantityInput.value) || 1;
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    }
    
    function validateQuantity(max) {
        const quantityInput = document.getElementById('quantity');
        let value = parseInt(quantityInput.value) || 1;
        
        if (value < 1) {
            quantityInput.value = 1;
        } else if (value > max) {
            quantityInput.value = max;
        }
    }
    
    // Cart Functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        updateCartUI();
        
        // Add to Cart Form Submission
        const addToCartForm = document.getElementById('add-to-cart-form');
        if (addToCartForm) {
            addToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const productId = formData.get('product_id');
                const quantity = parseInt(formData.get('quantity')) || 1;
                
                // Add to cart
                addToCart(productId, quantity);
            });
        }
        
        // Add to Cart Function
        function addToCart(productId, quantity) {
            // Check if product already in cart
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                // Get product details (in a real app, you'd fetch this from your database)
                const product = {
                    id: '{{ $product->id }}',
                    name: '{{ $product->name }}',
                    price: {{ $product->price }},
                    image: '{{ $product->image_url }}',
                    quantity: quantity
                };
                
                cart.push(product);
            }
            
            // Save to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Update UI
            updateCartUI();
            
            // Show success message
            showToast('Producto agregado al carrito');
        }
        
        // Update Cart UI
        function updateCartUI() {
            const cartItems = document.getElementById('cart-items');
            const cartCount = document.querySelector('.cart-count');
            const cartSubtotal = document.getElementById('cart-subtotal');
            const cartTotal = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');
            
            // Clear current items
            cartItems.innerHTML = '';
            
            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Tu carrito está vacío</p>
                    </div>
                `;
                cartCount.textContent = '0';
                cartSubtotal.textContent = '$0.00';
                cartTotal.textContent = '$0.00';
                checkoutBtn.style.display = 'none';
                return;
            }
            
            // Calculate totals
            let subtotal = 0;
            
            // Add each item to the cart
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                
                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item';
                itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                    <div class="cart-item-details">
                        <h4 class="cart-item-name">${item.name}</h4>
                        <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                        <div class="cart-item-actions">
                            <div class="cart-item-quantity">
                                <button class="cart-item-quantity-btn minus" onclick="updateQuantity(${index}, -1)">-</button>
                                <input type="number" class="cart-item-quantity-input" value="${item.quantity}" min="1" 
                                       onchange="updateQuantityInput(${index}, this.value)">
                                <button class="cart-item-quantity-btn plus" onclick="updateQuantity(${index}, 1)">+</button>
                            </div>
                            <button class="cart-item-remove" onclick="removeFromCart(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                cartItems.appendChild(itemElement);
            });
            
            // Update totals
            const shipping = subtotal > 0 ? 5.00 : 0; // Example shipping cost
            const discount = 0; // Example discount
            const total = subtotal + shipping - discount;
            
            cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartSubtotal.textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('cart-shipping').textContent = `$${shipping.toFixed(2)}`;
            document.getElementById('cart-discount').textContent = `-$${discount.toFixed(2)}`;
            cartTotal.textContent = `$${total.toFixed(2)}`;
            
            // Show checkout button
            checkoutBtn.style.display = 'block';
        }
        
        // Show toast notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.add('show');
                
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }, 100);
        }
    });
    
    // Global functions for cart operations
    function updateQuantity(index, change) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart[index].quantity += change;
        
        // Remove if quantity is 0 or less
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartUI();
    }
    
    function updateQuantityInput(index, value) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const quantity = parseInt(value) || 1;
        
        if (quantity > 0) {
            cart[index].quantity = quantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartUI();
        }
    }
    
    function removeFromCart(index) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartUI();
    }
    
    function updateCartUI() {
        const event = new CustomEvent('cartUpdated');
        document.dispatchEvent(event);
    }
</script>

<style>
    /* Toast Notification */
    .toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: #333;
        color: white;
        padding: 12px 24px;
        border-radius: 4px;
        font-size: 0.9rem;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 1100;
    }
    
    .toast.show {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
    }
    
    /* Cart Sidebar Styles */
    .cart-sidebar {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    
    .cart-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
    }
    
    .cart-title i {
        margin-right: 8px;
        color: var(--primary);
    }
    
    .cart-count {
        background: var(--primary);
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 8px;
    }
    
    .cart-items {
        margin-bottom: 1.5rem;
        max-height: 300px;
        overflow-y: auto;
    }
    
    .cart-item {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f5f5f5;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .cart-item-img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 1rem;
    }
    
    .cart-item-details {
        flex: 1;
    }
    
    .cart-item-name {
        font-weight: 600;
        margin: 0 0 4px;
        font-size: 0.9rem;
    }
    
    .cart-item-price {
        color: var(--primary);
        font-weight: 700;
        font-size: 0.9rem;
    }
    
    .cart-item-actions {
        display: flex;
        align-items: center;
        margin-top: 4px;
    }
    
    .cart-item-quantity {
        display: flex;
        align-items: center;
        margin-right: 1rem;
    }
    
    .cart-item-quantity-btn {
        width: 24px;
        height: 24px;
        border: 1px solid #ddd;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.75rem;
    }
    
    .cart-item-quantity-input {
        width: 30px;
        height: 24px;
        text-align: center;
        border: 1px solid #ddd;
        border-left: none;
        border-right: none;
        font-size: 0.8rem;
    }
    
    .cart-item-remove {
        color: var(--danger);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
    }
    
    .cart-item-remove i {
        margin-right: 4px;
    }
    
    .cart-summary {
        border-top: 1px solid #eee;
        padding-top: 1.5rem;
    }
    
    .cart-totals {
        margin-bottom: 1.5rem;
    }
    
    .cart-total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }
    
    .cart-total-label {
        color: var(--gray);
    }
    
    .cart-total-amount {
        font-weight: 700;
        color: var(--dark);
    }
    
    .grand-total {
        font-size: 1.25rem;
        color: var(--primary);
    }
    
    .btn-checkout {
        display: block;
        width: 100%;
        padding: 1rem;
        background: var(--success);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        text-decoration: none;
    }
    
    .btn-checkout:hover {
        background: #27ae60;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
    }
    
    .empty-cart {
        text-align: center;
        padding: 2rem 0;
        color: var(--gray);
    }
    
    .empty-cart i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #ddd;
    }
</style>
@endpush
@endsection
