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
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 100px;">
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
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("image").files[0]?.name || 'Seleccionar archivo';
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@endpush
