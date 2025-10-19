@php
    use App\Facades\Cart;
    $cart = Cart::content();
    $total = Cart::total();
    $count = is_array($cart) ? count($cart) : 0;
@endphp

@if($count > 0)
    <div class="mini-cart-items" style="max-height: 300px; overflow-y: auto;">
        @foreach($cart as $id => $item)
            <div class="cart-item mb-3 pb-3 border-bottom" data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{ $item['image_url'] ?? 'https://via.placeholder.com/80' }}" 
                             alt="{{ $item['name'] }}" 
                             class="img-fluid rounded" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">{{ $item['name'] }}</h6>
                            <button class="btn btn-link text-danger p-0 remove-item" data-id="{{ $id }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p class="text-muted mb-1">${{ number_format($item['price'], 0, ',', '.') }} c/u</p>
                        
                        <!-- Mostrar preferencias si existen -->
                        @if(!empty($item['preferences']))
                            <div class="mb-2">
                                @foreach($item['preferences'] as $key => $value)
                                    @if(!empty($value))
                                        <div class="preference-item">
                                            <small class="text-muted">
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}: 
                                                <span class="text-dark fw-bold">
                                                    @if(is_array($value))
                                                        {{ implode(', ', $value) }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </span>
                                            </small>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="cart-item-quantity">
                                <button type="button" class="btn btn-sm btn-outline-secondary quantity-btn minus">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" 
                                       class="form-control form-control-sm text-center quantity-input" 
                                       value="{{ $item['quantity'] }}" 
                                       min="1" 
                                       max="99" 
                                       style="width: 50px; display: inline-block;">
                                <button type="button" class="btn btn-sm btn-outline-secondary quantity-btn plus">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="fw-bold">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
        <strong>Total:</strong>
        <strong>{{ number_format($total, 2) }} €</strong>
    </div>
@else
    <div class="text-center py-4">
        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
        <p class="text-muted mb-0">Tu carrito está vacío</p>
    </div>
@endif
