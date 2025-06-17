@extends('layouts.app-custom')

@section('title', 'Carrito de Compras | ' . config('app.name'))

@php
    use App\Facades\Cart;
    $cart = Cart::content();
    $total = Cart::total();
    $itemCount = is_array($cart) ? count($cart) : 0;
@endphp

@push('styles')

<style>
    /* Estilos generales */
    body {
        background-color: #f8f9fa;
        padding-top: 2rem;
    }
    
    .cart-container {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-top: 2rem;
    }
    
    .cart-header {
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
    }
    
    .cart-header h1 {
        font-weight: 700;
        color: #2c3e50;
    }
    
    .cart-item {
        display: flex;
        padding: 1.5rem 0;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .product-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 1.5rem;
    }
    
    .product-details {
        flex: 1;
    }
    
    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .product-price {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.2rem;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        margin: 0.5rem 0;
    }
    
    .quantity-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #dee2e6;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.2s;
    }
    
    .quantity-btn:hover {
        background: #f8f9fa;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-left: none;
        border-right: none;
        height: 32px;
        -moz-appearance: textfield;
    }
    
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    .remove-item {
        color: #dc3545;
        background: none;
        border: none;
        padding: 0;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        margin-top: 0.5rem;
    }
    
    .remove-item i {
        margin-right: 0.3rem;
    }
    
    .summary-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.03);
    }
    
    .summary-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #2c3e50;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }
    
    .summary-total {
        font-weight: 700;
        font-size: 1.2rem;
        color: #2c3e50;
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
        margin-top: 1rem;
    }
    
    .btn-checkout {
        background: #28a745;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        width: 100%;
        margin-top: 1.5rem;
        transition: all 0.3s;
    }
    
    .btn-checkout:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    
    .btn-continue-shopping {
        color: #6c757d;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-top: 1.5rem;
    }
    
    .btn-continue-shopping i {
        margin-right: 0.5rem;
    }
    
    .empty-cart {
        text-align: center;
        padding: 3rem 0;
    }
    
    .empty-cart i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1.5rem;
    }
    
    .empty-cart h3 {
        color: #6c757d;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }
    
    .empty-cart p {
        color: #6c757d;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
    }
    
    .btn-empty-cart {
        background-color: #007bff;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
    }
    
    .btn-empty-cart:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        color: white;
    }
    
    .btn-empty-cart i {
        margin-right: 0.5rem;
    }
    
    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .cart-header {
        background: linear-gradient(135deg, #6B46C1 0%, #805AD5 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(107, 70, 193, 0.2);
    }
    
    .cart-item {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .cart-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }
    /* Estilos para el resumen del pedido */
    .summary-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 20px;
    }
    
    .summary-title {
        color: #2D3748;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #E2E8F0;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        color: #4A5568;
    }
    
    .summary-total {
        font-weight: 700;
        font-size: 1.1rem;
        color: #2D3748;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #E2E8F0;
    }
    
    /* Estilos para los botones */
    .btn-checkout {
        background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
        border: none;
        padding: 12px 25px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        width: 100%;
        margin-top: 1.5rem;
        border-radius: 8px;
        color: white;
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    
    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
    }
    
    .btn-clear-cart {
        background: #FED7D7;
        color: #C53030;
        border: none;
        padding: 10px 20px;
        font-weight: 600;
        border-radius: 6px;
        margin-top: 1rem;
        width: 100%;
        transition: all 0.3s;
    }
    
    .btn-clear-cart:hover {
        background: #FEB2B2;
    }
    .empty-cart {
        text-align: center;
        padding: 4rem 0;
    }
    .empty-cart i {
        font-size: 5rem;
        color: #e2e8f0;
        margin-bottom: 1.5rem;
    }
    .remove-item {
        color: #e53e3e;
        cursor: pointer;
        transition: color 0.2s;
    }
    .remove-item:hover {
        color: #c53030;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="cart-container">
                <div class="cart-header d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><i class="fas fa-shopping-cart me-2"></i>Mi Carrito</h1>
                    @if($itemCount > 0)
                    <span class="badge bg-primary rounded-pill">{{ $itemCount }} {{ $itemCount === 1 ? 'producto' : 'productos' }}</span>
                    @endif
                </div>
                
                @if(!is_array($cart))
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Hubo un problema al cargar el carrito. Por favor, recarga la página o contacta con soporte.
                    </div>
                @elseif($itemCount > 0)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if($itemCount > 0 && is_array($cart))
                    <div class="row">
                        <!-- Lista de productos -->
                        <div class="col-lg-8">
                            @foreach($cart as $id => $item)
                                <div class="cart-item" id="cart-item-{{ $id }}">
                                    @if(isset($item['image_url']) && $item['image_url'])
                                        <img src="{{ asset($item['image_url']) }}" alt="{{ $item['name'] }}" class="product-image">
                                    @else
                                        <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                    <div class="product-details">
                                        <h3 class="product-title">{{ $item['name'] }}</h3>
                                        <div class="product-price">${{ number_format($item['price'], 2) }}</div>
                                        
                                        <!-- Selector de cantidad -->
                                     
                                        
                                      
                                    </div>
                                    <div class="text-end">
                                        <div class="product-price fw-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="d-grid gap-2">
                             <!--   <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i> Proceder al pago
                                </button> -->
                                
                                <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#whatsappModal">
                                    <i class="fab fa-whatsapp me-2"></i> Enviar pedido por WhatsApp
                                </button>
                                
                                <a href="{{ route('vista-1') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Seguir comprando
                                </a>
                            </div>
                            
                            <!-- Modal de WhatsApp -->
                            <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="whatsappModalLabel">Enviar pedido por WhatsApp</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="whatsappForm">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Tu número de teléfono</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                                           placeholder="Ej: 3001234567" required>
                                                    <div class="form-text">Necesitamos tu número para contactarte.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="notes" class="form-label">Notas adicionales</label>
                                                    <textarea class="form-control" id="notes" name="notes" 
                                                              rows="3" placeholder="Especificaciones, dirección de entrega, etc."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fab fa-whatsapp me-2"></i> Enviar por WhatsApp
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-danger" id="clear-cart">
                                <i class="fas fa-trash-alt me-2"></i>Vaciar Carrito
                            </button>
                        </div>
                        
                        <!-- Resumen del pedido -->
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="summary-card">
                                <h3 class="summary-title">Resumen del Pedido</h3>
                                
                                <div class="summary-row">
                                    <span>Subtotal ({{ $itemCount }} {{ $itemCount === 1 ? 'producto' : 'productos' }})</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                                
                                <div class="summary-row">
                                    <span>Envío</span>
                                    <span class="text-success">Gratis</span>
                                </div>
                                
                                <div class="summary-row summary-total">
                                    <span>Total</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                                
                                <a href="{{ route('cart.checkout') }}" class="btn btn-checkout" id="checkout-button">
                                    <i class="fas fa-credit-card me-2"></i> Proceder al Pago
                                </a>
                                
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-lock me-1"></i> Pago seguro con WhatsApp
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Carrito vacío -->
                    <div class="empty-cart py-5 text-center">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                        <h3>Tu carrito está vacío</h3>
                        <p class="text-muted mb-4">Aún no has agregado productos a tu carrito</p>
                        <a href="{{ route('vista-1') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i> Seguir comprando
                        </a>
                    </div>
                    
                    <!-- Depuración: Mostrar contenido del carrito -->
                    @if(env('APP_DEBUG') && !empty($cart))
                        <div class="mt-4 p-3 bg-light rounded">
                            <h5 class="mb-3">Información de depuración:</h5>
                            <pre class="bg-white p-3 rounded">{{ print_r($cart, true) }}</pre>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('open_whatsapp_modal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const whatsappModal = new bootstrap.Modal(document.getElementById('whatsappModal'));
        whatsappModal.show();
    });
