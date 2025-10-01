<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ url()->previous() }}" class="mr-4 text-venice-gold-light hover:text-venice-gold transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-xl text-venice-gold-light leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Product Card Compact -->
            <div class="venetian-product-card bg-venice-card rounded-2xl shadow-venice overflow-hidden border border-venice-accent/30">
                <div class="flex flex-col md:flex-row">
                    <!-- Product Image -->
                    <div class="md:w-2/5 relative">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 md:h-full object-cover venetian-product-image">
                        @if($product->is_new)
                            <span class="absolute top-4 right-4 bg-venice-gold text-venice-blue px-3 py-1 rounded-full text-xs font-bold shadow-venice-gold">
                                ¡Nuevo!
                            </span>
                        @endif
                        @if($product->category)
                            <span class="absolute top-4 left-4 bg-venice-blue text-venice-gold-light text-xs font-medium px-2 py-1 rounded-full border border-venice-gold/30 shadow-md">
                                {{ $product->category->name }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Product Info -->
                    <div class="md:w-3/5 p-6 bg-venice-card-content">
                        <h1 class="text-2xl font-bold text-venice-gold-light mb-3">{{ $product->name }}</h1>
                        
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-2xl font-bold text-venice-accent drop-shadow-sm">${{ number_format($product->price, 2) }}</span>
                            @if($product->stock > 0)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-venice-success/30 text-venice-success border border-venice-success/40">
                                    <i class="fas fa-check-circle mr-1 text-xs"></i> En stock ({{ $product->stock }})
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-venice-danger/30 text-venice-danger border border-venice-danger/40">
                                    <i class="fas fa-times-circle mr-1 text-xs"></i> Agotado
                                </span>
                            @endif
                        </div>
                        
                        <div class="bg-venice-card-inner p-4 rounded-lg mb-5">
                            <p class="text-venice-light text-sm leading-relaxed">{{ $product->description ?? 'Este producto no tiene una descripción detallada.' }}</p>
                        </div>
                        

<!-- Preferencias del producto -->
@php($groups=[
  ['k'=>'preferencia_uno','l'=>$product->preferencia_uno??null,'o'=>$product->opciones_preferencia_uno??[], 'm'=>(int)($product->max_selecciones_uno??1)],
  ['k'=>'preferencia_dos','l'=>$product->preferencia_dos??null,'o'=>$product->opciones_preferencia_dos??[], 'm'=>(int)($product->max_selecciones_dos??1)],
  ['k'=>'preferencia_tres','l'=>$product->preferencia_tres??null,'o'=>$product->opciones_preferencia_tres??[], 'm'=>(int)($product->max_selecciones_tres??1)],
])
@foreach($groups as $g)
  @if(!empty($g['l']) && is_array($g['o']) && count($g['o']))
    <div class="mb-5 venetian-preferences-group" data-group="{{ $g['k'] }}" data-max="{{ $g['m'] }}">
      <div class="flex items-center justify-between mb-2">
        <span class="text-sm text-venice-gold-light font-semibold">
          {{ $g['l'] }}
          @if($g['m']>1)
            <span class="text-venice-light/80">(Máx. {{ $g['m'] }})</span>
          @endif
        </span>
      </div>
      <div class="flex flex-wrap gap-2">
        @php($multi=$g['m']>1)
        @foreach($g['o'] as $opt)
          <label class="venetian-option-chip">
            <input type="{{ $multi ? 'checkbox' : 'radio' }}" name="{{ $g['k'] }}{{ $multi ? '[]' : '' }}" value="{{ $opt }}" class="sr-only venetian-pref-input" data-group="{{ $g['k'] }}">
            <span class="venetian-option-label">{{ $opt }}</span>
          </label>
        @endforeach
      </div>
    </div>
  @endif
@endforeach
<!-- /Preferencias del producto -->



                        <!-- Desktop Add to Cart -->
                        <div class="desktop-only">
                            <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-0">
                                @csrf
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-venice-gold-light font-semibold">Cantidad:</span>
                                    <div class="flex items-center">
                                        <button type="button" class="venetian-quantity-btn border border-venice-accent text-venice-accent hover:bg-venice-accent/10" onclick="decrementQuantity()">-</button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                               max="{{ $product->stock }}" class="venetian-quantity-input border-venice-accent bg-venice-input" 
                                               onchange="validateQuantity({{ $product->stock }})">
                                        <button type="button" class="venetian-quantity-btn bg-venice-accent text-venice-blue hover:bg-venice-accent/90" onclick="incrementQuantity({{ $product->stock }})">+</button>
                                    </div>
                                </div>
                                
                                <button type="submit" id="add-to-cart-btn" class="venetian-add-to-cart-btn w-full" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart"></i>
                                    <span id="add-to-cart-text">
                                        {{ $product->stock > 0 ? 'Agregar al carrito' : 'Producto agotado' }}
                                    </span>
                                    <span id="add-to-cart-spinner" class="hidden ml-2">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>
                                <div id="cart-message" class="mt-3 text-center text-sm font-medium"></div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Product Details Accordion -->
                <div class="border-t border-venice-accent/30">
                    <details class="group" open>
                        <summary class="flex items-center justify-between p-5 cursor-pointer venetian-accordion-summary bg-venice-card-header">
                            <h3 class="text-base font-semibold text-venice-gold-light flex items-center">
                                <i class="fas fa-info-circle mr-2 text-venice-accent"></i>
                                Detalles del producto
                            </h3>
                            <span class="transition-transform duration-300 group-open:rotate-180 text-venice-accent">
                                <i class="fas fa-chevron-down text-lg"></i>
                            </span>
                        </summary>
                        <div class="px-5 pb-5 bg-venice-card-inner">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="venetian-detail-item p-3">
                                    <span class="venetian-detail-label block text-xs text-venice-light/80 font-medium mb-1">Categoría</span>
                                    <span class="venetian-detail-value font-semibold text-venice-gold-light">{{ $product->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="venetian-detail-item p-3">
                                    <span class="venetian-detail-label block text-xs text-venice-light/80 font-medium mb-1">Disponibilidad</span>
                                    <span class="venetian-detail-value font-semibold {{ $product->stock > 0 ? 'text-venice-success' : 'text-venice-danger' }}">
                                        {{ $product->stock > 0 ? 'En stock' : 'Agotado' }}
                                    </span>
                                </div>
                                <div class="venetian-detail-item p-3">
                                    <span class="venetian-detail-label block text-xs text-venice-light/80 font-medium mb-1">Precio</span>
                                    <span class="venetian-detail-value font-semibold text-venice-accent">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
            
            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <div class="mt-10">
                <h3 class="text-xl font-bold text-venice-gold-light mb-6 flex items-center">
                    <span class="h-6 w-1.5 bg-venice-accent rounded-full mr-3"></span>
                    Productos relacionados
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct) }}" class="venetian-related-product bg-venice-card rounded-xl shadow-venice border border-venice-accent/25 overflow-hidden transition-all duration-300 hover:scale-[1.03] hover:shadow-venice-hover group">
                        <div class="relative overflow-hidden">
                            <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-venice-blue/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @if($relatedProduct->is_new)
                                <span class="absolute top-3 right-3 bg-venice-gold text-venice-blue px-2 py-1 rounded text-xs font-bold shadow-md">Nuevo</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="venetian-related-product-name text-sm font-semibold text-venice-gold-light line-clamp-2 mb-2 group-hover:text-venice-accent transition-colors">{{ $relatedProduct->name }}</h4>
                            <p class="venetian-related-product-price text-venice-accent font-bold text-lg">${{ number_format($relatedProduct->price, 2) }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Mobile Fixed Action Button -->
    <div class="venetian-fixed-action-btn">
        <form id="mobile-add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
            @csrf
            <input type="hidden" name="quantity" value="1" id="mobile-quantity">
            <button type="submit" id="mobile-add-to-cart-btn" class="venetian-add-to-cart-btn venetian-mobile-btn" {{ $product->stock <= 0 ? 'disabled' : '' }}>
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
    
    <!-- Bottom Navigation -->
    <x-bottom-nav />
    
    @push('styles')
    <style>





/* Estilos para las opciones de preferencia */
.venetian-option-chip {
    display: inline-block;
    margin: 4px;
    position: relative;
}

.venetian-option-label {
    display: inline-block;
    padding: 6px 12px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s;
}

.venetian-option-chip input[type="radio"]:checked + .venetian-option-label,
.venetian-option-chip input[type="checkbox"]:checked + .venetian-option-label {
    background-color: #0ee4eb;
    color: white;
    border-color: #0ee4eb;
}

.venetian-option-chip input[type="radio"],
.venetian-option-chip input[type="checkbox"] {
    position: absolute;
    opacity: 0;
}

.venetian-preferences-group {
    margin-bottom: 1.5rem;
    padding: 1rem;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.venetian-preferences-group h4 {
    margin-top: 0;
    margin-bottom: 0.75rem;
    color: #333;
    font-size: 1rem;
}

.venetian-preferences-group.invalid {
    border: 1px solid #ff4444;
}








        :root {
            --venice-blue: #0A2E36;
            --venice-blue-dark: #051F26;
            --venice-teal: #0D4D5A;
            --venice-turquoise: #117A8A;
            --venice-light: #14B8C6;
            --venice-accent: #0EE4EB;
            --venice-gold: #D4AF37;
            --venice-gold-light: #F1E5AC;
            --venice-card: rgba(13, 77, 90, 0.85);
            --venice-card-content: rgba(10, 46, 54, 0.95);
            --venice-card-header: rgba(8, 40, 47, 0.95);
            --venice-card-inner: rgba(5, 31, 38, 0.6);
            --venice-input: rgba(255, 255, 255, 0.12);
            --venice-success: #2ECC71;
            --venice-danger: #FF6B6B;
            --venice-warning: #FF9F43;
            --shadow-venice: 0 8px 32px rgba(0, 194, 203, 0.2);
            --shadow-venice-hover: 0 12px 40px rgba(0, 194, 203, 0.3);
            --shadow-venice-gold: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        body {
            background: linear-gradient(135deg, var(--venice-blue-dark) 0%, var(--venice-blue) 100%);
            padding-bottom: 90px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }




/* Chips de opciones de preferencias */
.venetian-option-chip {
  display: inline-flex;
  align-items: center;
  border: 1.5px solid rgba(14, 228, 235, 0.35);
  color: var(--venice-gold-light);
  padding: 0.4rem 0.7rem;
  border-radius: 9999px;
  cursor: pointer;
  transition: all 0.2s ease;
  background: rgba(13, 77, 90, 0.35);
  user-select: none;
}
.venetian-option-chip:hover {
  transform: translateY(-2px);
  border-color: rgba(14, 228, 235, 0.6);
}
.venetian-option-chip input:checked + .venetian-option-label {
  background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
  color: var(--venice-blue-dark);
  box-shadow: var(--shadow-venice);
}
.venetian-option-label {
  border-radius: 9999px;
  padding: 0.25rem 0.6rem;
  transition: all 0.2s ease;
}





        .venetian-product-card {
            transition: all 0.3s ease;
            box-shadow: var(--shadow-venice);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(14, 228, 235, 0.25);
        }

        .venetian-product-card:hover {
            box-shadow: var(--shadow-venice-hover);
            transform: translateY(-2px);
        }

        .venetian-product-image {
            border-right: 1px solid rgba(14, 228, 235, 0.3);
        }

        .venetian-quantity-btn {
            width: 32px;
            height: 32px;
            border: 2px solid;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .venetian-quantity-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 194, 203, 0.3);
        }

        .venetian-quantity-input {
            width: 50px;
            height: 32px;
            text-align: center;
            margin: 0 8px;
            border: 2px solid;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            background: var(--venice-input);
            color: var(--venice-gold-light);
            -moz-appearance: textfield;
        }

        .venetian-quantity-input:focus {
            outline: none;
            border-color: var(--venice-accent);
            box-shadow: 0 0 0 3px rgba(14, 228, 235, 0.2);
        }

        .venetian-quantity-input::-webkit-outer-spin-button,
        .venetian-quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .venetian-add-to-cart-btn {
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue-dark);
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            box-shadow: var(--shadow-venice);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .venetian-add-to-cart-btn:not(:disabled):hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-venice-hover);
            background: linear-gradient(135deg, var(--venice-accent), var(--venice-light));
        }

        .venetian-add-to-cart-btn:disabled {
            background: rgba(209, 213, 219, 0.3);
            color: rgba(209, 213, 219, 0.7);
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        .venetian-fixed-action-btn {
            position: fixed;
            bottom: 90px;
            left: 1rem;
            right: 1rem;
            z-index: 50;
            display: none;
            pointer-events: none;
        }

        .venetian-fixed-action-btn > * {
            pointer-events: auto;
        }

        .venetian-mobile-btn {
            border-radius: 14px;
            padding: 1.1rem;
            box-shadow: 0 8px 25px rgba(0, 194, 203, 0.4);
            backdrop-filter: blur(15px);
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            font-weight: 700;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .venetian-accordion-summary {
            transition: all 0.3s ease;
        }

        .venetian-accordion-summary:hover {
            background: rgba(8, 40, 47, 0.8) !important;
        }

        .venetian-detail-item {
            padding: 1rem;
            border-radius: 10px;
            background: rgba(13, 77, 90, 0.4);
            border: 1px solid rgba(14, 228, 235, 0.15);
            transition: all 0.3s ease;
        }

        .venetian-detail-item:hover {
            background: rgba(13, 77, 90, 0.6);
            transform: translateY(-2px);
        }

        .venetian-detail-label {
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .venetian-detail-value {
            font-size: 1rem;
        }

        .venetian-related-product {
            transition: all 0.3s ease;
            border: 1px solid rgba(14, 228, 235, 0.2);
        }

        .venetian-related-product:hover {
            transform: translateY(-5px);
            border-color: rgba(14, 228, 235, 0.4);
        }

        .venetian-related-product-name {
            color: var(--venice-gold-light);
            transition: color 0.3s ease;
        }

        .venetian-related-product-price {
            color: var(--venice-accent);
            font-size: 1.1rem;
        }

        .bg-venice-card-content {
            background: var(--venice-card-content);
        }

        .bg-venice-card-header {
            background: var(--venice-card-header);
        }

        .bg-venice-card-inner {
            background: var(--venice-card-inner);
            border: 1px solid rgba(14, 228, 235, 0.1);
        }

        .bg-venice-input {
            background: var(--venice-input);
        }

        @media (max-width: 768px) {
            .venetian-fixed-action-btn {
                display: block;
            }
            
            .desktop-only {
                display: none;
            }
            
            .venetian-product-card {
                border-radius: 20px;
            }
            
            .venetian-product-image {
                border-right: none;
                border-bottom: 1px solid rgba(14, 228, 235, 0.3);
            }
            
            .venetian-mobile-btn {
                font-size: 0.9rem;
                padding: 1rem;
            }
        }

        details summary {
            list-style: none;
        }
        
        details summary::-webkit-details-marker {
            display: none;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        @keyframes glow {
            0% { box-shadow: var(--shadow-venice), 0 0 5px rgba(14, 228, 235, 0.3); }
            50% { box-shadow: var(--shadow-venice), 0 0 20px rgba(14, 228, 235, 0.5); }
            100% { box-shadow: var(--shadow-venice), 0 0 5px rgba(14, 228, 235, 0.3); }
        }
        
        .venetian-product-card {
            animation: fadeIn 0.8s ease forwards, glow 4s infinite alternate;
        }
        
        .venetian-related-product {
            animation: fadeIn 0.8s ease forwards;
            animation-delay: calc(var(--index, 0) * 0.1s);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(10, 46, 54, 0.6);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--venice-light), var(--venice-accent));
            border-radius: 10px;
            border: 2px solid var(--venice-blue);
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, var(--venice-accent), var(--venice-gold));
        }
        
        /* Text contrast improvements */
        .text-venice-gold-light {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .text-venice-light {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .text-venice-accent {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Add index for animation delay
        document.querySelectorAll('.venetian-related-product').forEach((card, index) => {
            card.style.setProperty('--index', index);
        });




  // Preferencias: recolectar selección por grupo (clave = preferencia_*). Si max>1 devuelve array, si no string.
  function getSelectedPreferences() {
    const res = {};
    document.querySelectorAll('.venetian-preferences-group').forEach(group => {
      const key = group.getAttribute('data-group');
      const max = parseInt(group.getAttribute('data-max') || '1', 10);
      const selected = Array.from(group.querySelectorAll('.venetian-pref-input:checked')).map(i => i.value);
      if (selected.length > 0) res[key] = max > 1 ? selected : selected[0];
    });
    return res;
  }



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
                    messageDiv.className = 'mt-3 text-center text-sm font-medium text-green-400';
                    
                    // Update cart count in navigation if exists
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        const currentCount = parseInt(cartCount.textContent) || 0;
                        cartCount.textContent = currentCount + parseInt(document.getElementById('quantity').value);
                        cartCount.classList.remove('hidden');
                    }
                } else {
                    messageDiv.textContent = data.message || 'Error al agregar al carrito';
                    messageDiv.className = 'mt-3 text-center text-sm font-medium text-red-400';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.textContent = 'Error al conectar con el servidor';
                messageDiv.className = 'mt-3 text-center text-sm font-medium text-red-400';
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
  _token: '{{ csrf_token() }}',
  ...(() => {
    const p = getSelectedPreferences();
    return {
      preferencia_uno: p.preferencia_uno,
      preferencia_dos: p.preferencia_dos,
      preferencia_tres: p.preferencia_tres
    };
  })()
})
            })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const message = document.createElement('div');
                    message.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-semibold z-50';
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
                    message.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-semibold z-50';
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
                message.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-semibold z-50';
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add-to-cart-form');
    const prefInputs = {
        uno: document.getElementById('preferencia_uno_input'),
        dos: document.getElementById('preferencia_dos_input'),
        tres: document.getElementById('preferencia_tres_input')
    };

    // Actualizar preferencias cuando se seleccionan opciones
    document.querySelectorAll('.venetian-pref-input').forEach(input => {
        input.addEventListener('change', function() {
            const group = this.dataset.group;
            const groupKey = group.split('_')[1]; // Obtener 'uno', 'dos' o 'tres'
            const isMultiple = this.type === 'checkbox';
            
            if (isMultiple) {
                const checked = document.querySelectorAll(`input[name="${group}[]"]:checked`);
                const values = Array.from(checked).map(cb => cb.value);
                prefInputs[groupKey].value = JSON.stringify(values);
            } else {
                prefInputs[groupKey].value = this.value;
            }
        });
    });

    // Validar preferencias antes de enviar el formulario
    form.addEventListener('submit', function(e) {
        let hasErrors = false;
        
        // Validar que se hayan seleccionado las preferencias requeridas
        document.querySelectorAll('.venetian-preferences-group').forEach(group => {
            const groupKey = group.dataset.group.split('_')[1];
            const max = parseInt(group.dataset.max);
            const checked = group.querySelectorAll('input[type="checkbox"]:checked, input[type="radio"]:checked');
            
            if (checked.length === 0) {
                hasErrors = true;
                group.style.border = '1px solid red';
            } else if (checked.length > max) {
                hasErrors = true;
                alert(`Solo puedes seleccionar un máximo de ${max} opciones para esta preferencia.`);
            } else {
                group.style.border = 'none';
            }
        });

        if (hasErrors) {
            e.preventDefault();
            alert('Por favor completa todas las preferencias requeridas.');
        }
    });
});
</script>

    @endpush
</x-app-layout>