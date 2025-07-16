@extends('layouts.app-custom')

@section('title', $product->name . ' | ' . config('app.name'))

@section('content')
<div class="container py-5">
    <!-- Botón de volver atrás -->
    <a href="{{ route('categoria.productos', $product->category_id) }}" class="btn btn-outline-primary mb-4">
        <i class="fas fa-arrow-left me-2"></i> Volver a {{ $product->category->name }}
    </a>

    <!-- Detalles del producto -->
    <div class="row g-4">
        <!-- Imagen del producto -->
        <div class="col-lg-6">
            <div class="product-image-container bg-light rounded-3 p-4 text-center">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                         class="img-fluid rounded-3 shadow-sm" style="max-height: 400px; width: auto; max-width: 100%;">
                @else
                    <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="fas fa-box-open fa-5x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Información del producto -->
        <div class="col-lg-6">
            <div class="product-details">
                <!-- Categoría -->
                <div class="mb-3">
                    <span class="badge bg-primary bg-gradient">{{ $product->category->name }}</span>
                </div>
                
                <!-- Nombre y precio -->
                <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
                <div class="d-flex align-items-center mb-4">
                    <span class="h2 fw-bold text-primary me-3">${{ number_format($product->price, 2) }}</span>
                    @if($product->stock > 0)
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle me-1"></i> En stock
                        </span>
                    @else
                        <span class="badge bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-times-circle me-1"></i> Agotado
                        </span>
                    @endif
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <h5 class="mb-2">Descripción</h5>
                    <p class="text-muted">{{ $product->description ?? 'No hay descripción disponible para este producto.' }}</p>
                </div>

                <!-- Stock -->
                <div class="mb-4">
                    <p class="mb-2"><strong>Disponibilidad:</strong> 
                        @if($product->stock > 0)
                            <span class="text-success">En stock ({{ $product->stock }} unidades)</span>
                        @else
                            <span class="text-danger">Agotado</span>
                        @endif
                    </p>
                </div>

                <!-- Acciones -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <!-- Selector de cantidad -->
                    <div class="quantity-selector d-flex align-items-center mb-2">
                        <button class="btn btn-outline-secondary quantity-btn minus" type="button">-</button>
                        <input type="number" class="form-control text-center quantity-input" value="1" min="1" max="{{ $product->stock }}" style="width: 70px;">
                        <button class="btn btn-outline-secondary quantity-btn plus" type="button">+</button>
                    </div>
                    
                    <!-- Botón de añadir al carrito -->
                    <button class="btn btn-primary px-4 mb-2 add-to-cart" 
                            data-id="{{ $product->id }}"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-shopping-cart me-2"></i>
                        {{ $product->stock > 0 ? 'Añadir al carrito' : 'Sin stock' }}
                    </button>
                    
                    <!-- Botón de lista de deseos (opcional) -->
                    <button class="btn btn-outline-secondary mb-2" title="Añadir a la lista de deseos">
                        <i class="far fa-heart"></i>
                    </button>
                </div>

                <!-- Stock disponible -->
                <div class="mb-4">
                    <h5 class="mb-3">Disponibilidad</h5>
                    @if($product->stock > 0)
                        <p class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            {{ $product->stock }} unidades disponibles
                        </p>
                    @else
                        <p class="mb-0">
                            <i class="fas fa-times-circle text-danger me-2"></i>
                            Producto temporalmente agotado
                        </p>
                    @endif
                </div>

                <!-- Espaciador para mantener el diseño -->
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

    <!-- Productos relacionados -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5 pt-5">
            <h3 class="mb-4">Productos relacionados</h3>
            <div class="row g-4">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                            <a href="{{ route('producto.detalle', $relatedProduct->id) }}" class="text-decoration-none text-dark">
                                <div class="product-card-image">
                                    @if($relatedProduct->image_url)
                                        <img src="{{ $relatedProduct->image_url }}" 
                                             class="card-img-top" alt="{{ $relatedProduct->name }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                            <i class="fas fa-box-open fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($relatedProduct->name, 40) }}</h5>
                                    <p class="card-text text-primary fw-bold mb-0">
                                        ${{ number_format($relatedProduct->price, 2) }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    /* Estilos para el selector de cantidad */
    .quantity-selector {
        display: flex;
        align-items: center;
    }
    
    .quantity-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dee2e6;
        background-color: #fff;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .quantity-btn:hover {
        background-color: #f8f9fa;
    }
    
    .quantity-input {
        -moz-appearance: textfield;
        text-align: center;
        border-left: none;
        border-right: none;
    }
    
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .product-image-container {
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .product-details {
        padding: 1.5rem;
    }
    
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .product-card-image {
        height: 180px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .product-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .product-card-image:hover img {
        transform: scale(1.05);
    }
    
    .btn-outline-primary {
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Manejar el selector de cantidad
    $('.quantity-btn').click(function() {
        var input = $(this).siblings('.quantity-input');
        var currentVal = parseInt(input.val());
        var max = parseInt(input.attr('max'));
        
        if ($(this).hasClass('plus') && currentVal < max) {
            input.val(currentVal + 1);
        } else if ($(this).hasClass('minus') && currentVal > 1) {
            input.val(currentVal - 1);
        }
    });
    
    // Validar entrada manual
    $('.quantity-input').on('change', function() {
        var value = parseInt($(this).val());
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        
        if (value > max) {
            $(this).val(max);
        } else if (value < min) {
            $(this).val(min);
        } else if (isNaN(value)) {
            $(this).val(min);
        }
    });
    
    // Añadir al carrito
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var productId = button.data('id');
        var quantity = parseInt($('.quantity-input').val());
        
        // Deshabilitar el botón para evitar múltiples clics
        button.prop('disabled', true);
        button.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Agregando...');
        
        // Construir la URL correctamente
        var url = '{{ url("/cart/add") }}/' + productId;
        
        // Mostrar mensaje de depuración
        console.log('URL de la petición:', url);
        console.log('ID del producto:', productId);
        console.log('Cantidad:', quantity);
        console.log('Token CSRF:', '{{ csrf_token() }}');
        
        // Realizar la petición AJAX
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity
            },
            success: function(response) {
                console.log('Respuesta del servidor:', response);
                
                // Verificar si la respuesta es exitosa
                if (response.success && response.cart_count !== undefined) {
                    // Actualizar el contador del carrito
                    $('.cart-count').text(response.cart_count).removeClass('d-none');
                    
                    // Mostrar notificación de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Producto añadido!',
                        text: 'El producto se ha añadido al carrito',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    // Mostrar mensaje de error si la respuesta no es exitosa
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'No se pudo agregar el producto al carrito',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al agregar al carrito:', error);
                button.html('<i class="fas fa-shopping-cart me-2"></i>Añadir al carrito');
                button.prop('disabled', false);
                
                var errorMessage = 'Ocurrió un error al agregar el producto al carrito';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            complete: function() {
                // Restaurar el botón
                button.html('<i class="fas fa-shopping-cart me-2"></i>Añadir al carrito');
                button.prop('disabled', false);
            }
        });
    });
});
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Contador de cantidad
        const minusBtn = document.querySelector('.btn-minus');
        const plusBtn = document.querySelector('.btn-plus');
        const quantityInput = document.querySelector('.quantity-input');
        
        if (minusBtn && plusBtn && quantityInput) {
            minusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });
            
            plusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
            });
        }
    });
</script>
@endpush