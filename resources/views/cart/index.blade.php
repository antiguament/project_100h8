@extends('layouts.app-custom')

@section('title', 'Carrito de Compras | ' . config('app.name'))

@push('styles')
<style>
    /* Estilos generales */
    .cart-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
        margin: 2rem 0;
    }
    
    .cart-header {
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 1.25rem;
        margin-bottom: 2rem;
    }
    
    .cart-header h1 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.8rem;
    }
    
    .cart-item {
        display: flex;
        padding: 1.5rem;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.25rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .cart-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }
    
    .product-image-container {
        position: relative;
        width: 120px;
        height: 120px;
        flex-shrink: 0;
        margin-right: 1.5rem;
        border-radius: 8px;
        overflow: hidden;
        background: #f8f9fa;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .product-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    
    .product-price {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.2rem;
        margin: 0.5rem 0;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        margin: 0.75rem 0;
    }
    
    .quantity-btn {
        width: 34px;
        height: 34px;
        border: 1px solid #e0e0e0;
        background: #fff;
        color: #2c3e50;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.2s;
        border-radius: 6px;
    }
    
    .quantity-btn:hover {
        background: #f8f9fa;
        border-color: #cbd5e0;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        border: 1px solid #e0e0e0;
        border-left: none;
        border-right: none;
        height: 34px;
        -moz-appearance: textfield;
        font-weight: 500;
    }
    
    .remove-item {
        color: #e74c3c;
        background: none;
        border: none;
        padding: 0.25rem 0.5rem;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        border-radius: 4px;
        transition: all 0.2s;
        margin-top: 0.5rem;
    }
    
    .remove-item:hover {
        background: #fef2f2;
    }
    
    .summary-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.75rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        position: sticky;
        top: 2rem;
    }
    
    .summary-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #2c3e50;
        padding-bottom: 1rem;
        border-bottom: 1px solid #edf2f7;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        color: #4a5568;
    }
    
    .summary-total {
        font-weight: 700;
        font-size: 1.25rem;
        color: #2c3e50;
        border-top: 1px solid #edf2f7;
        padding-top: 1rem;
        margin: 1.5rem 0 1rem;
    }
    
    .btn-checkout {
        background: #4CAF50;
        color: white;
        font-weight: 600;
        padding: 0.9rem 1.5rem;
        border-radius: 8px;
        width: 100%;
        margin: 1.5rem 0 1rem;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
        border: none;
    }
    
    .btn-checkout:hover {
        background: #43a047;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
    }
    
    .btn-continue-shopping {
        color: #4a5568;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        transition: color 0.2s;
    }
    
    .btn-continue-shopping:hover {
        color: #2c3e50;
        text-decoration: underline;
    }
    
    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .empty-cart i {
        font-size: 4.5rem;
        color: #e2e8f0;
        margin-bottom: 1.5rem;
    }
    
    .empty-cart h3 {
        color: #4a5568;
        margin-bottom: 1.25rem;
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .empty-cart p {
        color: #718096;
        margin-bottom: 2rem;
        font-size: 1.05rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }
    
    .btn-outline-primary {
        border: 2px solid #4CAF50;
        color: #4CAF50;
        font-weight: 600;
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .btn-outline-primary:hover {
        background: #4CAF50;
        color: white;
        transform: translateY(-2px);
    }
    
    .product-meta {
        color: #718096;
        font-size: 0.9rem;
        margin: 0.25rem 0;
    }
    
    .product-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 0.75rem;
    }
    
    /* Nuevos estilos para preferencias mejoradas */
    .preferences-box {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
        border-left: 3px solid #0ee4eb;
    }
    
    .preferences-box strong {
        color: #333;
        font-size: 0.95rem;
    }
    
    .preferences-box ul li {
        padding: 0.25rem 0;
        font-size: 0.9rem;
    }
    
    .preferences-box i {
        color: #28a745;
    }
    
    @media (max-width: 768px) {
        .cart-container {
            padding: 1.5rem;
            margin: 1rem 0;
        }
        
        .cart-item {
            flex-direction: column;
            padding: 1.25rem;
        }
        
        .product-image-container {
            width: 100%;
            height: 200px;
            margin: 0 0 1rem 0;
        }
        
        .product-details {
            width: 100%;
        }
        
        .summary-card {
            margin-top: 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="cart-container">
                <div class="cart-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="m-0"><i class="fas fa-shopping-cart me-2"></i>Mi Carrito</h1>
                        @if(count((array)$cart) > 0)
                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.9rem;">
                            {{ count((array)$cart) }} {{ count((array)$cart) === 1 ? 'producto' : 'productos' }}
                        </span>
                        @endif
                    </div>
                    @if(count((array)$cart) > 0)
                    <p class="text-muted mb-0 mt-2">Revisa los productos en tu carrito</p>
                    @endif
                </div>

                @if(count((array)$cart) > 0)
                    <div class="row">
                        <!-- Lista de productos -->
                        <div class="col-lg-8">
                            @foreach($cart as $id => $item)
                                <div class="cart-item" id="cart-item-{{ $id }}">
                                    <div class="product-image-container">
                                        @if(isset($item['image_url']) && $item['image_url'])
                                            <img src="{{ asset($item['image_url']) }}" alt="{{ $item['name'] }}" class="product-image">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="product-details">
                                        <div>
                                            <h3 class="product-title">{{ $item['name'] }}</h3>
                                            @if(isset($item['description']) && $item['description'])
                                                <p class="product-meta">{{ Str::limit($item['description'], 100) }}</p>
                                            @endif
                                            <p class="product-price mb-0">${{ number_format($item['price'], 2, ',', '.') }}</p>

                                            {{-- Preferencias seleccionadas - MEJORADO --}}
                                            @if(isset($item['preferences']) && !empty($item['preferences']))
                                                @php
                                                    $prefs = is_string($item['preferences']) ? json_decode($item['preferences'], true) : $item['preferences'];
                                                @endphp
                                                @if(is_array($prefs) && count($prefs))
                                                    <div class="preferences-box bg-light rounded p-3 mt-3 border">
                                                        <strong class="d-block mb-2 text-primary">
                                                            <i class="fas fa-tags me-2"></i>Preferencias seleccionadas
                                                        </strong>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($prefs as $key => $val)
                                                                @php $label = ucwords(str_replace('_', ' ', $key)); @endphp
                                                                <li class="mb-2 d-flex align-items-center">
                                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                                    <span class="text-muted me-2">{{ $label }}:</span>
                                                                    <span class="fw-medium">
                                                                        @if(is_array($val))
                                                                            {{ implode(', ', $val) }}
                                                                        @else
                                                                            {{ $val }}
                                                                        @endif
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        
                                        <div class="product-actions">
                                            <div class="quantity-selector">
                                                <button class="quantity-btn minus" data-id="{{ $id }}">-</button>
                                                <input type="number" 
                                                       class="quantity-input" 
                                                       value="{{ $item['quantity'] }}" 
                                                       min="1" 
                                                       max="{{ $item['max_quantity'] ?? 100 }}" 
                                                       data-id="{{ $id }}" 
                                                       data-price="{{ $item['price'] }}">
                                                <button class="quantity-btn plus" data-id="{{ $id }}">+</button>
                                            </div>
                                            
                                            <button class="remove-from-cart btn btn-sm btn-outline-danger" data-id="{{ $id }}">
                                                <i class="fas fa-trash-alt me-1"></i> Eliminar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="/" class="btn-continue-shopping">
                                    <i class="fas fa-arrow-left me-2"></i> Seguir comprando
                                </a>
                                
                                <button type="button" class="btn btn-outline-primary" id="update-cart">
                                    <i class="fas fa-sync-alt me-2"></i> Actualizar carrito
                                </button>
                            </div>
                        </div>
                        
                        <!-- Resumen del pedido - MEJORADO -->
                        <div class="col-lg-4">
                            <div class="summary-card">
                                <h3 class="summary-title">Resumen del Pedido</h3>
                                
                                <div class="summary-row">
                                    <span>Subtotal</span>
                                    <span id="subtotal">${{ number_format($total, 2, ',', '.') }}</span>
                                </div>
                                
                                <div class="summary-row">
                                    <span>Envío</span>
                                    <span id="shipping">$0.00</span>
                                </div>
                                
                                <div class="summary-row summary-total">
                                    <span>Total</span>
                                    <span id="total">${{ number_format($total, 2, ',', '.') }}</span>
                                </div>
                                
                                <!-- Formulario de datos de entrega -->
                                <div class="mb-4">
                                    <h4 class="mb-3">Datos de Entrega</h4>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="customer_name" placeholder="Nombre completo" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="customer_phone" placeholder="Teléfono" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="customer_address" rows="3" placeholder="Dirección de entrega" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control" id="shipping_option" required>
                                            <option value="">Seleccionar método de envío</option>
                                            <option value="5000">Envío estándar - $5,000</option>
                                            <option value="10000">Envío express - $10,000</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Botón de WhatsApp mejorado -->
                                <a href="#" class="btn-checkout" id="whatsapp-checkout">
                                    <i class="fab fa-whatsapp me-2"></i> Pagar con WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Carrito vacío -->
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Tu carrito está vacío</h3>
                        <p>No has agregado ningún producto a tu carrito. Explora nuestros productos y encuentra algo que te guste.</p>
                        <a href="/" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i> Volver a la tienda
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Función para mostrar notificaciones
    function showAlert(icon, title, text) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        
        Toast.fire({
            icon: icon,
            title: title,
            text: text
        });
    }

    // Script mejorado para WhatsApp con guardado en archivo
    $('#whatsapp-checkout').click(function(e) {
        e.preventDefault();
        
        // Validar campos requeridos
        const customerName = $('#customer_name').val();
        const customerPhone = $('#customer_phone').val();
        const customerAddress = $('#customer_address').val();
        const shippingOption = $('#shipping_option').val();
        
        if (!customerName || !customerPhone || !customerAddress || !shippingOption) {
            showAlert('error', 'Error', 'Por favor completa todos los campos de entrega');
            return;
        }
        
        // Calcular subtotal y total
        let subtotal = 0;
        @foreach($cart as $id => $item)
            subtotal += {{ $item['price'] * $item['quantity'] }};
        @endforeach
        
        const envio = parseFloat(shippingOption) || 0;
        const total = subtotal + envio;
        
        // Datos a enviar
        const orderData = {
            customer_name: customerName,
            customer_phone: customerPhone,
            customer_address: customerAddress,
            shipping_option: shippingOption,
            subtotal: subtotal,
            shipping: envio,
            total: total,
            _token: '{{ csrf_token() }}'
        };
        
        // Guardar en archivo primero
        $.ajax({
            url: '{{ route('cart.saveOrder') }}',
            method: 'POST',
            data: orderData,
            success: function(response) {
                if (response.success) {
                    // Construir mensaje de WhatsApp
                    let message = `¡Hola! Quiero realizar el siguiente pedido:\n\n`;
                    message += `*Productos:*\n`;
                    
                    @foreach($cart as $id => $item)
                        message += `- *{{ $item['name'] }}*\n`;
                        message += `  Cantidad: {{ $item['quantity'] }}\n`;
                        message += `  Precio unitario: ${{ number_format($item['price'], 2, ',', '.') }}\n`;
                        message += `  Subtotal: ${{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}\n`;
                        
                        @if(isset($item['preferences']) && !empty($item['preferences']))
                            message += `  *Preferencias:*\n`;
                            @php
                                $prefs = is_string($item['preferences']) ? json_decode($item['preferences'], true) : $item['preferences'];
                            @endphp
                            @foreach($prefs as $key => $val)
                                @php $label = ucwords(str_replace('_', ' ', $key)); @endphp
                                message += `    - {{ $label }}: `;
                                @if(is_array($val))
                                    message += `{{ implode(', ', $val) }}\n`;
                                @else
                                    message += `{{ $val }}\n`;
                                @endif
                            @endforeach
                        @endif
                        message += `\n`;
                    @endforeach
                    
                    message += `*Resumen del pedido:*\n`;
                    message += `Subtotal: $${subtotal.toFixed(2)}\n`;
                    message += `Envío: $${envio.toFixed(2)}\n`;
                    message += `Total: $${total.toFixed(2)}\n\n`;
                    message += `*Datos de entrega:*\n`;
                    message += `Nombre: ${customerName}\n`;
                    message += `Teléfono: ${customerPhone}\n`;
                    message += `Dirección: ${customerAddress}\n`;
                    
                    // Redirigir a WhatsApp
                    const whatsappUrl = `https://wa.me/573128658195?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                } else {
                    showAlert('error', 'Error', 'No se pudo guardar el pedido');
                }
            },
            error: function(xhr) {
                showAlert('error', 'Error', 'Error al procesar el pedido');
                console.error(xhr.responseText);
            }
        });
    });
    
    // Actualizar total cuando cambia el método de envío
    $('#shipping_option').change(function() {
        const envio = parseFloat($(this).val()) || 0;
        const subtotal = {{ $total }};
        const total = subtotal + envio;
        
        $('#shipping').text('$' + envio.toFixed(2));
        $('#total').text('$' + total.toFixed(2));
    });

    // Funcionalidad existente para actualizar carrito
    $(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        // ... (tu código existente para eliminar productos)
    });
});
</script>
@endpush