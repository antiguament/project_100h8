@extends('adminlte::page')

@section('title', 'Editar Imagen de la Galería')

@section('content_header')
    <h1>Editar Imagen</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="ratio ratio-1x1 bg-light mb-3 d-flex align-items-center justify-content-center">
                        @if($image->file_path)
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text ?? 'Vista previa' }}" class="img-fluid" style="object-fit:cover; width:100%; height:100%;">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('admin.gallery-images.update', $image) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $image->title) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Texto alternativo (alt)</label>
                            <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text', $image->alt_text) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $image->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Orden</label>
                            <input type="number" name="ordering" class="form-control" value="{{ old('ordering', $image->ordering) }}" min="0">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active', $image->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Activa</label>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Reemplazar imagen (opcional)</label>
                            <input type="file" name="file" class="form-control" accept="image/*">
                            <small class="text-muted">Máximo 5MB. Formatos: jpeg, png, jpg, gif, webp, svg.</small>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="remove_image" name="remove_image">
                            <label class="form-check-label" for="remove_image">Eliminar imagen actual</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar cambios</button>
                            <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .ratio-1x1 { aspect-ratio: 1 / 1; }
    </style>
@stop
