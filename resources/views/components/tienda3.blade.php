<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allaletera - Tienda Veneciana</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, var(--venice-blue) 0%, #081d21 100%);
            color: var(--light);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }
        
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: rgba(10, 46, 54, 0.95);
            min-height: 100vh;
            box-shadow: 0 0 80px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            padding-bottom: 80px;
        }
        
        .app-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 10% 20%, rgba(20, 184, 198, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(212, 175, 55, 0.08) 0%, transparent 40%);
            z-index: 0;
            pointer-events: none;
        }
        
        .app-header {
            position: sticky;
            top: 0;
            width: 100%;
            max-width: 480px;
            z-index: 50;
            background: var(--venice-blue);
            padding: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            border-bottom-left-radius: var(--border-radius-sm);
            border-bottom-right-radius: var(--border-radius-sm);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--venice-gold-light);
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: var(--gold-glow);
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 800;
            font-size: 1.3rem;
            box-shadow: var(--glow);
        }
        
        .gold-accent {
            color: var(--venice-gold);
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.6);
        }

        .header-icons {
            font-size: 1.3rem;
        }

        .header-icons i {
            margin-left: 20px;
            color: var(--venice-gold);
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .header-icons i:hover {
            color: var(--venice-accent);
        }
        
        .main-content {
            padding: 24px 16px 0;
            z-index: 10;
            position: relative;
        }
        
        .hero {
            margin-bottom: 30px;
            padding: 10px 0;
        }
        
        .hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--venice-gold-light);
        }
        
        .hero p {
            color: var(--venice-light);
            font-size: 1rem;
            font-weight: 400;
            opacity: 0.8;
            font-family: 'Inter', sans-serif;
        }
        
        .categories-container {
            margin: 0 -16px;
            padding: 0 0 10px 0;
            border-bottom: 2px solid rgba(0, 194, 203, 0.1);
            margin-bottom: 20px;
            position: relative;
        }

        .categories {
            display: flex;
            overflow-x: auto;
            padding: 0 16px;
            scrollbar-width: none;
            gap: 12px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            cursor: grab;
        }

        .categories::-webkit-scrollbar {
            display: none;
        }

        .categories-container::before,
        .categories-container::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 10px;
            width: 20px;
            pointer-events: none;
            z-index: 2;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .categories-container::before {
            left: 0;
            background: linear-gradient(to right, var(--venice-blue), transparent);
        }

        .categories-container::after {
            right: 0;
            background: linear-gradient(to left, var(--venice-blue), transparent);
        }

        .categories-container.has-scroll-left::before {
            opacity: 1;
        }

        .categories-container.has-scroll-right::after {
            opacity: 1;
        }

        /* Scrollbar personalizada para PC */
        @media (min-width: 768px) {
            .categories {
                scrollbar-width: thin;
                scrollbar-color: var(--venice-accent) transparent;
            }

            .categories::-webkit-scrollbar {
                display: block;
                height: 6px;
            }

            .categories::-webkit-scrollbar-track {
                background: transparent;
                border-radius: 10px;
            }

            .categories::-webkit-scrollbar-thumb {
                background: var(--venice-accent);
                border-radius: 10px;
            }

            .categories::-webkit-scrollbar-thumb:hover {
                background: var(--venice-light);
            }
        }
        
        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--light);
            transition: all 0.3s ease;
            min-width: 90px;
            padding: 5px;
            border-radius: var(--border-radius-sm);
            background: rgba(0, 0, 0, 0.05);
            cursor: pointer;
            flex-shrink: 0;
        }

        .category-item:hover {
            background: rgba(0, 194, 203, 0.1);
            transform: translateY(-2px);
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--venice-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            box-shadow: var(--shadow-teal);
            overflow: hidden;
        }
        
        .category-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .category-item.active .category-icon {
            background: linear-gradient(135deg, var(--venice-gold), #B8860B);
            transform: scale(1.05);
            box-shadow: var(--gold-glow);
            border-color: var(--venice-gold-light);
        }
        
        .category-name {
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            color: var(--venice-light);
            transition: color 0.3s ease;
            white-space: nowrap;
        }
        
        .category-item.active .category-name {
            color: var(--venice-gold);
            font-weight: 700;
        }

        .category-item.active {
            background: rgba(212, 175, 55, 0.1);
        }
        
        .products-section {
            padding-bottom: 24px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--venice-gold-light);
            margin: 0;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--venice-accent), var(--venice-gold));
            border-radius: 3px;
        }
        
        .view-all {
            font-size: 0.9rem;
            color: var(--venice-accent);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 10px;
            background: rgba(0, 194, 203, 0.15);
            border: 1px solid rgba(0, 194, 203, 0.3);
            transition: background 0.2s;
        }
        
        .view-all:hover {
            background: rgba(0, 194, 203, 0.3);
        }

        .view-all i {
            margin-left: 5px;
            font-size: 0.8em;
        }
        
        .food-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 15px;
        }
        
        .food-card {
            background: linear-gradient(145deg, rgba(13, 77, 90, 0.9), rgba(10, 46, 54, 0.95));
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-teal);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(0, 194, 203, 0.3);
            position: relative;
        }

        .view-details-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--venice-gold), #B8860B);
            color: var(--venice-blue);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3);
            font-size: 1rem;
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 4;
        }

        .view-details-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(212, 175, 55, 0.5);
            background: linear-gradient(135deg, var(--venice-gold-light), var(--venice-gold));
        }
        
        .food-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-teal), var(--glow);
        }
        
        .food-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-bottom: 1px solid rgba(0, 194, 203, 0.2);
            transition: transform 0.5s ease;
        }

        .food-card:hover .food-image {
            transform: scale(1.05);
        }
        
        .food-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--venice-gold);
            color: var(--venice-blue);
            font-size: 0.7rem;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            box-shadow: var(--gold-glow);
            z-index: 3;
            letter-spacing: 0.5px;
        }
        
        .food-details {
            padding: 16px;
        }
        
        .food-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: var(--venice-gold-light);
            line-height: 1.3;
        }
        
        .food-description {
            font-size: 0.85rem;
            color: var(--venice-light);
            margin: 0 0 16px 0;
            line-height: 1.4;
            opacity: 0.7;
            font-family: 'Inter', sans-serif;
            height: 38px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .food-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .food-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--venice-accent);
            text-shadow: 0 0 5px rgba(0, 194, 203, 0.3);
        }
        
        .add-to-cart {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 194, 203, 0.3);
            font-size: 1.1rem;
        }
        
        .add-to-cart:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 194, 203, 0.5);
        }

        .add-to-cart.success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            animation: pulse 0.5s ease;
        }
        
        .footer-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            background: var(--venice-blue);
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.5);
            border-top: 1px solid rgba(0, 194, 203, 0.2);
            z-index: 60;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top-left-radius: var(--border-radius-lg);
            border-top-right-radius: var(--border-radius-lg);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--venice-teal);
            transition: color 0.3s ease;
            padding: 5px;
            border-radius: 10px;
        }

        .nav-item i {
            font-size: 1.5rem;
            color: var(--venice-light);
            transition: color 0.3s ease;
        }

        .nav-item span {
            font-size: 0.7rem;
            margin-top: 4px;
            color: var(--venice-light);
            font-weight: 600;
        }

        .nav-item.active i, .nav-item:hover i {
            color: var(--venice-gold);
            text-shadow: var(--gold-glow);
        }

        .nav-item.active span, .nav-item:hover span {
            color: var(--venice-gold-light);
        }
        
        /* Modal del Carrito */
        .cart-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
            padding: 20px;
        }

        .cart-modal {
            background: linear-gradient(145deg, var(--venice-teal), var(--venice-blue));
            border-radius: var(--border-radius-lg);
            max-width: 450px;
            width: 100%;
            max-height: 85vh;
            overflow: hidden;
            box-shadow: var(--shadow-teal), var(--glow);
            animation: slideIn 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .cart-header {
            background: var(--venice-blue);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--venice-accent);
        }

        .cart-header h2 {
            color: var(--venice-gold-light);
            font-size: 1.5rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .close-cart {
            background: var(--venice-accent);
            color: var(--venice-blue);
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .close-cart:hover {
            transform: scale(1.1);
            background: var(--venice-light);
        }

        .cart-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 15px;
            border: 1px solid rgba(0, 194, 203, 0.3);
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .cart-item-image {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid var(--venice-accent);
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            color: var(--venice-gold-light);
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        .cart-item-price {
            color: var(--venice-accent);
            font-weight: 700;
            font-size: 1rem;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background: var(--venice-accent);
            color: var(--venice-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: var(--venice-light);
            transform: scale(1.1);
        }

        .quantity-display {
            color: var(--venice-gold-light);
            font-weight: 600;
            min-width: 30px;
            text-align: center;
        }

        .remove-item {
            background: #ef4444;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .remove-item:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        .cart-total {
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-top: 2px solid var(--venice-accent);
            border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .total-label {
            color: var(--venice-gold-light);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .total-amount {
            color: var(--venice-accent);
            font-size: 1.5rem;
            font-weight: 800;
            text-shadow: 0 0 5px rgba(0, 194, 203, 0.3);
        }

        .cart-actions {
            display: flex;
            gap: 10px;
        }

        .cart-btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .clear-cart {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .clear-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        .checkout-btn {
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 194, 203, 0.4);
        }

        .whatsapp-btn {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
        }

        .whatsapp-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: var(--venice-light);
        }

        .empty-cart i {
            font-size: 4rem;
            color: var(--venice-gold);
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .empty-cart h3 {
            color: var(--venice-gold-light);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .empty-cart p {
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .continue-shopping {
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .continue-shopping:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 194, 203, 0.4);
        }

        /* Modal de Información del Cliente */
        .customer-modal {
            background: linear-gradient(145deg, var(--venice-teal), var(--venice-blue));
            border-radius: var(--border-radius-lg);
            max-width: 450px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-teal), var(--glow);
            animation: slideIn 0.3s ease;
        }

        .customer-form {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: var(--venice-gold-light);
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid rgba(0, 194, 203, 0.3);
            border-radius: var(--border-radius-sm);
            background: rgba(255, 255, 255, 0.1);
            color: var(--light);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--venice-accent);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
            font-family: 'Inter', sans-serif;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .form-btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .cancel-btn {
            background: rgba(255, 255, 255, 0.1);
            color: var(--venice-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cancel-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: scale(0.9) translateY(-20px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(46, 204, 113, 0); }
            100% { transform: scale(1); }
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem;
            text-align: center;
        }

        .scroll-indicators {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
            display: none;
        }

        @media (min-width: 768px) {
            .scroll-indicators {
                display: flex;
            }
        }

        .scroll-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--venice-teal);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .scroll-dot.active {
            background: var(--venice-accent);
            transform: scale(1.2);
        }

        /* Notificación */
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
            color: var(--venice-blue);
            padding: 15px 20px;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow-teal);
            z-index: 3000;
            animation: slideInRight 0.3s ease;
            max-width: 300px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="app-container">
        
        <!-- Header -->
        <header class="app-header">
            <a href="/" class="logo">
                <div class="logo-icon">A</div>
                <span>Alla<span class="gold-accent">letera</span></span>
            </a>
            <div class="header-icons">
                <i class="fas fa-search"></i>
                <i class="fas fa-bell"></i>
                <div class="cart-icon-container" onclick="showCart()" style="position: relative; cursor: pointer;">
                    <i class="fas fa-shopping-cart" style="color: var(--venice-gold); font-size: 1.3rem;"></i>
                    <span class="cart-counter" style="position: absolute; top: -8px; right: -8px; background: var(--venice-accent); color: var(--venice-blue); border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: bold; display: none;">0</span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <div class="hero fade-in" style="animation-delay: 0s;">
                <h1>Sabores de la Serenísima</h1>
                <p>Una selección exquisita de la mejor gastronomía y artesanía veneciana, a un toque de distancia.</p>
            </div>
            
            <!-- Categories -->
            <div class="categories-container fade-in" style="animation-delay: 0.2s;">
                <div class="categories" id="categories-container">
                    <?php
                    // Conectar a la base de datos usando la clase personalizada
                    require_once app_path('Database/Conexion.php');
                    use App\Database\Conexion;

                    try {
                        $objConexion = new Conexion();

                        // Consultar categorías activas
                        $categorias = $objConexion->consultar("SELECT id, name, description, image FROM categories WHERE is_active = 1 ORDER BY name");

                        // Mostrar categorías directamente en PHP - "Todos" primero
                        echo '<div class="category-item active" data-category-id="all" onclick="filterByCategory(\'all\', this)">';
                        echo '<div class="category-icon">';
                        echo '<i class="fas fa-star" style="color: var(--venice-blue); font-size: 1.5rem;"></i>';
                        echo '</div>';
                        echo '<span class="category-name">Todos</span>';
                        echo '</div>';

                        if (!empty($categorias)) {
                            foreach ($categorias as $categoria) {
                                $imageUrl = $categoria['image'] ? '/storage/' . $categoria['image'] : '';
                                $hasImage = !empty($categoria['image']);
                                
                                echo '<div class="category-item" data-category-id="' . $categoria['id'] . '" onclick="filterByCategory(' . $categoria['id'] . ', this)">';
                                echo '<div class="category-icon">';
                                if ($hasImage && $imageUrl) {
                                    echo '<img src="' . $imageUrl . '" alt="' . htmlspecialchars($categoria['name']) . '" onerror="this.onerror=null; this.src=\'https://placehold.co/60x60/117A8A/F1E5AC?text=IMG\'">';
                                } else {
                                    echo '<i class="fas fa-utensils" style="color: var(--venice-blue); font-size: 1.5rem;"></i>';
                                }
                                echo '</div>';
                                echo '<span class="category-name">' . htmlspecialchars($categoria['name']) . '</span>';
                                echo '</div>';
                            }
                        }

                        // Consultar productos activos
                        $productos = $objConexion->consultar("SELECT id, name, description, price, image, category_id FROM products WHERE is_active = 1 ORDER BY name LIMIT 12");

                    } catch (Exception $e) {
                        echo '<div class="error-message">Error al cargar categorías: ' . $e->getMessage() . '</div>';
                        $categorias = [];
                        $productos = [];
                    }
                    ?>
                </div>
                <div class="scroll-indicators" id="scrollIndicators"></div>
            </div>
            
            <!-- Products Section -->
            <div class="products-section">
                <div class="section-header fade-in" style="animation-delay: 0.4s;">
                    <h2 class="section-title" id="section-title">Nuestras Recomendaciones</h2>
                    <a href="#" class="view-all">
                        Ver Menú Completo
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="food-grid" id="products-container">
                    <?php
                    // Mostrar productos directamente en PHP
                    if (!empty($productos)) {
                        foreach ($productos as $index => $producto) {
                            $imageUrl = $producto['image'] ? '/storage/' . $producto['image'] : 'https://placehold.co/500x120/117A8A/F1E5AC?text=ALLALETERA';
                            $isNew = rand(1, 5) == 1;
                            $animationDelay = $index * 0.08;
                            
                            echo '<div class="food-card fade-in product-item" data-category-id="' . $producto['category_id'] . '" style="animation-delay: ' . $animationDelay . 's">';
                            if ($isNew) {
                                echo '<span class="food-badge">NOVITÀ</span>';
                            }
                            echo '<a href="/producto/' . $producto['id'] . '" class="view-details-btn">';
                            echo '<i class="fas fa-eye"></i>';
                            echo '</a>';
                            echo '<img src="' . $imageUrl . '" alt="' . htmlspecialchars($producto['name']) . '" class="food-image" onerror="this.onerror=null; this.src=\'https://placehold.co/500x120/117A8A/F1E5AC?text=ALLALETERA\'">';
                            echo '<div class="food-details">';
                            echo '<h3 class="food-name">' . htmlspecialchars($producto['name']) . '</h3>';
                            echo '<p class="food-description">' . htmlspecialchars($producto['description'] ?? 'Producto delicioso') . '</p>';
                            echo '<div class="food-footer">';
                            echo '<span class="food-price">$' . number_format($producto['price'], 2) . '</span>';
                            echo '<button type="button" class="add-to-cart" data-product-id="' . $producto['id'] . '" onclick="addToCart(' . $producto['id'] . ', \'' . addslashes($producto['name']) . '\', ' . $producto['price'] . ', \'' . $imageUrl . '\', ' . $producto['category_id'] . ')">';
                            echo '<i class="fas fa-plus"></i>';
                            echo '</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">';
                        echo '<i class="fas fa-box-open" style="font-size: 4rem; color: var(--venice-light); opacity: 0.5; margin-bottom: 1rem;"></i>';
                        echo '<h3 style="color: var(--venice-gold-light); margin-bottom: 0.5rem;">No hay productos disponibles</h3>';
                        echo '<p style="color: var(--venice-light); opacity: 0.7;">Pronto agregaremos más productos a esta categoría.</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </main>

        <!-- Footer Navigation -->
        <footer class="footer-nav">
            <a href="#" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-box-open"></i>
                <span>Pedidos</span>
            </a>
            <a href="#" class="nav-item" onclick="showCart(); return false;">
                <i class="fas fa-shopping-cart"></i>
                <span>Carrito</span>
                <div class="cart-counter-nav" style="position: absolute; top: -5px; right: -5px; background: var(--venice-accent); color: var(--venice-blue); border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; font-weight: bold; display: none;">0</div>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>
        </footer>
    </div>

    <script>
        // Funcionalidad básica del carrito
        let cart = [];
        let currentCategory = 'all';

        // Inicializar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar carrito desde localStorage si existe
            const savedCart = localStorage.getItem('tienda_cart');
            if (savedCart) {
                try {
                    cart = JSON.parse(savedCart);
                    updateCartCounter();
                } catch (e) {
                    cart = [];
                    console.error('Error parsing cart:', e);
                    localStorage.removeItem('tienda_cart');
                }
            }

            // Inicializar indicadores de scroll
            updateScrollIndicators();
            initScrollIndicators();

            // Event listeners para scroll de categorías
            const categoriesContainer = document.getElementById('categories-container');
            if (categoriesContainer) {
                categoriesContainer.addEventListener('scroll', updateScrollIndicators);
                
                // Drag scrolling para PC
                let isDragging = false;
                let startX;
                let scrollLeft;

                categoriesContainer.addEventListener('mousedown', (e) => {
                    isDragging = true;
                    categoriesContainer.style.cursor = 'grabbing';
                    startX = e.pageX - categoriesContainer.offsetLeft;
                    scrollLeft = categoriesContainer.scrollLeft;
                });

                categoriesContainer.addEventListener('mouseleave', () => {
                    isDragging = false;
                    categoriesContainer.style.cursor = 'grab';
                });

                categoriesContainer.addEventListener('mouseup', () => {
                    isDragging = false;
                    categoriesContainer.style.cursor = 'grab';
                });

                categoriesContainer.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    e.preventDefault();
                    const x = e.pageX - categoriesContainer.offsetLeft;
                    const walk = (x - startX) * 2;
                    categoriesContainer.scrollLeft = scrollLeft - walk;
                });

                // Wheel scrolling para PC
                categoriesContainer.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    categoriesContainer.scrollLeft += e.deltaY;
                });
            }

            // Soporte para redimensionamiento de ventana
            window.addEventListener('resize', function() {
                updateScrollIndicators();
                initScrollIndicators();
            });
        });

        // Función para inicializar indicadores de scroll
        function initScrollIndicators() {
            const categoriesContainer = document.getElementById('categories-container');
            const scrollIndicators = document.getElementById('scrollIndicators');
            
            if (!categoriesContainer || !scrollIndicators) return;

            const categoryItems = categoriesContainer.querySelectorAll('.category-item');
            const visibleItems = Math.floor(categoriesContainer.clientWidth / 102); // 90px + 12px gap
            
            scrollIndicators.innerHTML = '';
            
            for (let i = 0; i < Math.ceil(categoryItems.length / visibleItems); i++) {
                const dot = document.createElement('div');
                dot.className = 'scroll-dot' + (i === 0 ? ' active' : '');
                dot.addEventListener('click', () => {
                    scrollToCategoryPage(i, visibleItems);
                });
                scrollIndicators.appendChild(dot);
            }
        }

        // Función para desplazar a página específica
        function scrollToCategoryPage(page, itemsPerPage) {
            const categoriesContainer = document.getElementById('categories-container');
            const categoryItems = categoriesContainer.querySelectorAll('.category-item');
            const itemWidth = 102; // 90px + 12px gap
            
            categoriesContainer.scrollTo({
                left: page * itemsPerPage * itemWidth,
                behavior: 'smooth'
            });
            
            // Actualizar dots activos
            document.querySelectorAll('.scroll-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === page);
            });
        }

        // Función para actualizar indicadores de scroll
        function updateScrollIndicators() {
            const categoriesContainer = document.getElementById('categories-container');
            const containerWrapper = document.querySelector('.categories-container');

            if (!categoriesContainer || !containerWrapper) return;

            const scrollLeft = categoriesContainer.scrollLeft;
            const scrollWidth = categoriesContainer.scrollWidth;
            const clientWidth = categoriesContainer.clientWidth;

            const hasScrollLeft = scrollLeft > 0;
            const hasScrollRight = scrollLeft < (scrollWidth - clientWidth - 1);

            containerWrapper.classList.toggle('has-scroll-left', hasScrollLeft);
            containerWrapper.classList.toggle('has-scroll-right', hasScrollRight);

            // Actualizar indicadores de página
            const categoryItems = categoriesContainer.querySelectorAll('.category-item');
            const itemWidth = 102;
            const currentPage = Math.round(scrollLeft / (itemWidth * Math.floor(categoriesContainer.clientWidth / itemWidth)));
            
            document.querySelectorAll('.scroll-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentPage);
            });
        }

        // Función para filtrar por categoría
        function filterByCategory(categoryId, element) {
            // Actualizar categoría activa
            document.querySelectorAll('.category-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
            
            currentCategory = categoryId;

            // Actualizar título de sección
            const categoryName = element.querySelector('.category-name').textContent;
            document.getElementById('section-title').textContent = categoryName === 'Todos' ? 'Nuestras Recomendaciones' : categoryName;

            // Filtrar productos
            const productItems = document.querySelectorAll('.product-item');
            
            productItems.forEach(item => {
                if (categoryId === 'all' || item.getAttribute('data-category-id') == categoryId) {
                    item.style.display = 'block';
                    // Re-aplicar animación
                    item.style.animation = 'none';
                    setTimeout(() => {
                        item.style.animation = 'fadeIn 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards';
                    }, 10);
                } else {
                    item.style.display = 'none';
                }
            });

            // Scroll suave hacia la categoría seleccionada (solo si no está completamente visible)
            const container = document.getElementById('categories-container');
            const itemRect = element.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();

            if (itemRect.left < containerRect.left || itemRect.right > containerRect.right) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }

        // Función para agregar al carrito
        function addToCart(productId, name, price, imageUrl, categoryId) {
            const product = {
                id: productId,
                nombre: name,
                valor: price,
                cantidad: 1,
                subtotal: price,
                imagen: imageUrl,
                id_categoria: categoryId,
                id_cliente: 1,
                id_empleado: 25,
                id_sucursal: 1,
                pedido_numero: 360,
                fecha: new Date().toISOString().slice(0, 19).replace('T', ' '),
                pedido_nota2: '',
                pedido_nota3: 'tienda'
            };

            // Verificar si el producto ya está en el carrito
            const existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.cantidad += 1;
                existingProduct.subtotal = existingProduct.cantidad * existingProduct.valor;
            } else {
                cart.push(product);
            }

            // Guardar en localStorage
            localStorage.setItem('tienda_cart', JSON.stringify(cart));

            // Actualizar contador del carrito
            updateCartCounter();

            // Feedback visual
            const button = document.querySelector(`.add-to-cart[data-product-id="${productId}"]`);
            if (button) {
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

                setTimeout(() => {
                    button.innerHTML = originalIcon;
                    button.style.background = '';
                }, 1000);
            }

            // Mostrar notificación
            showNotification(`¡${name} agregado al carrito!`);
        }

        // Función para mostrar notificación
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(notification);

            // Remover después de 3 segundos
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Función para actualizar contador del carrito
        function updateCartCounter() {
            const cartCounters = document.querySelectorAll('.cart-counter, .cart-counter-nav');
            cartCounters.forEach(counter => {
                const totalItems = cart.reduce((sum, item) => sum + item.cantidad, 0);
                counter.textContent = totalItems;
                counter.style.display = totalItems > 0 ? 'flex' : 'none';
            });
        }

        // Función para mostrar el carrito
        function showCart() {
            // Crear modal del carrito
            const modal = document.createElement('div');
            modal.className = 'cart-modal-overlay';
            modal.innerHTML = `
                <div class="cart-modal">
                    <div class="cart-header">
                        <h2><i class="fas fa-shopping-cart"></i> Tu Carrito de Compras</h2>
                        <button class="close-cart" onclick="closeCart()">×</button>
                    </div>
                    <div class="cart-content">
                        ${cart.length === 0 ? `
                            <div class="empty-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <h3>Tu carrito está vacío</h3>
                                <p>¡Agrega algunos productos deliciosos para comenzar!</p>
                                <button class="continue-shopping" onclick="closeCart()">
                                    <i class="fas fa-arrow-left"></i> Continuar Comprando
                                </button>
                            </div>
                        ` : `
                            <div class="cart-items">
                                ${cart.map((item, index) => `
                                    <div class="cart-item">
                                        <img src="${item.imagen}" alt="${item.nombre}" class="cart-item-image" onerror="this.src='https://placehold.co/60x60/117A8A/F1E5AC?text=IMG'">
                                        <div class="cart-item-details">
                                            <div class="cart-item-name">${item.nombre}</div>
                                            <div class="cart-item-price">$${item.valor.toFixed(2)}</div>
                                        </div>
                                        <div class="cart-item-controls">
                                            <button class="quantity-btn" onclick="updateCartItemQuantity(${index}, -1)">-</button>
                                            <span class="quantity-display">${item.cantidad}</span>
                                            <button class="quantity-btn" onclick="updateCartItemQuantity(${index}, 1)">+</button>
                                            <button class="remove-item" onclick="removeCartItem(${index})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        `}
                    </div>
                    ${cart.length > 0 ? `
                        <div class="cart-total">
                            <div class="total-row">
                                <span class="total-label">Total:</span>
                                <span class="total-amount">$${cart.reduce((sum, item) => sum + item.subtotal, 0).toFixed(2)}</span>
                            </div>
                            <div class="cart-actions">
                                <button class="cart-btn clear-cart" onclick="clearCart()">
                                    <i class="fas fa-trash"></i> Vaciar Carrito
                                </button>
                                <button class="cart-btn whatsapp-btn" onclick="showCustomerForm()">
                                    <i class="fab fa-whatsapp"></i> Enviar por WhatsApp
                                </button>
                            </div>
                        </div>
                    ` : ''}
                </div>
            `;

            document.body.appendChild(modal);

            // Cerrar modal al hacer click fuera
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeCart();
                }
            });

            // Cerrar con tecla Escape
            document.addEventListener('keydown', function closeOnEscape(e) {
                if (e.key === 'Escape') {
                    closeCart();
                    document.removeEventListener('keydown', closeOnEscape);
                }
            });
        }

        // Función para cerrar el carrito
        function closeCart() {
            const modal = document.querySelector('.cart-modal-overlay');
            if (modal) {
                modal.remove();
            }
        }

        // Función para actualizar cantidad de item en carrito
        function updateCartItemQuantity(index, change) {
            if (cart[index]) {
                cart[index].cantidad += change;
                
                if (cart[index].cantidad < 1) {
                    cart[index].cantidad = 1;
                }
                
                cart[index].subtotal = cart[index].cantidad * cart[index].valor;
                
                localStorage.setItem('tienda_cart', JSON.stringify(cart));
                updateCartCounter();
                
                // Actualizar la vista del carrito si está abierto
                const modal = document.querySelector('.cart-modal-overlay');
                if (modal) {
                    closeCart();
                    showCart();
                }
            }
        }

        // Función para remover item del carrito
        function removeCartItem(index) {
            if (cart[index]) {
                cart.splice(index, 1);
                localStorage.setItem('tienda_cart', JSON.stringify(cart));
                updateCartCounter();
                
                // Actualizar la vista del carrito si está abierto
                const modal = document.querySelector('.cart-modal-overlay');
                if (modal) {
                    closeCart();
                    showCart();
                }
            }
        }

        // Función para vaciar carrito
        function clearCart() {
            if (confirm('¿Estás seguro de que quieres vaciar el carrito?')) {
                cart = [];
                localStorage.removeItem('tienda_cart');
                updateCartCounter();
                closeCart();
                showCart();
            }
        }

        // Función para mostrar formulario de información del cliente
        function showCustomerForm() {
            closeCart();
            
            const modal = document.createElement('div');
            modal.className = 'cart-modal-overlay';
            modal.innerHTML = `
                <div class="customer-modal">
                    <div class="cart-header">
                        <h2><i class="fas fa-user"></i> Información del Pedido</h2>
                        <button class="close-cart" onclick="closeCart()">×</button>
                    </div>
                    <div class="customer-form">
                        <div class="form-group">
                            <label for="customerName"><i class="fas fa-user"></i> Nombre Completo *</label>
                            <input type="text" id="customerName" placeholder="Ingresa tu nombre completo" required>
                        </div>
                        <div class="form-group">
                            <label for="customerPhone"><i class="fas fa-phone"></i> Teléfono *</label>
                            <input type="tel" id="customerPhone" placeholder="Ingresa tu número de teléfono" required>
                        </div>
                        <div class="form-group">
                            <label for="customerAddress"><i class="fas fa-map-marker-alt"></i> Dirección de Entrega</label>
                            <input type="text" id="customerAddress" placeholder="Dirección donde entregar el pedido">
                        </div>
                        <div class="form-group">
                            <label for="customerNotes"><i class="fas fa-sticky-note"></i> Notas Adicionales</label>
                            <textarea id="customerNotes" placeholder="Instrucciones especiales, alergias, etc."></textarea>
                        </div>
                        <div class="form-actions">
                            <button class="form-btn cancel-btn" onclick="closeCart()">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <button class="form-btn whatsapp-btn" onclick="sendWhatsAppOrder()">
                                <i class="fab fa-whatsapp"></i> Enviar Pedido
                            </button>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // Cerrar modal al hacer click fuera
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeCart();
                }
            });
        }

        // Función para enviar pedido por WhatsApp
        function sendWhatsAppOrder() {
            const customerName = document.getElementById('customerName').value.trim();
            const customerPhone = document.getElementById('customerPhone').value.trim();
            const customerAddress = document.getElementById('customerAddress').value.trim();
            const customerNotes = document.getElementById('customerNotes').value.trim();

            // Validaciones
            if (!customerName) {
                showNotification('Por favor ingresa tu nombre completo');
                document.getElementById('customerName').focus();
                return;
            }

            if (!customerPhone) {
                showNotification('Por favor ingresa tu número de teléfono');
                document.getElementById('customerPhone').focus();
                return;
            }

            // Formatear el mensaje para WhatsApp
            const total = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const phoneNumber = '573128658195'; // Número de WhatsApp (Colombia)
            
            let message = `¡Hola! Quiero hacer un pedido:\n\n`;
            message += `*Información del Cliente:*\n`;
            message += `📝 Nombre: ${customerName}\n`;
            message += `📞 Teléfono: ${customerPhone}\n`;
            if (customerAddress) {
                message += `📍 Dirección: ${customerAddress}\n`;
            }
            if (customerNotes) {
                message += `📋 Notas: ${customerNotes}\n`;
            }
            
            message += `\n*Pedido:*\n`;
            cart.forEach((item, index) => {
                message += `${index + 1}. ${item.nombre} x${item.cantidad} - $${item.subtotal.toFixed(2)}\n`;
            });
            
            message += `\n*Total: $${total.toFixed(2)}*\n\n`;
            message += `¡Gracias! 🛍️`;

            // Codificar el mensaje para URL
            const encodedMessage = encodeURIComponent(message);
            
            // Crear URL de WhatsApp
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
            
            // Abrir WhatsApp
            window.open(whatsappUrl, '_blank');
            
            // Mostrar confirmación
            showNotification('¡Redirigiendo a WhatsApp!');
            
            // Cerrar modal después de un tiempo
            setTimeout(() => {
                closeCart();
                
                // Opcional: Limpiar carrito después de enviar
                cart = [];
                localStorage.removeItem('tienda_cart');
                updateCartCounter();
            }, 2000);
        }
    </script>
</body>
</html>