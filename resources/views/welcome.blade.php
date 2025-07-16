<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Allaletera | Gourmet Delivery - San Carlos, Antioquia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            transition: color 0.2s;
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
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .auth-buttons {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="/" class="logo">Alla<span>lettera</span></a>
            <nav class="nav-links">
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
            </nav>
        </header>

        <section class="hero">
            <div class="hero-content">
                <h1>Sabores de San Carlos <span>en tu mesa</span></h1>
                <p>Experiencia gourmet con los ingredientes más frescos de Antioquia. Cocina tradicional con un toque innovador, entregada directamente a tu hogar.</p>
                <div class="cta-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('vista-1') }}" class="btn btn-primary">Ordenar Ahora</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                    <a href="#especialidades" class="btn btn-secondary">Nuestras Especialidades</a>
                </div>
            </div>
        </section>

        <section class="features">
            <div class="section-title">
                <h2>¿Cómo funciona?</h2>
                <p>Disfruta de una experiencia culinaria excepcional en tres simples pasos</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Elige</h3>
                    <p>Selecciona tus platos favoritos de nuestro menú gourmet desde nuestra plataforma.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Preparamos</h3>
                    <p>Nuestros chefs elaboran cada plato con ingredientes frescos y técnicas tradicionales.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Disfruta</h3>
                    <p>Recibe tu pedido en la comodidad de tu hogar y vive una experiencia gastronómica única.</p>
                </div>
            </div>
        </section>

        <section class="specialties" id="especialidades">
            <div class="section-title">
                <h2>Nuestras Especialidades</h2>
                <p>Platos signature que definen nuestra propuesta gastronómica</p>
            </div>
            <div class="specialties-grid">
                <div class="specialty-card">
                    <div class="specialty-img">
                        <img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Trucha Fresca">
                    </div>
                    <div class="specialty-content">
                        <div class="specialty-badge">Chef's Pick</div>
                        <h3>Trucha Fresca de San Carlos</h3>
                        <p>Trucha de río con salsa de maracuyá y hierbas de la región</p>
                        <div class="specialty-price">$32.000</div>
                    </div>
                </div>
                
                <div class="specialty-card">
                    <div class="specialty-img">
                        <img src="https://images.unsplash.com/photo-1601050690597-df0568f70950?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Bandeja Paisa Gourmet">
                    </div>
                    <div class="specialty-content">
                        <div class="specialty-badge">Popular</div>
                        <h3>Bandeja Paisa Gourmet</h3>
                        <p>Versión premium del clásico antioqueño con ingredientes selectos</p>
                        <div class="specialty-price">$28.000</div>
                    </div>
                </div>
                
                <div class="specialty-card">
                    <div class="specialty-img">
                        <img src="https://images.unsplash.com/photo-1603105037880-880cd4edfb0d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Risotto de Hongos">
                    </div>
                    <div class="specialty-content">
                        <h3>Risotto de Hongos Silvestres</h3>
                        <p>Arborio cremoso con hongos recolectados en las montañas de Antioquia</p>
                        <div class="specialty-price">$35.000</div>
                    </div>
                </div>
                
                <div class="specialty-card">
                    <div class="specialty-img">
                        <img src="https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Postre de Guanábana">
                    </div>
                    <div class="specialty-content">
                        <h3>Postre de Guanábana</h3>
                        <p>Mousse ligero de guanábana con coulis de frutos rojos</p>
                        <div class="specialty-price">$15.000</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials">
            <div class="section-title">
                <h2>Lo que dicen nuestros clientes</h2>
                <p>Experiencias reales de quienes han probado nuestra cocina</p>
            </div>
            <div class="container">
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        La Trucha con salsa de maracuyá es simplemente espectacular. Nunca había probado algo así en San Carlos. El equilibrio de sabores es perfecto.
                    </div>
                    <div class="testimonial-author">- Juan Pérez</div>
                </div>
            </div>
        </section>

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
                    <h3>Allaletera</h3>
                    <p>Propuesta gastronómica innovadora que celebra los sabores tradicionales de San Carlos, Antioquia.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Horarios</h3>
                    <ul>
                        <li>Lunes a Viernes: 11am - 9pm</li>
                        <li>Sábados: 12pm - 10pm</li>
                        <li>Domingos: 12pm - 8pm</li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contacto</h3>
                    <ul>
                        <li>San Carlos, Antioquia</li>
                        <li>+57 310 123 4567</li>
                        <li>info@allaletera.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2023 Allaletera. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/573101234567" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>