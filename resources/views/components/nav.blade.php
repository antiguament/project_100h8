<style>
:root {
    --venice-blue: #0A2E36;
    --venice-teal: #0D4D5A;
    --venice-turquoise: #117A8A;
    --venice-light: #14B8C6;
    --venice-accent: #0EE4EB;
    --venice-gold: #D4AF37;
    --venice-gold-light: #F1E5AC;
    --venice-canal: #00C2CB;
    --light: #F0FDFA;
    --shadow-teal: 0 4px 25px rgba(0, 194, 203, 0.25);
    --shadow-gold: 0 4px 20px rgba(212, 175, 55, 0.3);
    --glow: 0 0 18px rgba(0, 194, 203, 0.6);
    --gold-glow: 0 0 12px rgba(212, 175, 55, 0.7);
    --border-radius-lg: 20px;
    --border-radius-sm: 12px;
    --glass-bg: rgba(10, 46, 54, 0.95);
    --glass-border: rgba(20, 184, 198, 0.2);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, var(--venice-blue) 0%, #081d21 100%);
    color: var(--light);
    overflow-x: hidden;
}

h1, h2, h3 {
    font-family: 'Playfair Display', serif;
}

/* Navigation Styles */
.navbar-premium {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--glass-border);
    box-shadow: var(--shadow-teal);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.navbar-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 80px;
}

/* Logo Section */
.navbar-brand {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--venice-gold-light);
    font-weight: 700;
    font-size: 1.8rem;
    text-shadow: var(--gold-glow);
    transition: all 0.3s ease;
    position: relative;
}

.navbar-brand:hover {
    transform: translateY(-2px);
    text-shadow: 0 0 20px rgba(212, 175, 55, 0.8);
}

.logo-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
    color: var(--venice-blue);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-weight: 800;
    font-size: 1.4rem;
    box-shadow: var(--glow);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.logo-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.navbar-brand:hover .logo-icon::before {
    transform: translateX(100%);
}

.logo-icon:hover {
    transform: scale(1.05) rotate(5deg);
    box-shadow: 0 8px 25px rgba(0, 194, 203, 0.6);
}

.brand-text {
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    position: relative;
}

.gold-accent {
    color: var(--venice-gold);
    text-shadow: 0 0 8px rgba(212, 175, 55, 0.6);
    font-weight: 800;
}

/* Navigation Actions */
.navbar-actions {
    display: flex;
    align-items: center;
    gap: 16px;
}

/* Register Button */
.register-btn {
    background: linear-gradient(135deg, var(--venice-gold), var(--venice-gold-light));
    color: var(--venice-blue);
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-right: 12px;
}

.register-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.register-btn:hover::before {
    left: 100%;
}

.register-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
    background: linear-gradient(135deg, var(--venice-gold-light), var(--venice-gold));
}

.register-btn:active {
    transform: translateY(-1px);
}

/* Account Button */
.account-btn {
    background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
    color: var(--venice-blue);
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 15px rgba(0, 194, 203, 0.3);
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.account-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.account-btn:hover::before {
    left: 100%;
}

.account-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 194, 203, 0.5);
    background: linear-gradient(135deg, var(--venice-accent), var(--venice-light));
}

.account-btn:active {
    transform: translateY(-1px);
}

/* Mobile Menu Button */
.mobile-menu-btn {
    display: none;
    background: rgba(20, 184, 198, 0.1);
    border: 1px solid var(--glass-border);
    color: var(--venice-light);
    padding: 12px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.mobile-menu-btn:hover {
    background: rgba(20, 184, 198, 0.2);
    transform: scale(1.05);
}

.mobile-menu-btn svg {
    width: 24px;
    height: 24px;
}

/* Navigation Menu */
.navbar-menu {
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 4px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    position: relative;
}

.nav-link {
    color: var(--venice-light);
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    overflow: hidden;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(20, 184, 198, 0.1), transparent);
    transition: left 0.5s ease;
}

.nav-link:hover::before {
    left: 100%;
}

.nav-link:hover {
    color: var(--venice-accent);
    background: rgba(20, 184, 198, 0.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 194, 203, 0.2);
}

.nav-link.active {
    color: var(--venice-gold-light);
    background: rgba(212, 175, 55, 0.1);
    box-shadow: var(--gold-glow);
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 2px;
    background: var(--venice-gold);
    border-radius: 1px;
}

/* Mobile Menu */
.mobile-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border-top: 1px solid var(--glass-border);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.mobile-nav-menu {
    padding: 24px;
}

.mobile-nav-item {
    margin-bottom: 8px;
}

