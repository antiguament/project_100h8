@extends('adminlte::page')

@section('title', 'Subir Imágenes a la Galería')

@section('content_header')
    <h1>Subir Imágenes a la Galería</h1>
@stop

@section('content')
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
            <form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Seleccionar imágenes</label>
                    <input type="file" name="files[]" class="form-control" accept="image/*" multiple required>
                    <small class="text-muted">Formatos permitidos: jpeg, png, jpg, gif, webp, svg. Máximo 5MB por imagen.</small>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                    <label class="form-check-label" for="is_active">Marcar como activas</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Subir</button>
                    <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop
