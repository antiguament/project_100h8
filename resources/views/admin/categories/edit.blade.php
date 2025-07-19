@extends('adminlte::page')

@section('title', 'Editar Categoría')

@push('css')
    <style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
        .current-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content_header')
    <h1>Editar Categoría: {{ $category->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nombre de la categoría</label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Imagen de la categoría</label>
                    
                    @if($category->image_url)
                        <div class="mb-2">
                            <p>Imagen actual:</p>
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="current-image img-thumbnail" style="max-width: 200px;">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                <label class="form-check-label" for="remove_image">
                                    Eliminar imagen actual
                                </label>
                            </div>
                        </div>
                    @endif
                    
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                        <label class="custom-file-label" for="image">Cambiar imagen (hasta 50MB)</label>
                        <small class="form-text text-muted">Formatos permitidos: .jpg, .jpeg, .png, .gif, .webp - Tamaño máximo: 50MB</small>
                        @error('image')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div id="file-size-warning" class="text-warning small mt-1 d-none">
                            <i class="fas fa-exclamation-triangle"></i> El archivo es grande, la subida puede tardar unos segundos...
                        </div>
                    </div>
                    <div class="mt-2" id="image-preview"></div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" class="custom-control-input" id="is_active" 
                               name="is_active" value="1" 
                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Activo</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@stop

@section('js')
    <script>
        // Código JavaScript personalizado si es necesario
    </script>
@stop
