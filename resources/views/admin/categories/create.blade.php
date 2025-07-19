@extends('adminlte::page')

@section('title', 'Crear Nueva Categoría')

@push('css')
    <style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
    </style>
@endpush

@section('content_header')
    <h1>Crear Nueva Categoría</h1>
@stop

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nombre de la categoría</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Imagen de la categoría</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                        <label class="custom-file-label" for="image">Elegir archivo (hasta 50MB)</label>
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
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Activo</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
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
        // Generar automáticamente el slug cuando se escribe el nombre
        document.getElementById('name').addEventListener('input', function() {
            const slugInput = document.getElementById('slug');
            if (slugInput) {
                const slug = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^[-\s]+|[-\s]+$/g, '');
                slugInput.value = slug;
            }
        });

        // Manejar la vista previa de la imagen
        document.getElementById('image').addEventListener('change', function(e) {
            const fileInput = this;
            const file = fileInput.files[0];
            const previewContainer = document.getElementById('image-preview');
            const fileSizeWarning = document.getElementById('file-size-warning');
            
            // Limpiar vista previa anterior
            previewContainer.innerHTML = '';
            
            // Mostrar advertencia para archivos grandes (>5MB)
            if (file && file.size > 5 * 1024 * 1024) {
                fileSizeWarning.classList.remove('d-none');
            } else {
                fileSizeWarning.classList.add('d-none');
            }
            
            // Mostrar vista previa si se seleccionó un archivo
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid img-thumbnail mt-2';
                    img.style.maxHeight = '200px';
                    previewContainer.appendChild(img);
                };
                
                reader.readAsDataURL(file);
            }
        });

        // Actualizar etiqueta del archivo seleccionado
        document.querySelector('.custom-file-input').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Elegir archivo (hasta 20MB)';
            const label = this.nextElementSibling;
            label.textContent = fileName;
        });
    </script>
@stop
