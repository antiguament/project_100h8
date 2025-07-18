<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($page) && $page->meta_title)
        <title>{{ $page->meta_title }}</title>
    @else
        <title>Allaletera | Gourmet Delivery - San Carlos, Antioquia</title>
    @endif
    
    @if(isset($page) && $page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @else
        <meta name="description" content="Propuesta gastronómica innovadora que celebra los sabores tradicionales de San Carlos, Antioquia.">
    @endif
    
    @if(isset($page) && $page->meta_keywords)
        <meta name="keywords" content="{{ $page->meta_keywords }}">
    @else
        <meta name="keywords" content="comida, restaurante, delivery, San Carlos, Antioquia, gastronomía">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        :root {
            --color-primary: #E63946; /* Rojo vibrante */
            --color-primary-dark: #C1121F;
            --color-secondary: #F4A261; /* Naranja terroso */
            --color-accent: #2A9D8F; /* Verde azulado */
            --color-dark: #264653; /* Azul oscuro */
            --color-light: #F8F9FA;
            --color-text: #333333;
            --color-gray: #6C757D;
            --color-gray-light: #E9ECEF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--color-light);
            color: var(--color-text);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* Header */
        header {
            padding: 1.5rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--color-primary);
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
        }
        
        .logo span {
            color: var(--color-dark);
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--color-dark);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            transition: color 0.3s ease;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--color-primary);
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .nav-links a:hover {
            color: var(--color-primary);
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.75rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--color-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
        }
        
        .btn-primary:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 57, 70, 0.4);
        }
        
        .btn-secondary {
            background-color: var(--color-secondary);
            color: white;
            box-shadow: 0 4px 15px rgba(244, 162, 97, 0.3);
        }
        
        .btn-secondary:hover {
            background-color: #E76F51;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(244, 162, 97, 0.4);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--color-primary);
            color: var(--color-primary);
        }
        
        .btn-outline:hover {
            background-color: var(--color-primary);
            color: white;
        }
        
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        /* Hero Section */
        .hero {
            padding: 6rem 0 4rem;
            text-align: center;
            background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), 
                        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.7);
            z-index: 0;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--color-dark);
        }
        
        .hero h1 span {
            color: var(--color-primary);
        }
        
        .hero p {
            font-size: 1.25rem;
            color: var(--color-dark);
            max-width: 700px;
            margin: 0 auto 2.5rem;
            font-weight: 500;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        /* Features Section */
        .features {
            padding: 5rem 0;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--color-dark);
            margin-bottom: 1rem;
        }
        
        .section-title p {
            color: var(--color-gray);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--color-gray-light);
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(244, 162, 97, 0.1);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            color: var(--color-secondary);
            font-size: 2rem;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--color-dark);
        }
        
        .feature-card p {
            color: var(--color-gray);
        }
        
        /* Specialties Section */
        .specialties {
            padding: 5rem 0;
            background-color: var(--color-light);
        }
        
        .specialties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .specialty-card {
            background-color: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            position: relative;
        }
        
        .specialty-card:hover {
            transform: translateY(-5px);
        }
        
        .specialty-img {
            height: 200px;
            overflow: hidden;
        }
        
        .specialty-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .specialty-card:hover .specialty-img img {
            transform: scale(1.1);
        }
        
        .specialty-content {
            padding: 1.5rem;
        }
        
        .specialty-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: var(--color-primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .specialty-content h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--color-dark);
        }
        
        .specialty-content p {
            color: var(--color-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .specialty-price {
            font-weight: 700;
            color: var(--color-primary);
            font-size: 1.25rem;
        }
        
        /* Testimonials */
        .testimonials {
            padding: 5rem 0;
            background-color: var(--color-dark);
            color: white;
        }
        
        .testimonials .section-title h2,
        .testimonials .section-title p {
            color: white;
        }
        
        .testimonial-card {
            background-color: rgba(255,255,255,0.1);
            border-radius: 1rem;
            padding: 2rem;
            margin: 0 1rem;
            text-align: center;
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .testimonial-text::before,
        .testimonial-text::after {
            content: '"';
            font-size: 2rem;
            color: var(--color-secondary);
            opacity: 0.5;
        }
        
        .testimonial-author {
            font-weight: 600;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 5rem 0;
            text-align: center;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            color: white;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .cta-section p {
            max-width: 600px;
            margin: 0 auto 2rem;
            font-size: 1.1rem;
        }
        
        /* Footer */
        footer {
            padding: 3rem 0 1.5rem;
            background-color: var(--color-dark);
            color: white;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: var(--color-secondary);
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 0.75rem;
        }
        
        .footer-column ul li a {
            color: var(--color-gray-light);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .footer-column ul li a:hover {
            color: var(--color-secondary);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background-color: var(--color-secondary);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: var(--color-gray-light);
            font-size: 0.9rem;
        }
        
        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background-color: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
            z-index: 99;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .whatsapp-float:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        }
        
        /* Estilos para el menú móvil */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: 2px solid var(--color-primary);
            border-radius: 4px;
            font-size: 1.8rem;
            color: var(--color-primary);
            cursor: pointer;
            padding: 0.5rem 0.8rem;
            z-index: 1001;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }
        
        .mobile-menu-btn:hover {
            background-color: var(--color-primary);
            color: white;
        }
        
        .close-menu-btn {
            display: none;
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: white;
            cursor: pointer;
            z-index: 1002;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            /* Estilos para el menú móvil */
            .mobile-menu-btn {
                display: block !important;
                transition: all 0.3s ease;
            }
            
            .mobile-menu-btn:active {
                transform: scale(0.95);
                opacity: 0.8;
            }
            
            .nav-links {
                display: none;
                position: fixed;
                top: 0;
                right: 0;
                width: 85%;
                max-width: 320px;
                height: 100vh;
                background-color: white;
                flex-direction: column;
                padding: 4.5rem 1.5rem 2rem;
                z-index: 1000;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                box-shadow: -5px 0 25px rgba(0, 0, 0, 0.12);
                transform: translateX(100%);
                transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
                will-change: transform;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
                touch-action: pan-y;
            }
            
            .nav-links.active {
                transform: translateX(0);
                display: flex;
                pointer-events: auto;
            }
            
            /* Scrollbar personalizada para navegadores webkit */
            .nav-links::-webkit-scrollbar {
                width: 4px;
            }
            
            .nav-links::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.02);
            }
            
            .nav-links::-webkit-scrollbar-thumb {
                background-color: rgba(0, 0, 0, 0.1);
                border-radius: 4px;
            }
            
            .nav-links.active {
                display: flex !important;
                transform: translateX(0);
            }
            
            .nav-links a {
                color: var(--color-dark) !important;
                padding: 1.25rem 1.5rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.03);
                text-align: left;
                display: block;
                font-size: 1.1rem;
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
                position: relative;
                width: 100%;
                margin: 0;
                border-radius: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                cursor: pointer;
                -webkit-tap-highlight-color: rgba(0,0,0,0.1);
                touch-action: manipulation;
            }
            
            /* Mejorar la accesibilidad en dispositivos táctiles */
            @media (hover: none) {
                .nav-links a:active {
                    background-color: rgba(230, 57, 70, 0.05);
                    transform: translateX(5px);
                }
            }
            
            /* Efecto de retroalimentación táctil */
            .nav-links a.touch-active,
            .nav-links a:active {
                background-color: rgba(230, 57, 70, 0.08) !important;
                transform: translateX(8px) !important;
                transition: transform 0.15s ease, background-color 0.15s ease !important;
            }
            
            .nav-links a.active {
                background-color: rgba(230, 57, 70, 0.1) !important;
                color: var(--color-primary) !important;
                transform: translateX(8px);
            }
            
            /* Estilos para botones dentro del menú */
            .nav-links .btn {
                display: inline-block;
                margin: 0.5rem 0;
                text-align: center;
                -webkit-tap-highlight-color: rgba(0,0,0,0.1);
                touch-action: manipulation;
            }
            
            /* Asegurar que los enlaces sean visibles y accesibles */
            .nav-links a[href]:not([href="#"]) {
                position: relative;
                z-index: 1;
            }
            
            .nav-links a::after {
                display: none; /* Desactivar el subrayado animado en móvil */
            }
            
            .nav-links a:active,
            .nav-links a:focus,
            .nav-links a:hover {
                padding-left: 2rem;
                color: var(--color-primary) !important;
                background-color: rgba(230, 57, 70, 0.08);
                transform: translateX(0.5rem);
            }
            
            /* Efecto de ripple para móviles */
            .nav-links a {
                overflow: hidden;
                position: relative;
            }
            
            .nav-links a:active::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(230, 57, 70, 0.15);
                transform: translateY(-50%) scale(0);
                opacity: 0;
                border-radius: 50%;
                animation: ripple 0.6s ease-out;
            }
            
            @keyframes ripple {
                to {
                    transform: translateY(-50%) scale(4);
                    opacity: 0;
                }
            }
            
            .close-menu-btn {
                display: block !important;
                position: absolute;
                top: 1.5rem;
                right: 1.5rem;
                background: var(--color-primary);
                color: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                font-size: 1.5rem;
                z-index: 1002;
            }
            
            .auth-buttons {
                display: flex;
                flex-direction: column;
                width: 100%;
                margin-top: 1rem;
            }
            
            .auth-buttons .btn {
                width: 100%;
                margin: 0.5rem 0;
                text-align: center;
            }
            
            /* Overlay para fondo oscuro cuando el menú está abierto */
            .menu-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 1;
                transition: opacity 0.3s ease;
                -webkit-tap-highlight-color: transparent;
            }
            
            body.menu-open {
                overflow: hidden;
                position: fixed;
                width: 100%;
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <a href="/" class="logo">
                @if(isset($page) && $page->logo_image)
                    <img src="{{ asset('storage/' . $page->logo_image) }}" alt="{{ $page->business_name ?? 'Logo' }}" class="logo-image">
                @else
                    {{ $page->business_name_short ?? 'Alla' }}<span>{{ $page->business_name_highlight ?? 'lettera' }}</span>
                @endif
            </a>
            
            <!-- Mobile menu button -->
            <button class="mobile-menu-btn" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Navigation -->
            <nav class="nav-links">
                <button class="close-menu-btn" aria-label="Close menu">
                    <i class="fas fa-times"></i>
                </button>
                
                @if(isset($page->menu_items) && is_array($page->menu_items))
                    @foreach($page->menu_items as $item)
                        <a href="{{ $item['url'] ?? '#' }}">{{ $item['text'] ?? 'Menú' }}</a>
                    @endforeach
                @else
                    <a href="#menu">Menú</a>
                    <a href="#especialidades">Especialidades</a>
                    <a href="#nosotros">Nosotros</a>
                    <a href="#contacto">Contacto</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline">Mi Cuenta</a>
                        @else
                            <div class="auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-outline">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                                @endif
                            </div>
                        @endauth
                    @endif
                    <a href="{{ route('vista-1') }}" class="btn btn-primary">Ver Menú</a>
                @endif
            </nav>
        </header>
        <img src="{{ $page->hero_image_url }}" alt="{{ $page->title }}" class="img-thumbnail" style="max-width: 200px;">
        <section class="hero" style="{{ !empty($page->hero_image) ? 'background-image: url(' . asset('storage/' . $page->hero_image) . ');' : '' }}">
            <div class="hero-content">
                <h1>{!! nl2br(e($page->hero_title ?? 'Sabores que inspiran,<br><span>momentos que perduran</span>')) !!}</h1>
                <p>{{ $page->hero_subtitle ?? 'Una experiencia gastronómica única que combina tradición e innovación en cada plato. Entregamos a domicilio en San Carlos, Antioquia.' }}</p>
                <div class="cta-buttons">
                    @if(isset($page->cta_buttons))
                        @foreach($page->cta_buttons as $button)
                            <a href="{{ $button['url'] ?? '#' }}" class="btn {{ $button['type'] ?? 'btn-primary' }}">
                                {{ $button['text'] ?? 'Ver más' }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('vista-1') }}" class="btn btn-primary">Ver Menú</a>
                        <a href="#contacto" class="btn btn-secondary">Hacer Pedido</a>
                    @endif
                </div>
            </div>
        </section>

        <section class="features">
            <div class="section-title">
                <h2>{{ $page->features_title ?? '¿Cómo funciona?' }}</h2>
                <p>{{ $page->features_subtitle ?? 'Disfruta de una experiencia culinaria excepcional en tres simples pasos' }}</p>
            </div>
            @if(!empty($page->features) && is_array($page->features) && count($page->features) > 0)
            <div class="features-grid">
                @foreach($page->features as $feature)
                <div class="feature-card">
                    @if(!empty($feature['icon']))
                    <div class="feature-icon">
                        <i class="{{ $feature['icon'] }}"></i>
                    </div>
                    @endif
                    @if(!empty($feature['title']))
                    <h3>{{ $feature['title'] }}</h3>
                    @endif
                    @if(!empty($feature['description']))
                    <p>{{ $feature['description'] }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </section>

        @if(!empty($page->specialties) && is_array($page->specialties) && count($page->specialties) > 0)
        <section class="specialties" id="especialidades">
            <div class="section-title">
                <h2>{{ $page->specialties_title ?? 'Nuestras Especialidades' }}</h2>
                <p>{{ $page->specialties_subtitle ?? 'Platos signature que definen nuestra propuesta gastronómica' }}</p>
            </div>
            <div class="specialties-grid">
                @foreach($page->specialties as $specialty)
                <div class="specialty-card">
                    <div class="specialty-img">
                        @if(!empty($specialty['image']))
                        <img src="{{ asset('storage/' . $specialty['image']) }}" alt="{{ $specialty['title'] ?? 'Especialidad' }}">
                        @else
                        <img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="{{ $specialty['title'] ?? 'Especialidad' }}">
                        @endif
                    </div>
                    <div class="specialty-content">
                        @if(!empty($specialty['title']))
                        <h3>{{ $specialty['title'] }}</h3>
                        @endif
                        @if(!empty($specialty['description']))
                        <p>{{ $specialty['description'] }}</p>
                        @endif
                        @if(!empty($specialty['button_text']) && !empty($specialty['button_url']))
                        <a href="{{ $specialty['button_url'] }}" class="btn btn-outline btn-sm">
                            {{ $specialty['button_text'] }}
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if(!empty($page->testimonials) && is_array($page->testimonials) && count($page->testimonials) > 0)
        <section class="testimonials">
            <div class="section-title">
                <h2>{{ $page->testimonials_title ?? 'Lo que dicen nuestros clientes' }}</h2>
                <p>{{ $page->testimonials_subtitle ?? 'Experiencias de quienes han disfrutado de nuestra cocina' }}</p>
            </div>
            <div class="testimonials-slider">
                @foreach($page->testimonials as $testimonial)
                <div class="testimonial-card">
                    @if(!empty($testimonial['rating']))
                    <div class="testimonial-rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial['rating'])
                                <i class="fas fa-star"></i>
                            @elseif($i - 0.5 <= $testimonial['rating'])
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    @endif
                    @if(!empty($testimonial['text']))
                    <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
                    @endif
                    <div class="testimonial-author">
                        @if(!empty($testimonial['image']))
                        <img src="{{ asset('storage/' . $testimonial['image']) }}" alt="{{ $testimonial['name'] ?? 'Cliente' }}">
                        @endif
                        <div>
                            @if(!empty($testimonial['name']))
                            <h4>{{ $testimonial['name'] }}</h4>
                            @endif
                            @if(!empty($testimonial['position']))
                            <span>{{ $testimonial['position'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <section class="cta-section">
            <h2>¿Listo para una experiencia gastronómica?</h2>
            <p>Ordena ahora y recibe en tu hogar los sabores auténticos de San Carlos, elaborados con pasión y los mejores ingredientes.</p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('vista-1') }}" class="btn btn-secondary">Ver Menú Completo</a>
                @else
                    <div class="cta-buttons">
                        <a href="{{ route('login') }}" class="btn btn-outline">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
                    </div>
                @endauth
            @endif
        </section>

        <footer id="contacto">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>{{ $page->business_name ?? 'Allaletera' }}</h3>
                    <p>{{ $page->business_description ?? 'Propuesta gastronómica innovadora que celebra los sabores tradicionales de San Carlos, Antioquia.' }}</p>
                    @if(!empty($page->social_links) && is_array($page->social_links))
                    <div class="social-links">
                        @foreach($page->social_links as $social)
                            @if(!empty($social['url']) && !empty($social['icon']))
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                
                @if(!empty($page->opening_hours) && is_array($page->opening_hours) && count($page->opening_hours) > 0)
                <div class="footer-column">
                    <h3>{{ $page->opening_hours_title ?? 'Horarios' }}</h3>
                    <ul>
                        @foreach($page->opening_hours as $schedule)
                            @if(!empty($schedule['days']) && !empty($schedule['hours']))
                            <li>{{ $schedule['days'] }}: {{ $schedule['hours'] }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="footer-column">
                    <h3>Contacto</h3>
                    <ul>
                        @if(!empty($page->address))
                        <li><i class="fas fa-map-marker-alt"></i> {{ $page->address }}</li>
                        @endif
                        @if(!empty($page->phone))
                        <li><i class="fas fa-phone"></i> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $page->phone) }}">{{ $page->phone }}</a></li>
                        @endif
                        @if(!empty($page->email))
                        <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $page->email }}">{{ $page->email }}</a></li>
                        @endif
                        @if(!empty($page->whatsapp))
                        <li><i class="fab fa-whatsapp"></i> <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $page->whatsapp) }}" target="_blank">{{ $page->whatsapp }}</a></li>
                        @endif
                    </ul>
                </div>
                
                @if($page->show_newsletter ?? true)
                <div class="footer-column">
                    <h3>{{ $page->newsletter_title ?? 'Newsletter' }}</h3>
                    <p>{{ $page->newsletter_subtitle ?? 'Suscríbete para recibir nuestras ofertas especiales' }}</p>
                    <form class="newsletter-form" action="{{ $page->newsletter_action ?? '#' }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="{{ $page->newsletter_placeholder ?? 'Tu correo electrónico' }}" required>
                        <button type="submit">{{ $page->newsletter_button ?? 'Suscribirse' }}</button>
                    </form>
                </div>
                @endif
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $page->copyright_text ?? 'Allaletera' }}. {{ $page->rights_text ?? 'Todos los derechos reservados.' }}</p>
                @if(!empty($page->footer_links) && is_array($page->footer_links))
                <div class="footer-links">
                    @foreach($page->footer_links as $link)
                        @if(!empty($link['url']) && !empty($link['text']))
                        <a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
        </footer>
    </div>

    <!-- WhatsApp Float -->
    @if(!empty($page->whatsapp))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $page->whatsapp) }}?text={{ urlencode('Hola, me gustaría hacer un pedido') }}" 
       class="whatsapp-float" target="_blank" aria-label="Chatear por WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    @endif

    <!-- Script para el menú móvil -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const closeMenuBtn = document.querySelector('.close-menu-btn');
            const navLinks = document.querySelector('.nav-links');
            const menuOverlay = document.querySelector('.menu-overlay');
            const body = document.body;
            let isMenuOpen = false;

            // Función para abrir el menú
            function openMenu() {
                if (!navLinks) return;
                
                navLinks.style.display = 'flex';
                setTimeout(() => {
                    navLinks.classList.add('active');
                    navLinks.style.transform = 'translateX(0)';
                }, 10);
                
                body.classList.add('menu-open');
                if (menuOverlay) menuOverlay.style.display = 'block';
                isMenuOpen = true;
                body.style.overflow = 'hidden';
            }
            
            // Función para cerrar el menú
            function closeMenu() {
                if (!navLinks) return;
                
                navLinks.style.transform = 'translateX(100%)';
                navLinks.classList.remove('active');
                isMenuOpen = false;
                body.classList.remove('menu-open');
                if (menuOverlay) menuOverlay.style.display = 'none';
                body.style.overflow = '';
                
                // Ocultar el menú después de la animación
                setTimeout(() => {
                    if (navLinks && !isMenuOpen) {
                        navLinks.style.display = 'none';
                    }
                }, 300);
            }
            
            // Manejadores de eventos para los botones del menú
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', openMenu);
            }
            
            if (closeMenuBtn) {
                closeMenuBtn.addEventListener('click', closeMenu);
            }
            
            // Cerrar menú al hacer clic en el overlay
            if (menuOverlay) {
                menuOverlay.addEventListener('click', closeMenu);
            }
            
            // Manejar clics en los enlaces del menú
            if (navLinks) {
                // Usar delegación de eventos para manejar clics en los enlaces
                navLinks.addEventListener('click', function(e) {
                    const link = e.target.closest('a');
                    if (!link) return;
                    
                    const href = link.getAttribute('href');
                    
                    // Solo manejar enlaces internos que comienzan con #
                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const targetElement = document.querySelector(href);
                        
                        // Cerrar el menú primero
                        closeMenu();
                        
                        // Desplazarse al elemento objetivo después de cerrar el menú
                        if (targetElement) {
                            setTimeout(() => {
                                targetElement.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 350);
                        }
                    }
                });
                
                // Mejorar la retroalimentación táctil
                navLinks.addEventListener('touchstart', function(e) {
                    const link = e.target.closest('a');
                    if (link) link.classList.add('touch-active');
                }, { passive: true });
                
                navLinks.addEventListener('touchend', function() {
                    const activeLink = navLinks.querySelector('.touch-active');
                    if (activeLink) activeLink.classList.remove('touch-active');
                }, { passive: true });
            }
            
            // Manejar cambios de tamaño de pantalla
            function handleResize() {
                if (window.innerWidth > 768) {
                    // En pantallas grandes, asegurarse de que el menú esté visible
                    if (navLinks) {
                        navLinks.style.display = 'flex';
                        navLinks.style.transform = '';
                        navLinks.classList.remove('active');
                    }
                    body.classList.remove('menu-open');
                    if (menuOverlay) menuOverlay.style.display = 'none';
                    body.style.overflow = '';
                    isMenuOpen = false;
                } else if (navLinks && !isMenuOpen) {
                    // En móviles, asegurarse de que el menú esté oculto inicialmente
                    navLinks.style.display = 'none';
                }
            }
            
            // Cerrar menú al presionar la tecla Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isMenuOpen) {
                    closeMenu();
                }
            });
            
            // Inicialización
            window.addEventListener('resize', handleResize);
            handleResize();
        });
    </script>

    <!-- Font Awesome 5.15.4 -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Initialize tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tooltip initialization
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Add animation class on hover
            const whatsappBtn = document.querySelector('.whatsapp-float');
            if (whatsappBtn) {
                whatsappBtn.addEventListener('mouseenter', function() {
                    this.classList.add('pulse');
                });
                whatsappBtn.addEventListener('animationend', function() {
                    this.classList.remove('pulse');
                });
            }
        });
    </script>
    
    <!-- Additional CSS for animations -->
    <style>
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
            text-decoration: none;
            color: white;
        }
        .whatsapp-float.pulse {
            animation: pulse 1.5s infinite;
        }
    </style>
</body>
</html>