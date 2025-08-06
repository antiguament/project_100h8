@extends('adminlte::page')

@section('title', 'Bienvenido - ' . config('app.name'))

@section('content_header')
    <h1 class="m-0 text-dark">Bienvenido a {{ config('app.name') }}</h1>
@stop

@section('content')
<div class="dashboard-container">
    <!-- Barra superior con información del usuario -->
    <div class="user-header">
        <div class="user-greeting">
            <div class="avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div>
                <h1>¡Hola, {{ $user->name }}!</h1>
                <p class="text-muted">Bienvenido de nuevo a {{ config('app.name') }}</p>
            </div>
        </div>
        <div class="user-actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-profile">
                <i class="fas fa-user-edit"></i> Editar Perfil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="summary-cards">
        <div class="summary-card primary">
            <div class="card-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-info">
                <h3>0</h3>
                <p>Pedidos Activos</p>
            </div>
        </div>
        
        <div class="summary-card success">
            <div class="card-icon">
                <i class="fas fa-history"></i>
            </div>
            <div class="card-info">
                <h3>0</h3>
                <p>Pedidos Anteriores</p>
            </div>
        </div>
        
        <div class="summary-card warning">
            <div class="card-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="card-info">
                <h3>0</h3>
                <p>Favoritos</p>
            </div>
        </div>
    </div>
    <!-- Acciones rápidas -->
    <div class="quick-actions">
        <h2 class="section-title">Acciones Rápidas</h2>
        <div class="action-grid">
            <a href="{{ route('vista-1') }}" class="action-card">
                <div class="action-icon primary">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Ver Menú</h3>
                <p>Explora nuestra deliciosa selección de platos</p>
            </a>
            
            <a href="#" class="action-card">
                <div class="action-icon success">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>Mi Carrito</h3>
                <p>Revisa tus productos seleccionados</p>
            </a>
            
            <a href="#" class="action-card">
                <div class="action-icon warning">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Mis Direcciones</h3>
                <p>Gestiona tus direcciones de envío</p>
            </a>
            
            <a href="{{ route('profile.edit') }}" class="action-card">
                <div class="action-icon info">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h3>Configuración</h3>
                <p>Personaliza tu cuenta y preferencias</p>
            </a>
        </div>
    </div>

    <!-- Sección de pedidos recientes -->
    <div class="recent-orders">
        <div class="section-header">
            <h2 class="section-title">Tus Pedidos Recientes</h2>
            <a href="#" class="view-all">Ver todos</a>
        </div>
        
        <div class="no-orders">
            <i class="fas fa-shopping-bag"></i>
            <h3>No hay pedidos recientes</h3>
            <p>¡Aún no has realizado ningún pedido!</p>
            <a href="{{ route('vista-1') }}" class="btn btn-primary">
                <i class="fas fa-utensils"></i> Ver Menú
            </a>
        </div>
    </div>
</div>

<style>
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

/* Estilos responsivos */
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

@stop

@push('js')
<script>
    // Scripts específicos para esta página
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialización de componentes de AdminLTE si es necesario
        console.log('Página de bienvenida cargada');
    });
</script>
@endpush
