@extends('layouts.app-custom')

@section('title', 'Título de la página')

@section('content')
    <!-- Tu contenido aquí -->
    <div class="container py-5">
    <a href="{{ route('vista-1') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver a categorías
    </a>
    
    <div class="category-header">
        <h1 class="section-title">{{ $category->name }}</h1>
        @if($category->description)
            <p class="lead">{{ $category->description }}</p>
        @endif
    </div>
    
    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <div class="product-image bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-box-open fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="product-price">${{ number_format($product->price, 2) }}</div>
                        @if($product->description)
                            <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                        @endif
                        <a href="{{ route('producto.detalle', $product->id) }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-products">
            <i class="fas fa-inbox fa-4x mb-3"></i>
            <h3>No hay productos disponibles en esta categoría</h3>
            <p class="text-muted">Pronto agregaremos nuevos productos.</p>
        </div>
    @endif
</div>




@endsection

@push('styles')
    <!-- Estilos específicos de la página -->
    <style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem 0;
    }
    
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    
    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .product-info {
        padding: 1.5rem;
    }
    
    .product-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }
    
    .product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0d6efd;
        margin: 0.5rem 0;
    }
    
    .product-description {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        margin-bottom: 2rem;
        color: #0d6efd;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .back-button:hover {
        color: #0a58ca;
        text-decoration: none;
    }
    
    .back-button i {
        margin-right: 0.5rem;
    }
    
    .category-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }
    
    .no-products {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }
</style>
@endpush

@push('scripts')
    <script>
        // Scripts específicos de la página
        function pageInit() {
            // Código que se ejecutará cuando la página esté lista
        }
    </script>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


@endpush

