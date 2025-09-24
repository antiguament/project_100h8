@extends('adminlte::page')

@section('title', 'Galería de Imágenes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Galería de Imágenes</h1>
        <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-primary">
            <i class="fas fa-upload"></i> Subir Imágenes
        </a>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($images->count() === 0)
                <p class="text-center m-0">Aún no hay imágenes en la galería.</p>
            @else
                <div class="row">
                    @foreach($images as $image)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                            <div class="card h-100">
                                <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                    @if($image->file_path)
                                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text ?? $image->title ?? 'Imagen' }}" class="img-fluid" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </div>
                                <div class="card-body p-2">
                                    <small class="d-block text-truncate" title="{{ $image->title ?? 'Sin título' }}">{{ $image->title ?? 'Sin título' }}</small>
                                    <span class="badge {{ $image->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $image->is_active ? 'Activo' : 'Inactivo' }}</span>
                                </div>
                                <div class="card-footer p-2 d-flex gap-1">
                                    <a href="{{ route('admin.gallery-images.edit', $image) }}" class="btn btn-sm btn-warning me-1 w-100"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.gallery-images.destroy', $image) }}" method="POST" class="w-100" onsubmit="return confirm('¿Eliminar esta imagen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $images->links() }}
                </div>
            @endif
        </div>
    </div>
@stop

@section('css')
    <style>
        .ratio-1x1 { aspect-ratio: 1 / 1; overflow: hidden; }
        .ratio-1x1 img { width: 100%; height: 100%; object-fit: cover; }
    </style>
@stop
