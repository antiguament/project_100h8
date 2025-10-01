@extends('adminlte::page')

@section('title', 'Administración de Pedidos | ' . config('app.name'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Logs de Pedidos</h4>
                    <div>
                        <a href="{{ route('admin.statistics') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-chart-bar me-1"></i>Estadísticas
                        </a>
                        <a href="{{ route('admin.download-logs') }}" class="btn btn-success btn-sm me-2">
                            <i class="fas fa-download me-1"></i>Descargar Backup
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#clearLogsModal">
                            <i class="fas fa-trash me-1"></i>Limpiar Logs
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filtros -->
                    <div class="mb-4">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label for="filter" class="form-label">Buscar</label>
                                <input type="text" name="filter" id="filter" class="form-control" 
                                       placeholder="Cliente, teléfono o dirección..." value="{{ $filter }}">
                            </div>
                            <div class="col-md-4">
                                <label for="days_filter" class="form-label">Filtrar por días</label>
                                <select name="days_filter" id="days_filter" class="form-select">
                                    <option value="">Todos los pedidos</option>
                                    <option value="1" {{ $daysFilter == '1' ? 'selected' : '' }}>Último día</option>
                                    <option value="3" {{ $daysFilter == '3' ? 'selected' : '' }}>Últimos 3 días</option>
                                    <option value="7" {{ $daysFilter == '7' ? 'selected' : '' }}>Última semana</option>
                                    <option value="15" {{ $daysFilter == '15' ? 'selected' : '' }}>Últimos 15 días</option>
                                    <option value="30" {{ $daysFilter == '30' ? 'selected' : '' }}>Último mes</option>
                                    <option value="custom" {{ $daysFilter == 'custom' ? 'selected' : '' }}>Rango personalizado</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="custom_range_container" style="{{ $daysFilter == 'custom' ? '' : 'display: none;' }}">
                                <label for="custom_range" class="form-label">Rango personalizado (días)</label>
                                <input type="number" name="custom_range" id="custom_range" class="form-control" 
                                       min="1" value="{{ $customRange ?? '' }}" placeholder="Ej: 10">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i>Aplicar Filtros
                                </button>
                                @if($filter || $daysFilter)
                                    <a href="{{ route('admin.order-logs') }}" class="btn btn-secondary ms-2">
                                        <i class="fas fa-times me-1"></i>Limpiar Filtros
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    
                    <!-- Resumen -->
                    <div class="alert alert-info">
                        <strong>Total de pedidos encontrados:</strong> {{ count($orders) }} / {{ $totalOrders }}
                        @if($daysFilter)
                            <br>
                            <strong>Período:</strong> 
                            @if($daysFilter == '1')
                                Último día
                            @elseif($daysFilter == '3')
                                Últimos 3 días
                            @elseif($daysFilter == '7')
                                Última semana
                            @elseif($daysFilter == '15')
                                Últimos 15 días
                            @elseif($daysFilter == '30')
                                Último mes
                            @elseif($daysFilter == 'custom' && isset($customRange))
                                Últimos {{ $customRange }} días
                            @endif
                        @endif
                    </div>
                    
                    <!-- Lista de pedidos -->
                    @if(count($orders) > 0)
                        @foreach($orders as $index => $order)
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>
                                        <strong>Pedido del {{ $order['fecha'] }}</strong>
                                        @if(isset($order['fecha_original']))
                                            <br>
                                            <small class="text-muted">Fecha original: {{ $order['fecha_original'] }}</small>
                                        @endif
                                    </span>
                                    <div>
                                        <span class="badge bg-success me-2">Total: ${{ number_format($order['total'], 2) }}</span>
                                        <a href="{{ route('admin.print-ticket', $index) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-print me-1"></i>Imprimir Ticket
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Información del Cliente</h6>
                                            <p><strong>Cliente:</strong> {{ $order['cliente'] }}</p>
                                            <p><strong>Teléfono:</strong> {{ $order['telefono'] }}</p>
                                            <p><strong>Dirección:</strong> {{ $order['direccion'] }}</p>
                                            <p><strong>Método de envío:</strong> {{ $order['metodo_envio'] }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Productos</h6>
                                            @foreach($order['productos'] as $producto)
                                                <div class="mb-2">
                                                    <strong>{{ $producto['nombre'] }}</strong>
                                                    @if(!empty($producto['detalles']))
                                                        <ul class="mb-0">
                                                            @foreach($producto['detalles'] as $detalle)
                                                                <li>{{ $detalle }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                            <hr>
                                            <p><strong>Subtotal:</strong> ${{ number_format($order['subtotal'], 2) }}</p>
                                            <p><strong>Envío:</strong> ${{ number_format($order['envio'], 2) }}</p>
                                            <p><strong>Total:</strong> ${{ number_format($order['total'], 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            No se encontraron pedidos 
                            @if($filter || $daysFilter)
                                con los filtros aplicados.
                            @else
                                en el sistema.
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para limpiar logs -->
<div class="modal fade" id="clearLogsModal" tabindex="-1" aria-labelledby="clearLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clearLogsModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>¡Advertencia!</strong> Esta acción eliminará todos los logs de pedidos y no se puede deshacer.
                </div>
                <p>¿Estás seguro de que deseas eliminar todos los logs de pedidos?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('admin.clear-logs') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sí, Eliminar Todo</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const daysFilter = document.getElementById('days_filter');
        const customRangeContainer = document.getElementById('custom_range_container');
        
        daysFilter.addEventListener('change', function() {
            if (this.value === 'custom') {
                customRangeContainer.style.display = 'block';
            } else {
                customRangeContainer.style.display = 'none';
            }
        });
        
        // Mostrar/ocultar al cargar la página
        if (daysFilter.value === 'custom') {
            customRangeContainer.style.display = 'block';
        }
    });
</script>
@endsection