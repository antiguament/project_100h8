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

                @php
                    $preferences = [
                        'uno' => [
                            'titulo' => $product->preferencia_uno,
                            'opciones' => $product->opciones_preferencia_uno ?? [],
                            'max_selecciones' => $product->max_selecciones_uno ?? 1
                        ],
                        'dos' => [
                            'titulo' => $product->preferencia_dos,
                            'opciones' => $product->opciones_preferencia_dos ?? [],
                            'max_selecciones' => $product->max_selecciones_dos ?? 1
                        ],
                        'tres' => [
                            'titulo' => $product->preferencia_tres,
                            'opciones' => $product->opciones_preferencia_tres ?? [],
                            'max_selecciones' => $product->max_selecciones_tres ?? 1
                        ]
                    ];
                @endphp

                @if($product->preferencia_uno || $product->preferencia_dos || $product->preferencia_tres)
                <div class="preferences-section mb-4">
                    <h5 class="mb-3">Personaliza tu pedido</h5>
                    <div class="row g-4">
                        @foreach(['uno', 'dos', 'tres'] as $prefNum)
                            @if(!empty($preferences[$prefNum]['titulo']) && count($preferences[$prefNum]['opciones']) > 0)
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">
                                            {{ $preferences[$prefNum]['titulo'] }}
                                            <small class="text-muted">(Selecciona hasta {{ $preferences[$prefNum]['max_selecciones'] }})</small>
                                        </h6>
                                        <div class="preference-options" data-max-selections="{{ $preferences[$prefNum]['max_selecciones'] }}">
                                            @foreach($preferences[$prefNum]['opciones'] as $index => $opcion)
                                                @if(!empty(trim($opcion)))
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input preference-option" 
                                                           type="checkbox" 
                                                           name="preferencia_{{ $prefNum }}[]" 
                                                           value="{{ $opcion }}" 
                                                           id="pref-{{ $prefNum }}-{{ $index }}"
                                                           data-pref="{{ $prefNum }}">
                                                    <label class="form-check-label" for="pref-{{ $prefNum }}-{{ $index }}">
                                                        {{ $opcion }}
                                                    </label>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Acciones -->
                <form id="add-to-cart-form" class="w-100">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1" class="quantity-input">
                    
                    <!-- Selector de cantidad -->
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div class="quantity-selector d-flex align-items-center mb-2">
                            <button type="button" class="btn btn-outline-secondary quantity-btn minus">-</button>
                            <input type="number" class="form-control text-center quantity-display" value="1" min="1" max="{{ $product->stock }}" style="width: 70px;" readonly>
                            <button type="button" class="btn btn-outline-secondary quantity-btn plus">+</button>
                        </div>
                        
                        <!-- Botón de añadir al carrito -->
                        <button type="button" class="btn btn-primary px-4 mb-2 add-to-cart" 
                                data-id="{{ $product->id }}"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart me-2"></i>
                            {{ $product->stock > 0 ? 'Añadir al carrito' : 'Sin stock' }}
                        </button>
                    
                        <!-- Botón de lista de deseos (opcional) -->
                        <button type="button" class="btn btn-outline-secondary mb-2" title="Añadir a la lista de deseos">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </form>

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
        var container = $(this).closest('.quantity-selector');
        var display = container.find('.quantity-display');
        var hiddenInput = container.siblings('input[name="quantity"]');
        var currentVal = parseInt(display.val());
        var max = parseInt(display.attr('max'));
        
        if ($(this).hasClass('plus') && currentVal < max) {
            display.val(currentVal + 1);
            hiddenInput.val(currentVal + 1);
        } else if ($(this).hasClass('minus') && currentVal > 1) {
            display.val(currentVal - 1);
            hiddenInput.val(currentVal - 1);
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
    
    // Manejar la selección de opciones de preferencia
    $('.preference-option').on('change', function() {
        const prefNum = $(this).data('pref');
        const maxSelections = parseInt($(this).closest('.preference-options').data('max-selections'));
        const selectedCount = $(`input[name="preferencia_${prefNum}[]"]:checked`).length;
        
        // Si se supera el máximo de selecciones, desmarcar el último seleccionado
        if (selectedCount > maxSelections) {
            $(this).prop('checked', false);
            
            // Mostrar mensaje al usuario
            Swal.fire({
                icon: 'info',
                title: 'Límite de selecciones',
                text: `Solo puedes seleccionar hasta ${maxSelections} opción(es) para esta preferencia`,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
    
    // Manejar el botón de añadir al carrito
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        
        const button = $(this);
        const form = $('#add-to-cart-form');
        const formData = new FormData(form[0]);
        
        // Validar preferencias seleccionadas
        let hasPreferenceError = false;
        
        // Para cada grupo de preferencias
        $('.preference-options').each(function() {
            const prefNum = $(this).find('.preference-option').first().data('pref');
            const selectedOptions = $(`input[name="preferencia_${prefNum}[]"]:checked`);
            const minSelections = 1; // Mínimo 1 selección requerida
            const maxSelections = parseInt($(this).data('max-selections'));
            
            // Verificar si se ha seleccionado al menos una opción
            if (selectedOptions.length < minSelections) {
                const prefTitle = $(`h6:contains('${prefNum}')`).text().trim();
                
                Swal.fire({
                    icon: 'warning',
                    title: 'Selección requerida',
                    text: `Por favor selecciona al menos una opción para ${$(this).closest('.card').find('.card-title').text().split('(')[0].trim()}`,
                    confirmButtonText: 'Entendido'
                });
                
                hasPreferenceError = true;
                return false; // Salir del bucle each
            }
            
            // Verificar si se excede el máximo de selecciones
            if (selectedOptions.length > maxSelections) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Demasiadas selecciones',
                    text: `Solo puedes seleccionar hasta ${maxSelections} opción(es) para esta preferencia`,
                    confirmButtonText: 'Entendido'
                });
                
                hasPreferenceError = true;
                return false; // Salir del bucle each
            }
            
            // Agregar las opciones seleccionadas al formData
            const selectedValues = [];
            selectedOptions.each(function() {
                selectedValues.push($(this).val());
            });
            
            // Agregar las opciones seleccionadas como un array
            formData.delete(`preferencia_${prefNum}[]`); // Eliminar entradas anteriores
            selectedValues.forEach(value => {
                formData.append(`preferencia_${prefNum}[]`, value);
            });
        });
        
        // Si hay errores de validación, no continuar
        if (hasPreferenceError) {
            return false;
        }
        
        // Mostrar loading
        button.prop('disabled', true);
        button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Añadiendo...');
        
        // Obtener el ID del producto
        const productId = $('input[name="product_id"]').val();
        
        // Enviar la solicitud AJAX
        $.ajax({
            url: `/cart/add/${productId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Actualizar el contador del carrito
                if (typeof updateCartCount === 'function') {
                    updateCartCount(response.cart_count || response.cartCount);
                } else if (response.cart_count) {
                    $('.cart-count').text(response.cart_count);
                }
                
                // Mostrar notificación de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Producto añadido!',
                    text: response.message || 'El producto se ha añadido a tu carrito',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                
                // Resetear el formulario
                form.trigger('reset');
                $('.quantity-display').val(1);
                $('.quantity-input').val(1);
                $('.preference-option').prop('checked', false);
            },
            error: function(xhr) {
                let errorMessage = 'Ha ocurrido un error al agregar el producto al carrito';
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage = Object.values(errors)[0][0];
                } else if (xhr.status === 401) {
                    errorMessage = 'Debes iniciar sesión para agregar productos al carrito';
                    window.location.href = '{{ route('login') }}';
                    return;
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: 'Entendido'
                });
            },
            complete: function() {
                // Restaurar el botón
                button.prop('disabled', false);
                button.html('<i class="fas fa-shopping-cart me-2"></i> Añadir al carrito');
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