@extends('adminlte::page')

@section('title', 'Editar Producto: ' . $product->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Producto: {{ $product->name }}</h1>
        <div>
            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info mr-2">
                <i class="fas fa-eye"></i> Ver
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre del Producto *</label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Categoría *</label>
                            <select name="category_id" id="category_id" 
                                    class="form-control @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Precio *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="price" id="price" step="0.01" min="0"
                                       class="form-control @error('price') is-invalid @enderror" 
                                       value="{{ old('price', $product->price) }}" required>
                            </div>
                            @error('price')
                                <span class="text-danger" style="font-size: 0.875em;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock">Stock *</label>
                            <input type="number" name="stock" id="stock" min="0"
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock', $product->stock) }}" required>
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Imagen del Producto</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ route('product.image', ['filename' => basename($product->image)]) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 100px;"
                                         onerror="this.onerror=null; this.src='{{ asset('storage/' . $product->image) }}';">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="remove_image" id="remove_image" 
                                               class="form-check-input">
                                        <label class="form-check-label" for="remove_image">
                                            Eliminar imagen
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <div class="custom-file">
                                <input type="file" name="image" id="image" 
                                       class="custom-file-input @error('image') is-invalid @enderror" 
                                       accept="image/*">
                                <label class="custom-file-label" for="image">
                                    {{ $product->image ? 'Cambiar archivo' : 'Seleccionar archivo' }}
                                </label>
                            </div>
                            <small class="form-text text-muted">Formatos: jpeg, png, jpg, gif, svg. Máx: 2MB</small>
                            @error('image')
                                <span class="text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" 
                                       name="is_active" value="1" 
                                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Producto activo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" rows="3" 
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @php
                    $preferencias = [
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

                @foreach(['uno', 'dos', 'tres'] as $prefNum)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Preferencia {{ ucfirst($prefNum) }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="preferencia_{{ $prefNum }}">Título de la Preferencia</label>
                                    <input type="text" name="preferencia_{{ $prefNum }}" id="preferencia_{{ $prefNum }}" 
                                           class="form-control @error('preferencia_'.$prefNum) is-invalid @enderror" 
                                           value="{{ old('preferencia_'.$prefNum, $preferencias[$prefNum]['titulo']) }}"
                                           placeholder="Ej: Toppings, Ingredientes, etc.">
                                    @error('preferencia_'.$prefNum)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_selecciones_{{ $prefNum }}">Máximo de opciones seleccionables</label>
                                    <select name="max_selecciones_{{ $prefNum }}" id="max_selecciones_{{ $prefNum }}" 
                                            class="form-control @error('max_selecciones_'.$prefNum) is-invalid @enderror">
                                        @for($i = 1; $i <= 3; $i++)
                                            <option value="{{ $i }}" {{ old('max_selecciones_'.$prefNum, $preferencias[$prefNum]['max_selecciones']) == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i == 1 ? 'opción' : 'opciones' }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('max_selecciones_'.$prefNum)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Opciones de {{ strtolower($prefNum) == 'uno' ? 'la' : 'la' }} preferencia</label>
                            <small class="form-text text-muted mb-2 d-block">
                                Agregue las opciones que estarán disponibles para esta preferencia.
                            </small>
                            
                            <div id="opciones-container-{{ $prefNum }}">
                                @php
                                    $oldValues = old('opciones_preferencia_'.$prefNum, $preferencias[$prefNum]['opciones']);
                                    // Asegurarse de que siempre haya al menos 3 campos de opción
                                    while(count($oldValues) < 3) {
                                        $oldValues[] = '';
                                    }
                                @endphp
                                
                                @foreach($oldValues as $index => $opcion)
                                    <div class="input-group mb-2">
                                        <input type="text" 
                                               name="opciones_preferencia_{{ $prefNum }}[]" 
                                               class="form-control" 
                                               value="{{ $opcion }}"
                                               placeholder="Opción {{ $index + 1 }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary remove-option" type="button" data-pref="{{ $prefNum }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <button type="button" class="btn btn-sm btn-outline-primary add-option mt-2" data-pref="{{ $prefNum }}">
                                <i class="fas fa-plus"></i> Agregar opción
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('js')
    <script>
        // Mostrar el nombre del archivo seleccionado
        document.getElementById('image')?.addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : 'Ningún archivo seleccionado';
            var nextSibling = e.target.nextElementSibling;
            if (nextSibling) {
                nextSibling.innerText = fileName;
            }
        });

        // Función para agregar una nueva opción a una preferencia
        function addOption(pref) {
            const container = document.getElementById(`opciones-container-${pref}`);
            const optionCount = container.querySelectorAll('input[type="text"]').length;
            
            if (optionCount >= 10) {
                alert('No se pueden agregar más de 10 opciones por preferencia');
                return;
            }
            
            const newOption = document.createElement('div');
            newOption.className = 'input-group mb-2';
            newOption.innerHTML = `
                <input type="text" 
                       name="opciones_preferencia_${pref}[]" 
                       class="form-control" 
                       placeholder="Opción ${optionCount + 1}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary remove-option" type="button" data-pref="${pref}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            container.appendChild(newOption);
            
            // Agregar evento al nuevo botón de eliminar
            newOption.querySelector('.remove-option').addEventListener('click', function() {
                removeOption(this);
            });
        }
        
        // Función para eliminar una opción
        function removeOption(button) {
            const container = button.closest('.input-group');
            if (container) {
                container.remove();
                // Renumerar las opciones restantes
                const pref = button.dataset.pref;
                const inputs = document.querySelectorAll(`#opciones-container-${pref} input[type="text"]`);
                inputs.forEach((input, index) => {
                    input.placeholder = `Opción ${index + 1}`;
                });
            }
        }
        
        // Agregar eventos a los botones existentes al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Botones para agregar opciones
            document.querySelectorAll('.add-option').forEach(button => {
                button.addEventListener('click', function() {
                    const pref = this.dataset.pref;
                    addOption(pref);
                });
            });
            
            // Botones para eliminar opciones
            document.querySelectorAll('.remove-option').forEach(button => {
                button.addEventListener('click', function() {
                    removeOption(this);
                });
            });
            
            // Validar opciones al enviar el formulario
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    
                    // Validar que al menos una opción tenga un título
                    const hasTitle = ['uno', 'dos', 'tres'].some(pref => {
                        const title = document.getElementById(`preferencia_${pref}`)?.value.trim();
                        return title && title.length > 0;
                    });
                    
                    if (!hasTitle) {
                        // Si no hay títulos, no es necesario validar las opciones
                        return true;
                    }
                    
                    // Validar cada preferencia
                    ['uno', 'dos', 'tres'].forEach(pref => {
                        const title = document.getElementById(`preferencia_${pref}`)?.value.trim();
                        const container = document.getElementById(`opciones-container-${pref}`);
                        
                        if (title && title.length > 0 && container) {
                            const inputs = container.querySelectorAll('input[type="text"]');
                            const hasOptions = Array.from(inputs).some(input => input.value.trim() !== '');
                            
                            if (!hasOptions) {
                                alert(`La preferencia "${title}" debe tener al menos una opción.`);
                                isValid = false;
                                e.preventDefault();
                                return false;
                            }
                        }
                        return true;
                    });
                    
                    return isValid;
                });
            }
        });
    </script>
@endpush
