<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ url()->previous() }}" class="mr-4 text-primary-color hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-xl text-dark-color leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="product-card-improved bg-white rounded-2xl shadow-lg overflow-hidden border border-light-gray">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-2/5 relative">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 md:h-full object-cover rounded-t-2xl md:rounded-l-2xl md:rounded-tr-none product-image-improved">
                        @if($product->is_new)
                            <span class="absolute top-4 right-4 bg-primary-color text-light-color px-3 py-1 rounded-full text-xs font-bold shadow-md">
                                ¡Nuevo!
                            </span>
                        @endif
                        @if($product->category)
                            <span class="absolute top-4 left-4 bg-dark-color/70 text-light-color text-xs font-medium px-2 py-1 rounded-full border border-light-gray/30">
                                {{ $product->category->name }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="md:w-3/5 p-5 md:p-8">
                        <h1 class="text-2xl md:text-3xl font-bold text-dark-color mb-2">{{ $product->name }}</h1>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl md:text-3xl font-bold text-primary-color">${{ number_format($product->price, 2) }}</span>
                            @if($product->stock > 0)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-success-color/20 text-success-color border border-success-color/30">
                                    <i class="fas fa-check-circle mr-1 text-sm"></i> En stock ({{ $product->stock }})
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-danger-color/20 text-danger-color border border-danger-color/30">
                                    <i class="fas fa-times-circle mr-1 text-sm"></i> Agotado
                                </span>
                            @endif
                        </div>
                        
                        <p class="text-gray-color text-sm mb-5 leading-relaxed">{{ $product->description ?? 'Este producto no tiene una descripción detallada.' }}</p>
                        
                        <div class="desktop-only">
                            <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-0">
                                @csrf
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-gray-color font-medium">Cantidad:</span>
                                    <div class="flex items-center">
                                        <button type="button" class="quantity-btn-improved border border-gray-color text-gray-color" onclick="decrementQuantity()">-</button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                               max="{{ $product->stock }}" class="quantity-input-improved border-gray-color" 
                                               onchange="validateQuantity({{ $product->stock }})">
                                        <button type="button" class="quantity-btn-improved bg-primary-color text-white" onclick="incrementQuantity({{ $product->stock }})">+</button>
                                    </div>
                                </div>
                                
                                <button type="submit" id="add-to-cart-btn" class="add-to-cart-btn-improved w-full" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart"></i>
                                    <span id="add-to-cart-text">
                                        {{ $product->stock > 0 ? 'Agregar al carrito' : 'Producto agotado' }}
                                    </span>
                                    <span id="add-to-cart-spinner" class="hidden ml-2">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>
                                <div id="cart-message" class="mt-2 text-center text-xs"></div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-light-gray">
                    <details class="group">
                        <summary class="flex items-center justify-between p-4 cursor-pointer accordion-summary-improved">
                            <h3 class="text-sm font-semibold text-dark-color">Detalles del producto</h3>
                            <span class="transition group-open:rotate-180">
                                <i class="fas fa-chevron-down text-gray-color text-xs"></i>
                            </span>
                        </summary>
                        <div class="px-4 pb-4">
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div class="detail-item-improved">
                                    <span class="detail-label-improved">Categoría</span>
                                    <span class="detail-value-improved font-medium text-dark-color">{{ $product->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item-improved">
                                    <span class="detail-label-improved">Disponibilidad</span>
                                    <span class="detail-value-improved font-medium">{{ $product->stock > 0 ? 'En stock' : 'Agotado' }}</span>
                                </div>
                                <div class="detail-item-improved">
                                    <span class="detail-label-improved">Precio</span>
                                    <span class="detail-value-improved font-medium text-primary-color">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
            
            @if($relatedProducts->count() > 0)
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-dark-color mb-4 flex items-center">
                    <span class="h-5 w-1 bg-primary-color rounded-full mr-2"></span>
                    Productos relacionados
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct) }}" class="related-product-card-improved bg-white rounded-lg shadow-lg border border-light-gray overflow-hidden transition-transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="relative">
                            <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" class="w-full h-32 object-cover">
                            @if($relatedProduct->is_new)
                                <span class="absolute top-2 right-2 bg-primary-color text-white px-1.5 py-0.5 rounded text-xs font-bold">Nuevo</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <h4 class="related-product-name-improved text-xs font-medium text-dark-color line-clamp-2 mb-1">{{ $relatedProduct->name }}</h4>
                            <p class="related-product-price-improved text-primary-color font-bold">${{ number_format($relatedProduct->price, 2) }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <div class="fixed-action-btn-improved">
        <form id="mobile-add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
            @csrf
            <input type="hidden" name="quantity" value="1" id="mobile-quantity">
            <button type="submit" id="mobile-add-to-cart-btn" class="add-to-cart-btn-improved mobile-btn-improved" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                <i class="fas fa-shopping-cart"></i>
                <span id="mobile-add-to-cart-text">
                    {{ $product->stock > 0 ? 'Agregar - $' . number_format($product->price, 2) : 'Producto agotado' }}
                </span>
                <span id="mobile-add-to-cart-spinner" class="hidden ml-2">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
        </form>
    </div>
    
    <x-bottom-nav />
    
    @push('styles')
    <style>
        :root {
            --primary-color: #E63946;
            --primary-light: #FF6B6B;
            --secondary-color: #2A9D8F;
            --dark-color: #1D3557;
            --light-color: #F1FAEE;
            --success-color: #2A9D8F;
            --warning-color: #F4A261;
            --danger-color: #E76F51;
            --gray-color: #495057;
            --light-gray: #E9ECEF;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 90px;
        }

        .product-card-improved, .related-product-card-improved {
            transition: var(--transition);
            box-shadow: var(--box-shadow);
        }

        .product-card-improved:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .quantity-btn-improved {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .quantity-btn-improved:hover {
            transform: translateY(-1px);
        }
        
        .quantity-input-improved {
            width: 50px;
            height: 32px;
            text-align: center;
            margin: 0 8px;
            border: 1px solid;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            background: var(--light-gray);
            color: var(--dark-color);
            -moz-appearance: textfield;
        }

        .quantity-input-improved::-webkit-outer-spin-button,
        .quantity-input-improved::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .add-to-cart-btn-improved {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            cursor: pointer;
        }

        .add-to-cart-btn-improved:not(:disabled):hover {
            background: #C1121F;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(230, 57, 70, 0.25);
        }

        .add-to-cart-btn-improved:disabled {
            background: var(--light-gray);
            color: var(--gray-color);
            cursor: not-allowed;
            box-shadow: none;
        }

        .fixed-action-btn-improved {
            position: fixed;
            bottom: 80px;
            left: 1rem;
            right: 1rem;
            z-index: 50;
            display: none;
            pointer-events: none;
        }

        .fixed-action-btn-improved > * {
            pointer-events: auto;
        }

        .mobile-btn-improved {
            border-radius: 12px;
            padding: 0.9rem;
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.35);
        }

        .accordion-summary-improved {
            transition: background-color 0.2s ease;
        }

        .accordion-summary-improved:hover {
            background: var(--light-gray);
        }

        .detail-item-improved {
            padding: 0.5rem;
            border-radius: 8px;
            background: var(--light-gray);
        }

        .detail-label-improved {
            font-size: 0.7rem;
            color: var(--gray-color);
            opacity: 0.7;
        }

        .detail-value-improved {
            font-size: 0.9rem;
            color: var(--dark-color);
        }

        .related-product-card-improved {
            transition: var(--transition);
        }

        .related-product-card-improved:hover {
            transform: translateY(-3px);
        }

        .related-product-name-improved {
            color: var(--dark-color);
        }

        .related-product-price-improved {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .fixed-action-btn-improved {
                display: block;
            }
            
            .desktop-only {
                display: none;
            }
            
            .product-card-improved {
                border-radius: 16px;
            }
            
            .product-image-improved {
                border-bottom: 1px solid var(--light-gray);
            }
        }

        details summary {
            list-style: none;
        }
        details summary::-webkit-details-marker {
            display: none;
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
                    messageDiv.className = 'mt-2 text-center text-xs text-success-color';
                    
                    // Update cart count in navigation if exists
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        const currentCount = parseInt(cartCount.textContent) || 0;
                        cartCount.textContent = currentCount + parseInt(document.getElementById('quantity').value);
                        cartCount.classList.remove('hidden');
                    }
                } else {
                    messageDiv.textContent = data.message || 'Error al agregar al carrito';
                    messageDiv.className = 'mt-2 text-center text-xs text-danger-color';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.textContent = 'Error al conectar con el servidor';
                messageDiv.className = 'mt-2 text-center text-xs text-danger-color';
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
                    // Show success message
                    const message = document.createElement('div');
                    message.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-success-color text-white px-4 py-2 rounded-lg shadow-lg text-sm';
                    message.textContent = '¡Producto agregado al carrito!';
                    document.body.appendChild(message);
                    
                    // Update cart count in navigation if exists
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
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
                    message.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-danger-color text-white px-4 py-2 rounded-lg shadow-lg text-sm';
                    message.textContent = data.message || 'Error al agregar al carrito';
                    document.body.appendChild(message);
                    
                    setTimeout(() => {
                        message.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const message = document.createElement('div');
                message.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-danger-color text-white px-4 py-2 rounded-lg shadow-lg text-sm';
                message.textContent = 'Error al conectar con el servidor';
                document.body.appendChild(message);
                
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