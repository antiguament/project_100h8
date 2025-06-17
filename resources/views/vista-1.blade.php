@extends('layouts.app-custom')

@section('title', 'Título de la página')

@section('content')
    <!-- Tu contenido aquí -->

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Explora Nuestro Catálogo</h1>
            <p class="hero-subtitle">Descubre nuestras categorías y encuentra exactamente lo que necesitas</p>
            
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Buscar categorías...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<div class="container">
    <div class="section-header">
        <h2 class="section-title">Nuestras Categorías</h2>
        <p class="section-subtitle">Explora nuestra amplia selección de categorías cuidadosamente seleccionadas para ti</p>
    </div>
    
    @if($categories->count() > 0)
        <div class="category-grid">
            @foreach($categories as $category)
                <div class="category-card">
                    <button class="category-btn" onclick="window.location.href='{{ route('categoria.productos', $category->id) }}'">
                        <div class="category-icon">
                            @php
                                // Diferentes iconos según el índice para variedad
                                $icons = ['fa-box', 'fa-tshirt', 'fa-laptop', 'fa-headphones', 'fa-home', 'fa-book', 'fa-futbol', 'fa-couch'];
                                $icon = $icons[$loop->index % count($icons)] ?? 'fa-box';
                            @endphp
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <h3 class="category-title">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="category-desc">{{ $category->description }}</p>
                        @else
                            <p class="category-desc">Explora nuestra selección de productos en esta categoría.</p>
                        @endif
                        <span class="category-link">
                            Ver productos <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-categories">
            <i class="fas fa-inbox"></i>
            <h3>No hay categorías disponibles</h3>
            <p>Lo sentimos, actualmente no hay categorías disponibles. Por favor, vuelve más tarde.</p>
        </div>
    @endif
</div>





@endsection

@push('styles')
    <!-- Estilos específicos de la página -->
    <style>
        /* Tus estilos personalizados */

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --secondary: #3f37c9;
        --dark: #1a1a2e;
        --light: #f8f9fa;
        --gradient: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7ff;
        color: #333;
    }
    
    .hero-section {
        background: var(--gradient);
        color: white;
        padding: 4rem 0;
        margin-bottom: 3rem;
        border-radius: 0 0 30px 30px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29-22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }
    
    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 300;
        margin-bottom: 2rem;
        opacity: 0.9;
    }
    
    .search-box {
        max-width: 600px;
        margin: 0 auto 2rem;
        position: relative;
    }
    
    .search-input {
        width: 100%;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        border: none;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(67, 97, 238, 0.2);
        padding-right: 50px;
    }
    
    .search-btn {
        position: absolute;
        right: 5px;
        top: 5px;
        background: var(--gradient);
        border: none;
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        transform: scale(1.05);
    }
    
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem 0;
    }
    
    .category-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .category-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.15);
    }
    
    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .category-card:hover::before {
        opacity: 1;
    }
    
    .category-btn {
        width: 100%;
        padding: 2rem;
        text-align: left;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .category-icon {
        width: 70px;
        height: 70px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        color: var(--primary);
        transition: all 0.3s ease;
    }
    
    .category-card:hover .category-icon {
        background: var(--gradient);
        color: white;
        transform: rotate(5deg) scale(1.1);
    }
    
    .category-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--dark);
        transition: color 0.3s ease;
    }
    
    .category-desc {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        flex-grow: 1;
    }
    
    .category-link {
        display: inline-flex;
        align-items: center;
        color: var(--primary);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .category-link i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }
    
    .category-card:hover .category-link {
        color: var(--secondary);
    }
    
    .category-card:hover .category-link i {
        transform: translateX(5px);
    }
    
    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 3rem;
        font-weight: 700;
        color: var(--dark);
        font-size: 2.2rem;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 5px;
        background: var(--gradient);
        bottom: -15px;
        left: 0;
        border-radius: 3px;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .section-subtitle {
        color: #6c757d;
        font-size: 1.15rem;
        max-width: 700px;
        margin: 0 auto 2rem;
        line-height: 1.6;
    }
    
    .no-categories {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin: 2rem 0;
    }
    
    .no-categories i {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }
    
    .no-categories h3 {
        color: var(--dark);
        margin-bottom: 1rem;
    }
    
    .no-categories p {
        color: #6c757d;
        max-width: 500px;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.2rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .category-grid {
            grid-template-columns: 1fr;
        }
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


<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Smooth scrolling -->
<script>
    // Suavizar el desplazamiento al hacer clic en enlaces
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Funcionalidad de búsqueda
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-input');
        const categoryCards = document.querySelectorAll('.category-card');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            categoryCards.forEach(card => {
                const title = card.querySelector('.category-title').textContent.toLowerCase();
                const desc = card.querySelector('.category-desc').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || desc.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>


@endpush