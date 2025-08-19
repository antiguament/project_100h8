<x-app-layout>
    @push('styles')
    <style>
        :root {
            --primary: #FF6B6B;
            --primary-dark: #E64A4A;
            --secondary: #4ECDC4;
            --accent: #FFD166;
            --dark: #2D3436;
            --light: #F8F9FA;
            --gray: #A4B0BE;
            --light-gray: #F1F2F6;
            --success: #2ECC71;
            --warning: #FF9F43;
            --danger: #FF6B6B;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.12);
            --border-radius: 16px;
            --border-radius-sm: 10px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
        }
        
        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }
        
        /* App Container */
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: white;
            position: relative;
            min-height: 100vh;
        }
        
        /* Header */
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: white;
            padding: 12px 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            max-width: 480px;
            margin: 0 auto;
        }
        
        .app-header .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--dark);
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 800;
            font-size: 1.1rem;
        }
        
        /* Main Content */
        .main-content {
            padding: 80px 16px 140px; /* Update padding to accommodate bottom navigation */
            max-width: 480px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* Categories */
        .categories-container {
            position: relative;
            margin: 0 -16px;
            padding: 0 16px;
            background: white;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
            color: var(--dark);
            transition: all 0.3s ease;
            min-width: 80px;
            padding: 8px 0;
            position: relative;
            z-index: 1;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
            border: 2px solid transparent;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .category-item.active .category-icon {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(255, 107, 107, 0.3);
            border-color: white;
        }
        
        .category-name {
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            color: var(--gray);
            transition: all 0.3s ease;
        }
        
        .category-item.active .category-name {
            color: var(--primary);
            font-weight: 700;
            transform: scale(1.05);
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
            color: var(--dark);
            margin: 0;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }
        
        .view-all {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 4px 8px;
            border-radius: 6px;
        }
        
        .view-all:hover {
            background: rgba(255, 107, 107, 0.1);
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
        
        .food-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .food-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Loading Animation */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
            border-radius: 8px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .food-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
            
            .category-icon {
                width: 56px;
                height: 56px;
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
        
        .view-details-btn {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 4px 8px;
            border-radius: 6px;
        }
        
        .view-details-btn:hover {
            background: rgba(255, 107, 107, 0.1);
        }
        
        .view-details-btn i {
            margin-left: 6px;
            transition: transform 0.3s ease;
        }
        
        .view-details-btn:hover i {
            transform: translateX(4px);
        }
    </style>
    @endpush

    <div class="app-container">
        <!-- Header -->
        <header class="app-header">
            <a href="/" class="logo">
                <div class="logo-icon">A</div>
                <span>Alla<span style="color: var(--primary);">letera</span></span>
            </a>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <div class="hero">
                <h1 class="text-2xl font-bold mb-2">¡Bienvenido a Allaletera!</h1>
                <p class="text-gray-600 mb-6">Los mejores productos a tu alcance</p>
            </div>
            
            <!-- Categories -->
            <div class="categories-container">
                <div class="categories">
                    @forelse($categories as $category)
                        <a href="#" 
                           class="category-item {{ request('category') == $category->id ? 'active' : '' }}" 
                           data-category-id="{{ $category->id }}">
                            <div class="category-icon">
                                <i class="fas {{ $category->icon ?? 'fa-utensils' }}"></i>
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
                        @if(request('category'))
                            {{ $categories->firstWhere('id', request('category'))?->name ?? 'Productos' }}
                        @else
                            Productos destacados
                        @endif
                    </h2>
                    <a href="#" class="view-all">
                        Ver todo
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="food-grid" id="products-container">
                    @forelse($products as $index => $product)
                        <div class="food-card fade-in" style="animation-delay: {{ $index * 0.05 }}s;">
                            @if($product->is_new)
                                <span class="food-badge">NUEVO</span>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="block">
                                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" 
                                     alt="{{ $product->name }}" 
                                     class="food-image"
                                     onerror="this.src='https://via.placeholder.com/300x200?text=Imagen+no+disponible'">
                            </a>
                            <div class="food-details">
                                <h3 class="food-name">{{ $product->name }}</h3>
                                <p class="food-description">{{ $product->description ?? 'Delicioso plato preparado con los mejores ingredientes' }}</p>
                                <div class="food-footer">
                                    <span class="food-price">$ {{ number_format($product->price, 2) }}</span>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('products.show', $product) }}" 
                                           class="view-details-btn">
                                            <i class="fas fa-eye mr-1"></i> Ver
                                        </a>
                                        <button class="add-to-cart" data-product-id="{{ $product->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12">
                            <p>No hay productos disponibles en esta categoría.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
    
    <!-- Add Bottom Navigation -->
    <x-bottom-nav />
    
    @push('scripts')
    <script>
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
                            <a href="{{ route('products.show', $product) }}" class="block">
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
                                        <a href="{{ route('products.show', $product) }}" 
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