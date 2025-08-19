@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Category Header -->
    <div class="category-header mb-5 text-center">
        <h1 class="display-4 font-weight-bold">{{ $category->name }}</h1>
        @if($category->description)
            <p class="lead text-muted">{{ $category->description }}</p>
        @endif
    </div>

    <!-- Products Grid -->
    @if($category->products->count() > 0)
        <div class="row">
            @foreach($category->products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="text-center py-5 bg-light">
                                <i class="fas fa-image fa-4x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 text-primary">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('producto.detalle', $product->id) }}" class="btn btn-outline-primary">Ver detalle</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-box-open fa-4x text-muted"></i>
            </div>
            <h3>No hay productos disponibles en esta categoría</h3>
            <p class="text-muted">Pronto agregaremos más productos.</p>
            <a href="{{ route('welcome') }}" class="btn btn-primary mt-3">
                <i class="fas fa-arrow-left me-2"></i> Volver al inicio
            </a>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .category-header {
        padding: 3rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        margin-bottom: 2rem;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .card-img-top {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .btn-outline-primary {
        border-width: 2px;
        font-weight: 500;
    }
</style>
@endpush
