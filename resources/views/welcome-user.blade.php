<x-layout meta-title="inicio" meta-description="home description">

    <!-- Personalized greeting for logged-in users -->
    <div class="user-welcome-banner">
        <div class="welcome-content">
            <div class="welcome-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="welcome-text">
                <h1 class="welcome-title">¡Hola, {{ Auth::user()->name }}!</h1>
                <p class="welcome-subtitle">Bienvenido de nuevo a {{ config('app.name') }}</p>
            </div>
            <div class="welcome-actions">
                <a href="{{ route('profile.edit') }}" class="btn-welcome-icon" title="Editar Perfil">
                    <i class="fas fa-user-edit"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-welcome-icon" title="Cerrar Sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <br><br><br><br>
    <x-tienda />
                
    </div>

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

/* Welcome Banner Styles */
.user-welcome-banner {
    position: relative;
    background: linear-gradient(135deg, var(--venice-blue) 0%, var(--venice-teal) 100%);
    color: var(--venice-gold-light);
    padding: 2rem 1rem;
    margin-bottom: 2rem;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-teal);
    overflow: hidden;
}

.user-welcome-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(20, 184, 198, 0.1) 0%, transparent 50%),
               radial-gradient(circle at 80% 20%, rgba(212, 175, 55, 0.08) 0%, transparent 50%);
    z-index: 1;
}

.welcome-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.welcome-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--venice-light), var(--venice-accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--venice-blue);
    font-size: 2.5rem;
    box-shadow: var(--glow);
    flex-shrink: 0;
}

.welcome-text {
    flex: 1;
}

.welcome-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    color: var(--venice-gold-light);
    text-shadow: var(--gold-glow);
}

.welcome-subtitle {
    font-size: 1.1rem;
    margin: 0;
    color: var(--venice-light);
    opacity: 0.9;
    font-family: 'Inter', sans-serif;
}

.welcome-actions {
    display: flex;
    gap: 1rem;
    flex-shrink: 0;
}

.btn-welcome-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    border: none;
    cursor: pointer;
    text-decoration: none;
    color: var(--venice-blue);
    background: linear-gradient(135deg, var(--venice-gold), var(--venice-gold-light));
    box-shadow: var(--gold-glow);
}

.btn-welcome-icon:hover {
    transform: scale(1.1) translateY(-2px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.6);
}

.btn-welcome-icon:last-child {
    background: rgba(20, 184, 198, 0.1);
    border: 1px solid rgba(20, 184, 198, 0.3);
    color: var(--venice-light);
}

.btn-welcome-icon:last-child:hover {
    background: rgba(20, 184, 198, 0.2);
    box-shadow: 0 4px 15px rgba(0, 194, 203, 0.3);
}

.logout-form {
    margin: 0;
}

:root {
    --primary-color: #E63946;
    --primary-light: #FF6B6B;
    --secondary-color: #2A9D8F;
    --dark-color: #1D3557;
    --light-color: #F1FAEE;
    --success-color: #2A9D8F;
    --warning-color: #F4A261;
    --danger-color: #E76F51;
    --gray-color: #495057;
    --light-gray: #E9ECEF;
    --border-radius: 12px;
    --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

.dashboard-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

/* Estilos para la barra superior */
.user-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.user-greeting {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.avatar {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
}

.user-greeting h1 {
    font-size: 1.75rem;
    margin: 0;
    color: var(--dark-color);
}

.user-actions {
    display: flex;
    gap: 1rem;
}

.btn-profile, .btn-logout {
    padding: 0.6rem 1.2rem;
    border-radius: 50px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
    border: none;
    cursor: pointer;
}

.btn-profile {
    background: var(--primary-color);
    color: white;
}

.btn-profile:hover {
    background: #C1121F;
    transform: translateY(-2px);
}

.btn-logout {
    background: var(--light-gray);
    color: var(--gray-color);
}

.btn-logout:hover {
    background: #DEE2E6;
    transform: translateY(-2px);
}

/* Tarjetas de resumen */
.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}

.summary-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    border-left: 4px solid transparent;
}

.summary-card:hover {
    transform: translateY(-5px);
}

.summary-card.primary {
    border-left-color: var(--primary-color);
}

.summary-card.success {
    border-left-color: var(--success-color);
}

.summary-card.warning {
    border-left-color: var(--warning-color);
}

.card-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.primary .card-icon { background: var(--primary-color); }
.success .card-icon { background: var(--success-color); }
.warning .card-icon { background: var(--warning-color); }

.card-info h3 {
    margin: 0;
    font-size: 1.75rem;
    color: var(--dark-color);
}

.card-info p {
    margin: 0.25rem 0 0;
    color: var(--gray-color);
    font-size: 0.9rem;
}

/* Acciones rápidas */
.quick-actions {
    margin-bottom: 2.5rem;
}

.section-title {
    font-size: 1.5rem;
    color: var(--dark-color);
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.view-all {
    font-size: 0.95rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.view-all:hover {
    text-decoration: underline;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 1.75rem 1.5rem;
    text-align: center;
    text-decoration: none;
    color: inherit;
    transition: var(--transition);
    box-shadow: var(--box-shadow);
    border: 1px solid rgba(0,0,0,0.05);
    display: block;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.action-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 1.25rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
}

.action-icon.primary { background: var(--primary-color); }
.action-icon.success { background: var(--success-color); }
.action-icon.warning { background: var(--warning-color); }
.action-icon.info { background: #4A90E2; }

.action-card h3 {
    margin: 0 0 0.5rem;
    color: var(--dark-color);
    font-size: 1.1rem;
}

.action-card p {
    margin: 0;
    color: var(--gray-color);
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Pedidos recientes */
.recent-orders {
    background: white;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    box-shadow: var(--box-shadow);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.no-orders {
    text-align: center;
    padding: 3rem 2rem;
    border: 2px dashed var(--light-gray);
    border-radius: var(--border-radius);
    color: var(--gray-color);
}

.no-orders i {
    font-size: 3rem;
    color: var(--light-gray);
    margin-bottom: 1rem;
}

.no-orders h3 {
    margin: 0 0 0.5rem;
    color: var(--dark-color);
}

.no-orders p {
    margin-bottom: 1.5rem;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
    text-decoration: none;
    cursor: pointer;
}

.btn-primary:hover {
    background: #C1121F;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .welcome-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .welcome-actions {
        justify-content: center;
        flex-wrap: wrap;
    }

    .welcome-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .user-welcome-banner {
        padding: 1.5rem 1rem;
        margin-bottom: 1.5rem;
    }

    .welcome-content {
        gap: 1rem;
    }

    .welcome-avatar {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }

    .welcome-title {
        font-size: 1.5rem;
    }

    .welcome-subtitle {
        font-size: 1rem;
    }

    .btn-welcome-icon {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }

    .summary-cards {
        grid-template-columns: 1fr;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .user-welcome-banner {
        padding: 1rem 0.5rem;
    }

    .welcome-title {
        font-size: 1.3rem;
    }

    .welcome-actions {
        flex-direction: row;
        gap: 0.75rem;
    }

    .btn-welcome-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}

/* Estilos responsivos para dashboard */
@media (max-width: 992px) {
    .user-header {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .user-greeting {
        flex-direction: column;
        text-align: center;
    }

    .user-actions {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }
}

@media (max-width: 768px) {
    .summary-cards {
        grid-template-columns: 1fr;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }

    .user-greeting h1 {
        font-size: 1.5rem;
    }
}
</style>

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

</x-layout>
