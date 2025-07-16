@extends('adminlte::page')

@section('title', 'Detalles del Producto: ' . $product->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles del Producto: {{ $product->name }}</h1>
        <div>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($product->image)
                        <img src="{{ route('product.image', ['filename' => basename($product->image)]) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded" 
                             style="max-height: 300px;"
                             onerror="this.onerror=null; this.src='{{ asset('storage/' . $product->image) }}';">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 300px; width: 100%;">
                            <span class="text-muted">Sin imagen</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p class="text-muted">
                        <i class="fas fa-tag mr-2"></i> {{ $product->category->name }}
                    </p>
                    
                    <div class="mb-4">
                        <h4>Precio: ${{ number_format($product->price, 2) }}</h4>
                        <p class="mb-1">
                            <strong>Stock disponible:</strong> {{ $product->stock }} unidades
                        </p>
                        <p class="mb-1">
                            <strong>Estado:</strong>
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </p>
                        <p class="mb-1">
                            <strong>Creado:</strong> {{ $product->created_at->format('d/m/Y H:i') }}
                        </p>
                        <p class="mb-0">
                            <strong>Actualizado:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @if($product->description)
                        <div class="border-top pt-3">
                            <h5>Descripción</h5>
                            <p class="mb-0">{{ $product->description }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer d-flex justify-content-between">
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                            <i class="fas fa-trash"></i> Eliminar Producto
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar Producto
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            margin-bottom: 1.5rem;
        }
        .card-title {
            color: #333;
            margin-bottom: 1rem;
        }
        .text-muted {
            color: #6c757d !important;
        }
        .border-top {
            border-top: 1px solid #dee2e6 !important;
        }
    </style>
@stop