.mobile-nav-link {
    display: block;
    color: var(--venice-light);
    text-decoration: none;
    padding: 16px 20px;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.mobile-nav-link:hover,
.mobile-nav-link.active {
    color: var(--venice-gold-light);
    background: rgba(212, 175, 55, 0.1);
    border-color: rgba(212, 175, 55, 0.3);
    transform: translateX(8px);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .navbar-container {
        padding: 0 20px;
    }

    .nav-link {
        padding: 10px 16px;
        font-size: 0.8rem;
    }
}

@media (max-width: 768px) {
    .navbar-container {
        padding: 0 16px;
        height: 70px;
    }

    .navbar-brand {
        font-size: 1.5rem;
    }

    .logo-icon {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }

    .brand-text {
        font-size: 1.5rem;
    }

    .navbar-menu {
        display: none;
    }

    .mobile-menu-btn {
        display: block;
    }

    .account-btn,
    .register-btn {
        display: none;
    }

    .mobile-menu.show {
        display: block;
    }
}

@media (max-width: 480px) {
    .navbar-container {
        padding: 0 12px;
        height: 65px;
    }

    .navbar-brand {
        font-size: 1.3rem;
    }

    .logo-icon {
        width: 36px;
        height: 36px;
        font-size: 1rem;
        margin-right: 12px;
    }

    .brand-text {
        font-size: 1.3rem;
    }

    .mobile-nav-menu {
        padding: 20px 16px;
    }
}

/* Scroll Effects */
.navbar-scrolled {
    background: rgba(10, 46, 54, 0.98);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(30px);
}

/* Loading Animation */
@keyframes shimmer {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: calc(200px + 100%) 0;
    }
}

.nav-link-loading {
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    background-size: 200px 100%;
    animation: shimmer 1.5s infinite;
}

/* Focus States for Accessibility */
.nav-link:focus,
.account-btn:focus,
.mobile-menu-btn:focus {
    outline: 2px solid var(--venice-accent);
    outline-offset: 2px;
}

/* Print Styles */
@media print {
    .navbar-premium {
        display: none;
    }
}
</style>

<nav class="navbar-premium" id="mainNavbar">
    <div class="navbar-container">
        <!-- Logo Section -->
        <a href="{{ route('welcome') }}" class="navbar-brand">
            <div class="logo-icon">A</div>
            <span class="brand-text">Alla<span class="gold-accent">letera</span></span>
        </a>

        <!-- Desktop Navigation Menu -->
        <div class="navbar-menu">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('galeria.imagenes') }}" class="nav-link {{ request()->routeIs('galeria.imagenes') ? 'active' : '' }}">
                        Galería
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vista-1') }}" class="nav-link {{ request()->routeIs('vista-1') ? 'active' : '' }}">
                        Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#nosotros" class="nav-link">
                        Nosotros
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#contacto" class="nav-link">
                        Contacto
                    </a>
                </li>
            </ul>
        </div>

        <!-- Actions Section -->
        <div class="navbar-actions">
            <a href="{{ route('register') }}">
                <button type="button" class="register-btn">
                    <i class="fas fa-user-plus" style="margin-right: 8px;"></i>
                    Registrarse
                </button>
            </a>
            <a href="{{ route('login') }}">
                <button type="button" class="account-btn">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                    Iniciar Sesión
                </button>
            </a>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle mobile menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <nav class="mobile-nav-menu">
            <a href="{{ route('welcome') }}" class="mobile-nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                <i class="fas fa-home" style="margin-right: 12px;"></i>
                Inicio
            </a>
            <a href="{{ route('galeria.imagenes') }}" class="mobile-nav-link {{ request()->routeIs('galeria.imagenes') ? 'active' : '' }}">
                <i class="fas fa-images" style="margin-right: 12px;"></i>
                Galería
            </a>
            <a href="{{ route('vista-1') }}" class="mobile-nav-link {{ request()->routeIs('vista-1') ? 'active' : '' }}">
                <i class="fas fa-box-open" style="margin-right: 12px;"></i>
                Productos
            </a>
            <a href="#nosotros" class="mobile-nav-link">
                <i class="fas fa-users" style="margin-right: 12px;"></i>
                Nosotros
            </a>
            <a href="#contacto" class="mobile-nav-link">
                <i class="fas fa-envelope" style="margin-right: 12px;"></i>
                Contacto
            </a>
            <a href="{{ route('register') }}" class="mobile-nav-link">
                <i class="fas fa-user-plus" style="margin-right: 12px;"></i>
                Registrarse
            </a>
            <a href="{{ route('login') }}" class="mobile-nav-link">
                <i class="fas fa-sign-in-alt" style="margin-right: 12px;"></i>
                Iniciar Sesión
            </a>
        </nav>
    </div>
</nav>

<script>
// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const navbar = document.getElementById('mainNavbar');

    // Toggle mobile menu
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('show');
        mobileMenuBtn.setAttribute('aria-expanded',
            mobileMenu.classList.contains('show') ? 'true' : 'false'
        );
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!navbar.contains(event.target)) {
            mobileMenu.classList.remove('show');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    // Close mobile menu on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            mobileMenu.classList.remove('show');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    // Navbar scroll effect
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }

        lastScrollTop = scrollTop;
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading animation to active links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function() {
            if (!this.classList.contains('active')) {
                this.classList.add('nav-link-loading');
            }
        });
    });
});
</script>