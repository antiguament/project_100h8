<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Nuestros Productos</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Descubre nuestra selección premium de productos organizados por categorías. Cada producto está diseñado para ofrecerte la mejor experiencia gourmet.</p>
    </div>

    <!-- Sección de Productos -->
    <div id="products-section" class="pt-8">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Productos en <span id="active-category-title" class="text-violet-600">{{ $category->name ?? 'Todas las categorías' }}</span></h2>
        <p id="products-message" class="text-center text-gray-500 mb-8">{{ $products->count() > 0 ? 'Mostrando ' . $products->count() . ' producto(s) disponible(s).' : 'No hay productos disponibles en esta categoría.' }}</p>

        @if($products->count() > 0)
            <div id="products-display" class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-box-open fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="product-content">
                            <p class="text-xs font-semibold text-gray-500 uppercase">{{ $product->category->name }}</p>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            @if($product->description)
                                <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                            @endif
                            <div class="flex justify-between items-center mt-4">
                                <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-violet-600 hover:bg-violet-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-lg shadow-violet-500/50 text-sm">
                                        <i class="fas fa-shopping-cart mr-1"></i> Agregar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <i class="fas fa-inbox fa-4x mb-3"></i>
                <h3>No hay productos disponibles</h3>
                <p class="text-muted">Lo sentimos, actualmente no hay productos disponibles en esta categoría. Por favor, vuelve más tarde.</p>
            </div>
        @endif
    </div>
</div>

<style>
    :root {
        --color-vip-gold: #FFD700;
        --color-vip-dark: #0A0A1F;
        --color-vip-accent: #1A1A3A;
        --color-primary: #10B981;
        --color-primary-dark: #059669;
        --color-secondary: #F59E0B;
        --color-accent: #8B5CF6;
        --color-dark: #1F2937;
        --color-light: #F9FAFB;
        --gradient-primary: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
        --gradient-premium: linear-gradient(135deg, var(--color-primary), var(--color-accent));
        --gradient-vip: linear-gradient(135deg, var(--color-vip-gold), #FFA500);
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--color-light);
        color: var(--color-dark);
    }

    /* Grid de productos */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 1rem 0;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(139, 92, 246, 0.15);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-content {
        padding: 1.5rem;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--color-dark);
        margin-bottom: 0.5rem;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--color-accent);
        margin-top: 1rem;
    }

    /* Estado cuando no hay productos */
    .no-products {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin: 2rem 0;
        grid-column: 1 / -1;
    }

    .no-products i {
        font-size: 3rem;
        color: var(--color-primary);
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .no-products h3 {
        color: var(--color-dark);
        margin-bottom: 1rem;
    }

    .no-products p {
        color: #6B7280;
        max-width: 500px;
        margin: 0 auto;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
        }

        .product-image {
            height: 150px;
        }
    }
</style>