</script>
@endif

<script>
    $(document).ready(function() {
        // Manejar el envío del formulario de WhatsApp
        $('#whatsappForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            const submitBtn = $(this).find('button[type="submit"]');
            const originalBtnText = submitBtn.html();
            
            // Mostrar carga
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Enviando...');
            
            // Enviar solicitud AJAX
            $.ajax({
                url: '{{ route("cart.send.whatsapp") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Cerrar el modal
                        $('#whatsappModal').modal('hide');
                        
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Listo!',
                            text: 'Serás redirigido a WhatsApp para confirmar tu pedido.',
                            showConfirmButton: true,
                            confirmButtonText: 'Abrir WhatsApp',
                            showCancelButton: true,
                            cancelButtonText: 'Cerrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open(response.redirect_url, '_blank');
                            }
                        });
                        
                        // Limpiar el formulario
                        $('#whatsappForm')[0].reset();
                    } else {
                        Swal.fire('Error', response.message || 'Ocurrió un error al procesar tu solicitud', 'error');
                    }
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.message || 'Error al conectar con el servidor';
                    Swal.fire('Error', errorMsg, 'error');
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });
        
        // Formatear número de teléfono mientras se escribe
        $('#phone').on('input', function() {
            let value = $(this).val().replace(/\D/g, '');
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            $(this).val(value);
        });
        
        // Validar formulario antes de enviar
        $('#whatsappForm').on('submit', function() {
            const phone = $('#phone').val().replace(/\D/g, '');
            if (phone.length < 10) {
                Swal.fire('Error', 'Por favor ingresa un número de teléfono válido (mínimo 10 dígitos)', 'error');
                return false;
            }
            return true;
        });
    });
</script>

