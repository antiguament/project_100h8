@extends('layouts.app-custom')

@section('title', 'Catálogo de Categorías')

@section('content')
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
            
            <div class="mt-4">
                <a href="../" class="btn btn-outline-light">
                    <i class="fas fa-home me-2"></i> Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Componente de Categorías -->
<x-categorias :categories="$categories" />
@endsection

@push('styles')
<style>
    /* Estilos base consistentes con la identidad Allaletera */
    :root {
        --color-primary: #E63946;
        --color-primary-light: #F28482;
        --color-secondary: #F4A261;
        --color-accent: #2A9D8F;
        --color-dark: #264653;
        --color-light: #F8F9FA;
        --color-text: #333333;
        --color-gray: #6C757D;
        --color-gray-light: #E9ECEF;
        --gradient-primary: linear-gradient(135deg, #E63946 0%, #C1121F 100%);
    }

    /* Hero Section adaptado */
    .hero-section {
        background: var(--gradient-primary);
        color: white;
        padding: 5rem 0;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;
        opacity: 0.15;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 400;
        margin-bottom: 2rem;
        opacity: 0.9;
        color: white;
    }

    /* Search Box mejorado */
    .search-box {
        max-width: 600px;
        margin: 0 auto;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        border: none;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .search-btn {
        position: absolute;
        right: 8px;
        top: 8px;
        background: var(--color-dark);
        border: none;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: var(--color-primary);
        transform: scale(1.05);
    }

    /* Sección de categorías */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--color-dark);
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--gradient-primary);
        border-radius: 2px;
    }

    .section-subtitle {
        color: var(--color-gray);
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Grid de categorías */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 1rem 0;
    }

    .category-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(230, 57, 70, 0.15);
    }

    .category-btn {
        width: 100%;
        padding: 2rem;
        border: none;
        background: transparent;
        cursor: pointer;
        text-align: left;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .category-icon {
        width: 120px;
        height: 120px;
        background-color: #f8f9fa;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--color-primary);
        font-size: 36px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .category-btn:hover .category-icon {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .category-card:hover .category-icon {
        background: var(--gradient-primary);
        color: white;
    }

    .category-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--color-dark);
    }

    .category-desc {
        color: var(--color-gray);
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        flex-grow: 1;
    }

    .category-link {
        display: inline-flex;
        align-items: center;
        color: var(--color-primary);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .category-link i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .category-card:hover .category-link {
        color: var(--color-secondary);
    }

    .category-card:hover .category-link i {
        transform: translateX(5px);
    }

    /* Estado cuando no hay categorías */
    .no-categories {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin: 2rem 0;
    }

    .no-categories i {
        font-size: 3rem;
        color: var(--color-primary);
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .no-categories h3 {
        color: var(--color-dark);
        margin-bottom: 1rem;
    }

    .no-categories p {
        color: var(--color-gray);
        max-width: 500px;
        margin: 0 auto;
    }

    /* Responsive Design */
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

    @media (max-width: 480px) {
        .hero-section {
            padding: 3rem 1rem;
        }
        
        .hero-title {
            font-size: 1.8rem;
        }
        
        .search-box {
            padding: 0 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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