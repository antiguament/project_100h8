<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Nuestras Categorías</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Explora nuestra selección premium de productos organizados por categorías. Disfruta de una experiencia de navegación única con nuestro carrusel 3D interactivo.</p>
    </div>

    <!-- Toggle entre vista carrusel y grid -->
    <div class="view-toggle">
        <button id="carousel-view-btn" class="toggle-btn active">
            <i class="fas fa-circle-3d mr-2"></i> Vista 3D
        </button>
        <button id="grid-view-btn" class="toggle-btn">
            <i class="fas fa-th-large mr-2"></i> Vista Grid
        </button>
    </div>

    <!-- Contenedor del carrusel 3D -->
    <div id="carousel-view" class="relative">
        <div class="flex items-center justify-center mb-6">
            <button id="prev-btn" class="nav-button mr-4">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div id="carousel-container" class="mx-4">
                <div id="carousel-items">
                    @forelse ($categories ?? [] as $index => $category)
                        <div class="carousel-item" data-index="{{ $index }}">
                            <div class="carousel-content">
                                <div class="carousel-icon">
                                    @if($category->image_url)
                                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <i class="fas {{ ['fa-utensils', 'fa-wine-glass-alt', 'fa-ice-cream', 'fa-drumstick-bite', 'fa-appetizer', 'fa-leaf', 'fa-map-marker-alt', 'fa-tag'][$index % 8] ?? 'fa-utensils' }}"></i>
                                    @endif
                                </div>
                                <h3 class="carousel-title">{{ $category->name }}</h3>
                                <p class="carousel-desc">{{ $category->description ?? 'Explora nuestra selección de productos en esta categoría.' }}</p>
                                <a href="{{ route('categoria.productos', $category->id) }}" class="carousel-link">
                                    Ver productos <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div id="no-categories-carousel" class="carousel-item active" style="display: flex; align-items: center; justify-content: center; background: #f8f9fa; color: #6b7280;">
                            <div class="text-center">
                                <i class="fas fa-inbox fa-3x mb-4 opacity-70"></i>
                                <h3>No hay categorías disponibles</h3>
                                <p>Lo sentimos, actualmente no hay categorías disponibles. Por favor, vuelve más tarde.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <button id="next-btn" class="nav-button ml-4">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <div class="text-center mt-4">
            <p class="text-gray-600">Usa las flechas o desliza para navegar entre las categorías</p>
        </div>
    </div>

    <!-- Grid de categorías (oculto por defecto) -->
    <div id="grid-view" class="hidden">
        <div class="category-grid" id="category-grid-container">
            @forelse ($categories ?? [] as $index => $category)
                <div class="category-card">
                    <button class="category-btn" onclick="window.location.href='{{ route('categoria.productos', $category->id) }}'">
                        <div class="category-icon">
                            @if($category->image_url)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="category-image">
                            @else
                                <i class="fas {{ ['fa-utensils', 'fa-wine-glass-alt', 'fa-ice-cream', 'fa-drumstick-bite', 'fa-appetizer', 'fa-leaf', 'fa-map-marker-alt', 'fa-tag'][$index % 8] ?? 'fa-utensils' }}"></i>
                            @endif
                        </div>
                        <h3 class="category-title">{{ $category->name }}</h3>
                        <p class="category-desc">{{ $category->description ?? 'Explora nuestra selección de productos en esta categoría.' }}</p>
                        <span class="category-link">
                            Ver productos <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </div>
            @empty
                <div class="no-categories">
                    <i class="fas fa-inbox"></i>
                    <h3>No hay categorías disponibles</h3>
                    <p>Lo sentimos, actualmente no hay categorías disponibles. Por favor, vuelve más tarde.</p>
                </div>
            @endforelse
        </div>
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

    /* Estilos del Carrusel 3D VIP */
    #carousel-container {
        perspective: 1000px;
        height: 400px;
        width: 100%;
        margin: 2rem 0;
    }

    #carousel-items {
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        width: 100%;
        height: 100%;
    }

    .carousel-item {
        position: absolute;
        top: 50%;
        left: 50%;
        transform-origin: center center;
        transition: transform 0.6s ease-in-out, opacity 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        cursor: pointer;
        width: 200px;
        height: 250px;
        margin-top: -125px;
        margin-left: -100px;
        opacity: 0.6;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .carousel-item.active {
        opacity: 1;
        box-shadow: 0 0 20px 5px rgba(16, 185, 129, 0.4),
                    0 0 5px 2px rgba(16, 185, 129, 0.6);
        transform: translateZ(300px) rotateY(0deg) scale(1.1);
    }

    .carousel-content {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
        text-align: center;
    }

    .carousel-icon {
        width: 80px;
        height: 80px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.8rem;
    }

    .carousel-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--color-dark);
    }

    .carousel-desc {
        font-size: 0.85rem;
        color: #6B7280;
        margin-bottom: 1rem;
        line-height: 1.4;
        flex-grow: 1;
    }

    .carousel-link {
        display: inline-flex;
        align-items: center;
        color: var(--color-primary);
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .carousel-link i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .carousel-item:hover .carousel-link i {
        transform: translateX(5px);
    }

    /* Botones de navegación */
    .nav-button {
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
        z-index: 10;
    }

    .nav-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.4);
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
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
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
        color: #6B7280;
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
        grid-column: 1 / -1;
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
        color: #6B7280;
        max-width: 500px;
        margin: 0 auto;
    }

    /* Toggle entre vista carrusel y grid */
    .view-toggle {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    .toggle-btn {
        background: white;
        border: 2px solid var(--color-primary);
        color: var(--color-primary);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .toggle-btn.active {
        background: var(--gradient-primary);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .category-grid {
            grid-template-columns: 1fr;
        }
        
        #carousel-container {
            height: 350px;
        }
        
        .carousel-item {
            width: 180px;
            height: 220px;
            margin-top: -110px;
            margin-left: -90px;
        }
    }

    @media (max-width: 480px) {
        #carousel-container {
            height: 300px;
        }
        
        .carousel-item {
            width: 160px;
            height: 200px;
            margin-top: -100px;
            margin-left: -80px;
        }
        
        .carousel-content {
            padding: 1rem;
        }
        
        .carousel-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>

<script>
    // Datos reales de categorías desde Laravel
    const categories = @json($categories ?? []);

    // Iconos para categorías sin imagen
    const icons = ['fa-utensils', 'fa-wine-glass-alt', 'fa-ice-cream', 'fa-drumstick-bite', 'fa-appetizer', 'fa-leaf', 'fa-map-marker-alt', 'fa-tag'];

    // Elementos DOM
    const carouselItemsContainer = document.getElementById('carousel-items');
    const categoryGridContainer = document.getElementById('category-grid-container');
    const noCategoriesElement = document.getElementById('no-categories');
    const carouselView = document.getElementById('carousel-view');
    const gridView = document.getElementById('grid-view');
    const carouselViewBtn = document.getElementById('carousel-view-btn');
    const gridViewBtn = document.getElementById('grid-view-btn');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    // Configuración 3D
    const itemCount = categories.length;
    const angle = 360 / itemCount;
    const radius = 250;
    let currentRotation = 0;
    let activeIndex = 0;

    // Inicializar la aplicación
    function initializeApp() {
        if (categories.length === 0) {
            showNoCategories();
            return;
        }

        initializeCarousel();
        initializeGrid();
        setupEventListeners();
    }

    // Mostrar estado cuando no hay categorías
    function showNoCategories() {
        carouselView.classList.add('hidden');
        gridView.classList.add('hidden');
        noCategoriesElement.classList.remove('hidden');
    }

    // Inicializar el carrusel 3D
    function initializeCarousel() {
        carouselItemsContainer.innerHTML = ''; // Limpia el contenedor para evitar duplicados
        categories.forEach((category, index) => {
            const item = createCarouselItem(category, index);
            carouselItemsContainer.appendChild(item);
        });
        updateCarousel(false);
    }

    // Crear un ítem del carrusel
    function createCarouselItem(category, index) {
        const item = document.createElement('div');
        item.className = 'carousel-item';
        item.setAttribute('data-index', index);
        
        const icon = category.image_url ? 
            `<img src="${category.image_url}" alt="${category.name}" class="w-full h-full object-cover rounded-full">` :
            `<i class="fas ${icons[index % icons.length]}"></i>`;

        item.innerHTML = `
            <div class="carousel-content">
                <div class="carousel-icon">
                    ${icon}
                </div>
                <h3 class="carousel-title">${category.name}</h3>
                <p class="carousel-desc">${category.description || 'Explora nuestra selección de productos en esta categoría.'}</p>
                <a href="/categoria/${category.id}/productos" class="carousel-link">
                    Ver productos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        `;

        // Posicionar el ítem en el cilindro 3D
        const itemAngle = index * angle;
        item.style.transform = `rotateY(${itemAngle}deg) translateZ(${radius}px)`;

        // Evento de clic
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const targetIndex = parseInt(item.getAttribute('data-index'));
            const steps = (targetIndex - activeIndex) % itemCount;
            currentRotation -= steps * angle;
            activeIndex = targetIndex;
            updateCarousel();
            
            // Navegar a la categoría (usando Laravel route)
            window.location.href = `/categoria/${category.id}/productos`;
        });

        return item;
    }

    // Actualizar el carrusel
    function updateCarousel(smooth = true) {
        carouselItemsContainer.style.transform = `rotateY(${currentRotation}deg)`;
        
        const normalizedRotation = (360 - (currentRotation % 360) + 360) % 360;
        activeIndex = Math.round(normalizedRotation / angle) % itemCount;

        const items = carouselItemsContainer.querySelectorAll('.carousel-item');
        items.forEach((item, index) => {
            if (index === activeIndex) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }

    // Inicializar el grid de categorías
    function initializeGrid() {
        categoryGridContainer.innerHTML = ''; // Limpia el contenedor para evitar duplicados
        categories.forEach((category, index) => {
            const card = createCategoryCard(category, index);
            categoryGridContainer.appendChild(card);
        });
    }

    // Crear una tarjeta de categoría para el grid
    function createCategoryCard(category, index) {
        const card = document.createElement('div');
        card.className = 'category-card';
        
        const icon = category.image_url ? 
            `<img src="${category.image_url}" alt="${category.name}" class="category-image">` :
            `<i class="fas ${icons[index % icons.length]}"></i>`;

        card.innerHTML = `
            <button class="category-btn" onclick="window.location.href='/categoria/${category.id}/productos'">
                <div class="category-icon">
                    ${icon}
                </div>
                <h3 class="category-title">${category.name}</h3>
                <p class="category-desc">${category.description || 'Explora nuestra selección de productos en esta categoría.'}</p>
                <span class="category-link">
                    Ver productos <i class="fas fa-arrow-right"></i>
                </span>
            </button>
        `;

        return card;
    }

    // Rotar el carrusel
    function rotate(direction) {
        currentRotation += direction * angle;
        updateCarousel();
    }

    // Configurar event listeners
    function setupEventListeners() {
        // Botones de navegación del carrusel
        prevBtn.addEventListener('click', () => rotate(-1));
        nextBtn.addEventListener('click', () => rotate(1));

        // Toggle entre vistas
        carouselViewBtn.addEventListener('click', () => {
            carouselViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
            carouselView.classList.remove('hidden');
            gridView.classList.add('hidden');
        });

        gridViewBtn.addEventListener('click', () => {
            gridViewBtn.classList.add('active');
            carouselViewBtn.classList.remove('active');
            gridView.classList.remove('hidden');
            carouselView.classList.add('hidden');
        });

        // Navegación con rueda del ratón
        carouselItemsContainer.addEventListener('wheel', (e) => {
            e.preventDefault();
            if (e.deltaY > 5) {
                rotate(1);
            } else if (e.deltaY < -5) {
                rotate(-1);
            }
        });

        // Navegación con teclado
        document.addEventListener('keydown', (e) => {
            if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    rotate(-1);
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    rotate(1);
                }
            }
        });
    }

    // Inicializar la aplicación cuando la página cargue
    window.onload = initializeApp;
</script>