<script></script>
<script>
    $(document).ready(function() {
        // Función para mostrar notificación
        function showAlert(icon, title, text, position = 'top-end', timer = 3000) {
            const Toast = Swal.mixin({
                toast: true,
                position: position,
                showConfirmButton: false,
                timer: timer,
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
        
        // Función para actualizar el resumen del pedido
        function updateOrderSummary(count, total) {
            $('.cart-count').text(count);
            $('.summary-row:first span:last').text('$' + parseFloat(total).toFixed(2));
            $('.summary-total span:last').text('$' + parseFloat(total).toFixed(2));
            
            // Actualizar el texto de la cantidad de productos
            const itemText = count === 1 ? 'producto' : 'productos';
            $('.summary-row:first span:first').text('Subtotal (' + count + ' ' + itemText + ')');
            
            // Actualizar el badge del carrito
            const $badge = $('.cart-count-badge');
            if (count > 0) {
                $badge.text(count).removeClass('d-none');
            } else {
                $badge.addClass('d-none');
            }
        }
        
        // Actualizar cantidad
        $('.update-cart').on('change', function() {
            var id = $(this).data('id');
            var quantity = $(this).val();
            var stock = $(this).attr('max');
            var button = $(this);
            
            if (quantity > stock) {
                showAlert('error', 'Error', 'La cantidad no puede ser mayor al stock disponible');
                $(this).val(stock);
                return false;
            }
            
            if (quantity < 1) {
                showAlert('error', 'Error', 'La cantidad debe ser al menos 1');
                $(this).val(1);
                return false;
            }
            
            // Mostrar indicador de carga
            button.prop('disabled', true);
            
            $.ajax({
                url: '{{ route("cart.update") }}',
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        // Actualizar la página para reflejar los cambios
                        window.location.reload();
                    } else {
                        showAlert('error', 'Error', 'No se pudo actualizar la cantidad');
                    }
                },
                error: function() {
                    showAlert('error', 'Error', 'Ocurrió un error al actualizar el carrito');
                },
                complete: function() {
                    button.prop('disabled', false);
                }
            });
        });
        
        // Eliminar producto del carrito
        $('.remove-from-cart').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var button = $(this);
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas eliminar este producto del carrito?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar indicador de carga
                    button.prop('disabled', true);
                    button.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Eliminando...');
                    
                    $.ajax({
                        url: '{{ route("cart.remove") }}',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            if (response.success) {
                                showAlert('success', '¡Eliminado!', 'El producto ha sido eliminado del carrito');
                                // Actualizar el contador del carrito
                                $('.cart-count').text(response.cart_count);
                                // Si el carrito queda vacío, recargar la página
                                if (response.cart_count === 0) {
                                    setTimeout(() => window.location.reload(), 1000);
                                } else {
                                    // Eliminar el elemento del DOM
                                    button.closest('.cart-item').fadeOut(300, function() {
                                        $(this).remove();
                                        // Actualizar el resumen
                                        updateOrderSummary(response.cart_count, response.total);
                                    });
                                }
                            } else {
                                showAlert('error', 'Error', 'No se pudo eliminar el producto');
                            }
                        },
                        error: function() {
                            showAlert('error', 'Error', 'Ocurrió un error al eliminar el producto');
                        },
                        complete: function() {
                            button.prop('disabled', false).html('<i class="fas fa-trash"></i> Eliminar');
                        }
                    });
                }
            });
        });
        
        // Botón de vaciar carrito
        $('#clear-cart').click(function(e) {
            e.preventDefault();
            const $button = $(this);
            const originalText = $button.html();
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción vaciará tu carrito de compras',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, vaciar carrito',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Procesando...');
                    
                    return $.ajax({
                        url: '{{ route("cart.clear") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    }).fail(function() {
                        Swal.showValidationMessage('Ocurrió un error al vaciar el carrito');
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    showAlert('success', '¡Listo!', 'El carrito se ha vaciado correctamente');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    $button.html(originalText).prop('disabled', false);
                }
            });
        });
        
        // Botones de incrementar/disminuir cantidad
        $('.quantity-btn').click(function() {
            var input = $(this).siblings('.quantity-input');
            var currentVal = parseInt(input.val());
            var max = parseInt(input.attr('max'));
            
            if ($(this).hasClass('plus') && currentVal < max) {
                input.val(currentVal + 1).trigger('change');
            } else if ($(this).hasClass('minus') && currentVal > 1) {
                input.val(currentVal - 1).trigger('change');
            } else if (currentVal >= max) {
                showAlert('info', 'Stock máximo', 'No hay más unidades disponibles');
            }
        });
        
        // Función para actualizar el resumen del pedido
        function updateOrderSummary(itemCount, total) {
            $('.summary-row:first span:last').text('$' + parseFloat(total).toFixed(2));
            $('.summary-total span:last').text('$' + parseFloat(total).toFixed(2));
            $('.cart-count').text(itemCount);
            
            // Actualizar el texto de la cantidad de productos
            var itemText = itemCount === 1 ? 'producto' : 'productos';
            $('.summary-row:first span:first').text('Subtotal (' + itemCount + ' ' + itemText + ')');
        }
    });
</script>
@endpush
