<x-app-layout>
    @push('styles')
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
            --gray: #A4B0BE;
            --light-gray: #F1F2F6;
            --success: #2ECC71;
            --warning: #FF9F43;
            --danger: #FF6B6B;
            --shadow: 0 4px 20px rgba(0, 194, 203, 0.15);
            --shadow-hover: 0 8px 30px rgba(0, 194, 203, 0.3);
            --glow: 0 0 15px rgba(0, 194, 203, 0.5);
            --gold-glow: 0 0 10px rgba(212, 175, 55, 0.5);
            --border-radius: 16px;
            --border-radius-sm: 10px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
        }
        
        body {
            background: linear-gradient(135deg, var(--venice-blue) 0%, var(--venice-teal) 100%);
            color: var(--light);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            font-family: 'Playfair Display', serif;
        }
        
        /* App Container con efecto de agua veneciana */
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: rgba(10, 46, 54, 0.9);
            backdrop-filter: blur(10px);
            position: relative;
            min-height: 100vh;
            box-shadow: 0 0 50px rgba(0, 194, 203, 0.2);
            overflow: hidden;
        }
        
        .app-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 194, 203, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
                linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.05) 50%, transparent 60%);
            z-index: -1;
        }
        
        /* Efecto de olas venecianas en la parte inferior */
        .app-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: 
                linear-gradient(transparent, rgba(0, 194, 203, 0.1)),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%2300C2CB'/%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%2300C2CB'/%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%2300C2CB'/%3E%3C/svg%3E");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            z-index: -1;
        }
        
        /* Header con estilo veneciano */
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: rgba(10, 46, 54, 0.9);
            backdrop-filter: blur(10px);
            padding: 12px 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
            max-width: 480px;
            margin: 0 auto;
            border-bottom: 1px solid rgba(0, 194, 203, 0.3);
        }
        
        .app-header .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--venice-gold-light);
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.3);
            font-family: 'Playfair Display', serif;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: var(--gold-glow);
            border: 1px solid rgba(212, 175, 55, 0.3);
        }
        
        /* Main Content */
        .main-content {
            padding: 80px 16px 140px;
            max-width: 480px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* Hero Section con estilo veneciano */
        .hero {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            position: relative;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--venice-accent), var(--venice-gold));
            border-radius: 3px;
        }
        
        .hero h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--venice-gold-light);
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
            font-family: 'Playfair Display', serif;
        }
        
        .hero p {
            color: var(--venice-light);
            font-size: 1rem;
            font-weight: 500;
            font-style: italic;
        }
        
        /* Categorías con estilo veneciano */
        .categories-container {
            position: relative;
            margin: 0 -16px;
            padding: 0 16px;
            background: rgba(13, 77, 90, 0.7);
            backdrop-filter: blur(10px);
            z-index: 10;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(0, 194, 203, 0.3);
            border-top: 1px solid rgba(0, 194, 203, 0.2);
        }
        
        .categories {
            display: flex;
            overflow-x: auto;
            padding: 16px 0;
            scrollbar-width: none;
            scroll-behavior: smooth;
        }
        
        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 8px;
            text-decoration: none;
            color: var(--light);
            transition: all 0.3s ease;
            min-width: 80px;
            padding: 8px 0;
            position: relative;
            z-index: 1;
        }
        
        .category-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(13, 77, 90, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
            border: 2px solid rgba(0, 194, 203, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
        }
        
        .category-icon::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.1) 50%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .category-icon:hover::after {
            opacity: 1;
        }
        
        .category-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .category-item.active .category-icon {
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            transform: translateY(-5px);
            box-shadow: var(--glow);
            border-color: var(--venice-gold);
        }
        
        .category-name {
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            color: var(--venice-light);
            transition: all 0.3s ease;
        }
        
        .category-item.active .category-name {
            color: var(--venice-gold-light);
            font-weight: 700;
            transform: scale(1.05);
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.3);
        }
        
        /* Products Section */
        .products-section {
            padding: 24px 0;
            position: relative;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 8px;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--venice-gold-light);
            margin: 0;
            position: relative;
            display: inline-block;
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.3);
            font-family: 'Playfair Display', serif;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--venice-accent), var(--venice-gold));
            border-radius: 3px;
            box-shadow: 0 0 5px rgba(20, 184, 166, 0.5);
        }
        
        .view-all {
            font-size: 0.9rem;
            color: var(--venice-accent);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 4px 8px;
            border-radius: 6px;
            background: rgba(0, 194, 203, 0.1);
            border: 1px solid rgba(0, 194, 203, 0.2);
        }
        
        .view-all:hover {
            background: rgba(0, 194, 203, 0.2);
            box-shadow: 0 0 10px rgba(0, 194, 203, 0.3);
        }
        
        .view-all i {
            margin-left: 6px;
            transition: transform 0.3s ease;
        }
        
        .view-all:hover i {
            transform: translateX(4px);
        }
        
        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 20px;
            margin-top: 16px;
        }
        
        /* Premium Food Card Design con estilo veneciano */
        .food-card {
            background: linear-gradient(145deg, rgba(13, 77, 90, 0.7), rgba(10, 46, 54, 0.9));
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.5, 1);
            position: relative;
            border: 1px solid rgba(0, 194, 203, 0.2);
            backdrop-filter: blur(5px);
        }
        
        .food-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--venice-accent), transparent);
            z-index: 2;
        }
        
        .food-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-hover), var(--glow);
            border-color: rgba(0, 194, 203, 0.4);
        }
        
        .food-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            transition: all 0.5s ease;
            border-bottom: 1px solid rgba(0, 194, 203, 0.2);
        }
        
        .food-card:hover .food-image {
            transform: scale(1.05);
        }
        
        .food-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, var(--venice-gold), #B8860B);
            color: var(--venice-blue);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 20px;
            box-shadow: var(--gold-glow);
            z-index: 3;
            letter-spacing: 0.5px;
        }
        
        .food-details {
            padding: 16px;
            position: relative;
        }
        
        .food-name {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: var(--venice-gold-light);
            line-height: 1.3;
        }
        
        .food-description {
            font-size: 0.8rem;
            color: var(--venice-light);
            margin: 0 0 16px 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .food-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .food-price {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--venice-accent);
            text-shadow: 0 0 3px rgba(14, 228, 235, 0.3);
        }
        
        .view-details-btn {
            font-size: 0.85rem;
            color: var(--venice-accent);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 6px 10px;
            border-radius: 8px;
            background: rgba(0, 194, 203, 0.1);
            border: 1px solid rgba(0, 194, 203, 0.2);
        }
        
        .view-details-btn:hover {
            background: rgba(0, 194, 203, 0.2);
            box-shadow: 0 0 10px rgba(0, 194, 203, 0.3);
        }
        
        .view-details-btn i {
            margin-left: 6px;
            transition: transform 0.3s ease;
        }
        
        .view-details-btn:hover i {
            transform: translateX(4px);
        }
        
        .add-to-cart {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 194, 203, 0.3);
        }
        
        .add-to-cart:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 194, 203, 0.4);
            background: linear-gradient(135deg, var(--venice-gold), #B8860B);
            color: var(--light);
        }
        
        /* Loading Animation */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .loading-shimmer {
            background: linear-gradient(90deg, 
                rgba(13, 77, 90, 0.5) 25%, 
                rgba(0, 194, 203, 0.3) 50%, 
                rgba(13, 77, 90, 0.5) 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
            border-radius: 8px;
        }
        
        /* Futuristic animation effects */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .food-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
            
            .category-icon {
                width: 70px;
                height: 70px;
            }
            
            .food-image {
                height: 120px;
            }
        }
        
        /* Animation for category selection */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .category-item.active {
            animation: pulse 0.5s ease;
        }
        
        /* Futuristic glow effect */
        @keyframes glow {
            0% { box-shadow: var(--shadow), 0 0 5px rgba(0, 194, 203, 0.3); }
            50% { box-shadow: var(--shadow), 0 0 20px rgba(0, 194, 203, 0.5); }
            100% { box-shadow: var(--shadow), 0 0 5px rgba(0, 194, 203, 0.3); }
        }
        
        .food-card {
            animation: glow 3s infinite alternate;
        }
        
        /* Gold accent elements */
        .gold-accent {
            color: var(--venice-gold);
            text-shadow: 0 0 3px rgba(212, 175, 55, 0.3);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(10, 46, 54, 0.5);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--venice-light), var(--venice-accent));
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, var(--venice-accent), var(--venice-gold));
        }
        
        /* Efecto de máscara veneciana flotante */
        .venetian-mask {
            position: absolute;
            top: 20%;
            right: -30px;
            opacity: 0.03;
            font-size: 200px;
            transform: rotate(15deg);
            z-index: -1;
            color: var(--venice-gold-light);
        }
    </style>
    @endpush

    <div class="app-container">
        <!-- Elemento decorativo de máscara veneciana -->
        <div class="venetian-mask">🎭</div>
        
        <!-- Header -->
        <header class="app-header">
            <a href="/" class="logo">
                <div class="logo-icon">A</div>
                <span>Alla<span class="gold-accent">letera</span></span>
            </a>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <div class="hero">
                <h1>¡Bienvenido a Allaletera!</h1>
                <p>Los mejores productos a tu alcance</p>
            </div>
            
            <!-- Categories -->
            <div class="categories-container">
                <div class="categories">
                    @forelse($categories as $category)
                        <a href="#" 
                           class="category-item {{ request('category') == $category->id ? 'active' : '' }}" 
                           data-category-id="{{ $category->id }}">
                            <div class="category-icon">
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                            </div>
                            <span class="category-name">{{ $category->name }}</span>
                        </a>
                    @empty
                        <p>No hay categorías disponibles</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Products Section -->
            <div class="products-section">
                <div class="section-header">
                    <h2 class="section-title">
                        @if(!empty($selectedCategoryId) && $categories->contains('id', $selectedCategoryId))
                            {{ $categories->firstWhere('id', $selectedCategoryId)->name }}
                        @else
                            Productos destacados
                        @endif
                    </h2>
                    <a href="{{ route('welcome') }}" class="view-all">
                        Ver todo
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="food-grid" id="products-container">
                    @php
                        // Asegurarse de que $products esté definida y sea iterable
                        $products = $products ?? [];
                        $products = is_iterable($products) ? $products : [];
                    @endphp
                    
                    @if(count($products) > 0)
                        @foreach($products as $index => $product)
                            @if(isset($product) && is_object($product))
                                <div class="food-card fade-in" style="animation-delay: {{ $index * 0.05 }}s;">
                                    @if(property_exists($product, 'is_new') && $product->is_new)
                                        <span class="food-badge">NUEVO</span>
                                    @endif
                                    <a href="/producto/{{ $product->slug }}" class="block">
                                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" 
                                             alt="{{ $product->name ?? 'Producto sin nombre' }}" 
                                             class="food-image"
                                             onerror="this.src='https://via.placeholder.com/300x200?text=Imagen+no+disponible'">
                                    </a>
                                    <div class="food-details">
                                        <h3 class="food-name">{{ $product->name ?? 'Producto sin nombre' }}</h3>
                                        <p class="food-description">{{ $product->description ?? 'Delicioso plato preparado con los mejores ingredientes' }}</p>
                                        <div class="food-footer">
                                            <span class="food-price">$ {{ isset($product->price) ? number_format($product->price, 0, ',', '.') : '0,00' }}</span>
                                            <div class="flex space-x-2">
                                                <a href="/producto/{{ $product->slug }}" 
                                                   class="view-details-btn">
                                                    <i class="fas fa-eye mr-1"></i> Ver
                                                </a>
                                                <button class="add-to-cart" data-product-id="{{ $product->id ?? '' }}">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-span-2 text-center py-12">
                            <p>No hay productos disponibles en este momento.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
    
    <!-- Add Bottom Navigation -->
    <x-bottom-nav />
    
    @push('scripts')
    <script>
        // El código JavaScript se mantiene exactamente igual
        document.addEventListener('DOMContentLoaded', function() {
            // Store the current category ID
            let currentCategoryId = '{{ request('category') }}';
            
            // Add click event to category items
            document.querySelectorAll('.category-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Get category ID from data attribute
                    const categoryId = this.getAttribute('data-category-id');
                    
                    // If clicking the same category, do nothing
                    if (categoryId === currentCategoryId) return;
                    
                    // Update current category
                    currentCategoryId = categoryId;
                    
                    // Update active state
                    updateActiveCategory(categoryId);
                    
                    // Update section title
                    updateSectionTitle(categoryId);
                    
                    // Show loading state
                    showLoadingState();
                    
                    // Fetch products for the selected category
                    fetchProducts(categoryId);
                });
            });
            
            // Function to update active category styling
            function updateActiveCategory(categoryId) {
                // Remove active class from all category items
                document.querySelectorAll('.category-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add active class to selected category
                const selectedItem = document.querySelector(`.category-item[data-category-id="${categoryId}"]`);
                if (selectedItem) {
                    selectedItem.classList.add('active');
                    
                    // Scroll category into view
                    selectedItem.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            }
            
            // Function to update section title
            function updateSectionTitle(categoryId) {
                const sectionTitle = document.querySelector('.section-title');
                if (!sectionTitle) return;
                
                if (categoryId) {
                    const categoryItem = document.querySelector(`.category-item[data-category-id="${categoryId}"]`);
                    if (categoryItem) {
                        const categoryName = categoryItem.querySelector('.category-name').textContent;
                        sectionTitle.textContent = categoryName;
                        return;
                    }
                }
                
                sectionTitle.textContent = 'Productos destacados';
            }
            
            // Function to show loading state
            function showLoadingState() {
                const productsContainer = document.getElementById('products-container');
                if (!productsContainer) return;
                
                // Create loading skeleton
                let loadingHTML = '';
                for (let i = 0; i < 4; i++) {
                    loadingHTML += `
                        <div class="food-card">
                            <div class="loading-shimmer" style="height: 120px; width: 100%; margin-bottom: 10px;"></div>
                            <div class="food-details">
                                <div class="loading-shimmer" style="height: 20px; width: 80%; margin-bottom: 8px;"></div>
                                <div class="loading-shimmer" style="height: 16px; width: 100%; margin-bottom: 8px;"></div>
                                <div class="food-footer">
                                    <div class="loading-shimmer" style="height: 24px; width: 60px;"></div>
                                    <div class="loading-shimmer" style="height: 32px; width: 32px; border-radius: 8px;"></div>
                                </div>
                            </div>
                        </div>
                    `;
                }
                
                productsContainer.innerHTML = loadingHTML;
            }
            
            // Function to fetch products by category
            function fetchProducts(categoryId) {
                // Update URL without page reload
                const url = new URL(window.location.href);
                
                if (categoryId) {
                    url.searchParams.set('category', categoryId);
                } else {
                    url.searchParams.delete('category');
                }
                
                // Update browser history
                window.history.pushState({}, '', url);
                
                // Show loading state
                showLoadingState();
                
                // Make an AJAX request to get filtered products
                fetch(`/filter-products?category_id=${categoryId || ''}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al cargar los productos');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Update the products container with the new products
                        updateProductsContainer(data.products);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showErrorState();
                    });
            }
            
            // Function to show error state
            function showErrorState() {
                const productsContainer = document.getElementById('products-container');
                if (!productsContainer) return;
                
                productsContainer.innerHTML = `
                    <div class="col-span-2 text-center py-12">
                        <p class="text-red-500">Error al cargar los productos. Por favor, inténtalo de nuevo.</p>
                        <button onclick="window.location.reload()" class="mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            Reintentar
                        </button>
                    </div>
                `;
            }
            
            // Function to update the products container with new products
            function updateProductsContainer(products) {
                const productsContainer = document.getElementById('products-container');
                if (!productsContainer) return;
                
                if (products.length === 0) {
                    productsContainer.innerHTML = `
                        <div class="col-span-2 text-center py-12">
                            <p>No hay productos disponibles en esta categoría.</p>
                        </div>
                    `;
                    return;
                }
                
                // Generate HTML for products
                let productsHTML = '';
                products.forEach((product, index) => {
                    productsHTML += `
                        <div class="food-card fade-in" style="animation-delay: ${index * 0.05}s;">
                            ${product.is_new ? '<span class="food-badge">NUEVO</span>' : ''}
                            <a href="/producto/${product.slug}" class="block">
                                <img src="${product.image_url || 'https://via.placeholder.com/300x200'}" 
                                     alt="${product.name}" 
                                     class="food-image"
                                     onerror="this.src='https://via.placeholder.com/300x200?text=Imagen+no+disponible'">
                            </a>
                            <div class="food-details">
                                <h3 class="food-name">${product.name}</h3>
                                <p class="food-description">${product.description || 'Delicioso plato preparado con los mejores ingredientes'}</p>
                                <div class="food-footer">
                                    <span class="food-price">$${parseFloat(product.price).toFixed(2)}</span>
                                    <div class="flex space-x-2">
                                        <a href="/producto/${product.slug}" 
                                           class="view-details-btn">
                                            <i class="fas fa-eye mr-1"></i> Ver
                                        </a>
                                        <button class="add-to-cart" data-product-id="${product.id}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                // Update the container
                productsContainer.innerHTML = productsHTML;
                
                // Re-attach event listeners to the new add-to-cart buttons
                attachAddToCartListeners();
                
                // Scroll to products section smoothly
                setTimeout(() => {
                    document.querySelector('.products-section').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                }, 100);
            }
            
            // Function to attach event listeners to add-to-cart buttons
            function attachAddToCartListeners() {
                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const productId = this.getAttribute('data-product-id');
                        
                        // Here you would add the product to the cart
                        console.log('Agregar al carrito:', productId);
                        
                        // Visual feedback
                        const button = this;
                        button.innerHTML = '<i class="fas fa-check"></i>';
                        button.style.backgroundColor = '#2ECC71';
                        
                        setTimeout(() => {
                            button.innerHTML = '<i class="fas fa-plus"></i>';
                            button.style.backgroundColor = '';
                        }, 1000);
                    });
                });
            }
            
            // Initial attachment of event listeners
            attachAddToCartListeners();
            
            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const categoryId = urlParams.get('category') || '';
                
                if (categoryId !== currentCategoryId) {
                    currentCategoryId = categoryId;
                    updateActiveCategory(categoryId);
                    updateSectionTitle(categoryId);
                    showLoadingState();
                    fetchProducts(categoryId);
                }
            });
            
            // Smooth scroll for categories
            const categories = document.querySelector('.categories');
            if (categories) {
                categories.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    categories.scrollLeft += e.deltaY;
                });
            }
            
            // Initialize active category if coming from a direct link
            @if(request('category'))
                const initialCategoryId = '{{ request('category') }}';
                updateActiveCategory(initialCategoryId);
                updateSectionTitle(initialCategoryId);
            @endif
        });
    </script>
    @endpush
</x-app-layout>