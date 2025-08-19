<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ url()->previous() }}" class="mr-4">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Product Card -->
            <div class="product-card bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Single Product Image -->
                <div class="relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                    @if($product->is_new)
                        <span class="absolute top-4 right-4 bg-accent text-dark px-3 py-1 rounded-full text-sm font-bold">
                            ¡Nuevo!
                        </span>
                    @endif
                </div>
                
                <div class="p-6">
                    <!-- Category -->
                    @if($product->category)
                        <span class="inline-block bg-primary/10 text-primary text-sm font-medium px-3 py-1 rounded-full mb-3">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    
                    <!-- Product Name -->
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    
                    <!-- Price -->
                    <div class="price-display">
                        <span class="text-2xl font-bold text-primary">${{ number_format($product->price, 2) }}</span>
                        @if($product->stock > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> En stock ({{ $product->stock }})
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i> Agotado
                            </span>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    <p class="text-gray-600 my-4">{{ $product->description ?? 'Este producto no tiene una descripción detallada.' }}</p>
                    
                    <!-- Desktop Add to Cart -->
                    <div class="desktop-only">
                        <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-700 font-medium">Cantidad:</span>
                                <div class="flex items-center">
                                    <button type="button" class="quantity-btn" onclick="decrementQuantity()">-</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                           max="{{ $product->stock }}" class="quantity-input" 
                                           onchange="validateQuantity({{ $product->stock }})">
                                    <button type="button" class="quantity-btn" onclick="incrementQuantity({{ $product->stock }})">+</button>
                                </div>
                            </div>
                            
                            <button type="submit" id="add-to-cart-btn" class="add-to-cart-btn" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart"></i>
                                <span id="add-to-cart-text">
                                    {{ $product->stock > 0 ? 'Agregar al carrito' : 'Producto agotado' }}
                                </span>
                                <span id="add-to-cart-spinner" class="hidden ml-2">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </span>
                            </button>
                            <div id="cart-message" class="mt-2 text-center text-sm"></div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="product-details mt-6 bg-light-gray rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Detalles del producto</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="detail-item">
                        <span class="detail-label">Categoría</span>
                        <span class="detail-value">{{ $product->category->name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Disponibilidad</span>
                        <span class="detail-value">{{ $product->stock > 0 ? 'En stock' : 'Agotado' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Precio</span>
                        <span class="detail-value text-primary">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <div class="mt-10 mb-6">
                <h3 class="section-title">Productos relacionados</h3>
                <div class="related-grid">
                    @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct) }}" class="related-product">
                        <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" class="related-product-image">
                        <div class="related-product-info">
                            <h4 class="related-product-name">{{ $relatedProduct->name }}</h4>
                            <p class="related-product-price">${{ number_format($relatedProduct->price, 2) }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Mobile Fixed Action Button -->
    <div class="fixed-action-btn">
        <form id="mobile-add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
            @csrf
            <input type="hidden" name="quantity" value="1" id="mobile-quantity">
            <button type="submit" id="mobile-add-to-cart-btn" class="add-to-cart-btn" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                <i class="fas fa-shopping-cart"></i>
                <span id="mobile-add-to-cart-text">
                    {{ $product->stock > 0 ? 'Agregar al carrito - $' . number_format($product->price, 2) : 'Producto agotado' }}
                </span>
                <span id="mobile-add-to-cart-spinner" class="hidden ml-2">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
        </form>
    </div>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav />
    
    @push('styles')
    <style>
        :root {
            --primary: #00B4D8;
            --primary-dark: #0096C7;
            --secondary: #48CAE4;
            --accent: #FFD166;
            --success: #06D6A0;
            --danger: #EF476F;
            --dark: #1E293B;
            --light: #F8FAFC;
            --gray: #64748B;
            --light-gray: #F1F5F9;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--light);
            padding-bottom: 100px; /* Space for fixed button on mobile */
        }

        .product-hero {
            height: 60vh;
            min-height: 400px;
            position: relative;
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
            top: 20px;
            left: 20px;
            background: var(--accent);
            color: var(--dark);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 2;
            box-shadow: var(--shadow);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .back-btn:hover {
            transform: translateY(-2px);
        }

        .product-content {
            position: relative;
            margin-top: -80px;
            background: white;
            border-radius: 30px 30px 0 0;
            padding: 2rem;
            box-shadow: 0 -5px 30px rgba(0, 0, 0, 0.05);
        }

        .product-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin: 1rem 0;
        }

        .product-category {
            display: inline-block;
            background: rgba(0, 180, 216, 0.1);
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-description {
            color: var(--gray);
            line-height: 1.7;
            margin: 1.5rem 0;
            font-size: 1.05rem;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            background: var(--light-gray);
            border-radius: 50px;
            padding: 8px;
            width: fit-content;
        }

        .quantity-btn {
            width: 44px;
            height: 44px;
            border: none;
            background: white;
            color: var(--primary);
            font-size: 1.4rem;
            font-weight: bold;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
            border: none;
            background: transparent;
            -moz-appearance: textfield;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .add-to-cart-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 1.1rem 2rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 180, 216, 0.3);
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .add-to-cart-btn:not(:disabled):hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 180, 216, 0.4);
        }

        .add-to-cart-btn:disabled {
            background: #D1D5DB;
            cursor: not-allowed;
            box-shadow: none;
        }

        .add-to-cart-btn:after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 1%, transparent 1%) center/15000%;
            opacity: 0;
            transition: transform 0.6s, opacity 1s;
        }

        .add-to-cart-btn:not(:disabled):active:after {
            opacity: 1;
            transform: scale(10);
            transition: 0s;
        }

        .fixed-action-btn {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            right: 1rem;
            z-index: 50;
            display: none;
            padding: 0 1rem;
            background: transparent;
            pointer-events: none;
        }

        .fixed-action-btn > * {
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            .fixed-action-btn {
                display: block;
            }
            
            .desktop-only {
                display: none;
            }
            
            body {
                padding-bottom: 120px;
            }
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            gap: 0.5rem;
        }

        .quantity-btn {
            width: 2.5rem;
            height: 2.5rem;
            border: 1px solid #E5E7EB;
            background: white;
            color: var(--primary);
            font-size: 1.25rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease-in-out;
        }

        .quantity-btn:hover {
            background: #F3F4F6;
            transform: translateY(-1px);
        }

        .quantity-input {
            width: 3.5rem;
            height: 2.5rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 600;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            -moz-appearance: textfield;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .price-display {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary);
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-details {
            background: var(--light-gray);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin: 1.5rem 0 6rem; /* Added bottom margin to prevent overlap */
        }

        /* Ensure content has enough padding at the bottom */
        .py-6 {
            padding-bottom: 6rem;
        }

        /* Adjust related products section */
        .related-products {
            margin: 3rem 0 6rem; /* Added bottom margin */
        }

        /* Make sure content is above the fixed button */
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Handle add to cart form submission
        document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('add-to-cart-btn');
            const spinner = document.getElementById('add-to-cart-spinner');
            const messageDiv = document.getElementById('cart-message');
            
            // Show loading state
            submitBtn.disabled = true;
            spinner.classList.remove('hidden');
            messageDiv.textContent = '';
            
            // Submit form via AJAX
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    quantity: document.getElementById('quantity').value,
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.textContent = '¡Producto agregado al carrito!';
                    messageDiv.className = 'mt-2 text-center text-sm text-green-600';
                    
                    // Update cart count in navigation if exists
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        // Increment cart count
                        const currentCount = parseInt(cartCount.textContent) || 0;
                        cartCount.textContent = currentCount + parseInt(document.getElementById('quantity').value);
                        cartCount.classList.remove('hidden');
                    }
                    
                    // Reset form after success
                    setTimeout(() => {
                        form.reset();
                        document.getElementById('quantity').value = 1;
                        messageDiv.textContent = '';
                    }, 2000);
                } else {
                    messageDiv.textContent = data.message || 'Error al agregar al carrito';
                    messageDiv.className = 'mt-2 text-center text-sm text-red-600';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.textContent = 'Error al conectar con el servidor';
                messageDiv.className = 'mt-2 text-center text-sm text-red-600';
            })
            .finally(() => {
                submitBtn.disabled = false;
                spinner.classList.add('hidden');
                
                // Auto-hide message after 3 seconds
                if (messageDiv.textContent) {
                    setTimeout(() => {
                        messageDiv.textContent = '';
                    }, 3000);
                }
            });
        });
        
        // Update mobile quantity when desktop quantity changes
        function updateMobileQuantity(value) {
            document.getElementById('mobile-quantity').value = value;
        }

        function incrementQuantity(max) {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) || 1;
            if (value < max) {
                input.value = value + 1;
                updateMobileQuantity(input.value);
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) || 1;
            if (value > 1) {
                input.value = value - 1;
                updateMobileQuantity(input.value);
            }
        }

        function validateQuantity(max) {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) || 1;
            
            if (value < 1) input.value = 1;
            if (value > max) input.value = max;
            
            updateMobileQuantity(input.value);
        }
        
        // Handle mobile add to cart form submission
        document.getElementById('mobile-add-to-cart-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('mobile-add-to-cart-btn');
            const spinner = document.getElementById('mobile-add-to-cart-spinner');
            
            // Show loading state
            submitBtn.disabled = true;
            spinner.classList.remove('hidden');
            
            // Submit form via AJAX
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    quantity: document.getElementById('mobile-quantity').value,
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message (you could add a toast notification here)
                    const message = document.createElement('div');
                    message.className = 'fixed bottom-20 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
                    message.textContent = '¡Producto agregado al carrito!';
                    document.body.appendChild(message);
                    
                    // Update cart count in navigation if exists
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        // Increment cart count
                        const currentCount = parseInt(cartCount.textContent) || 0;
                        cartCount.textContent = currentCount + parseInt(document.getElementById('mobile-quantity').value);
                        cartCount.classList.remove('hidden');
                    }
                    
                    // Remove message after 2 seconds
                    setTimeout(() => {
                        message.remove();
                    }, 2000);
                } else {
                    // Show error message
                    const message = document.createElement('div');
                    message.className = 'fixed bottom-20 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg';
                    message.textContent = data.message || 'Error al agregar al carrito';
                    document.body.appendChild(message);
                    
                    // Remove message after 3 seconds
                    setTimeout(() => {
                        message.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message
                const message = document.createElement('div');
                message.className = 'fixed bottom-20 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg';
                message.textContent = 'Error al conectar con el servidor';
                document.body.appendChild(message);
                
                // Remove message after 3 seconds
                setTimeout(() => {
                    message.remove();
                }, 3000);
            })
            .finally(() => {
                submitBtn.disabled = false;
                spinner.classList.add('hidden');
            });
        });
    </script>
    @endpush
</x-app-layout>
