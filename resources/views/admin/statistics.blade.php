@extends('adminlte::page')

@section('title', 'Estadísticas de Pedidos | ' . config('app.name'))

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas de Pedidos</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Tarjetas de estadísticas -->
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['total_pedidos'] }}</h3>
                                    <p class="mb-0">Total Pedidos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>${{ number_format($stats['total_ingresos'], 2) }}</h3>
                                    <p class="mb-0">Total Ingresos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-warning text-dark">
                                <div class="card-body text-center">
                                    <h3>${{ number_format($stats['promedio_pedido'], 2) }}</h3>
                                    <p class="mb-0">Promedio por Pedido</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['pedidos_hoy'] }}</h3>
                                    <p class="mb-0">Pedidos Hoy</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Ingresos del Día</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h2 class="text-success">${{ number_format($stats['ingresos_hoy'], 2) }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Pedidos Última Semana</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h2 class="text-primary">{{ $stats['pedidos_ultima_semana'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($stats['metodos_envio']))
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Métodos de Envío</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Método</th>
                                                    <th>Cantidad</th>
                                                    <th>Porcentaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stats['metodos_envio'] as $metodo => $cantidad)
                                                <tr>
                                                    <td>{{ $metodo }}</td>
                                                    <td>{{ $cantidad }}</td>
                                                    <td>
                                                        @if($stats['total_pedidos'] > 0)
                                                            {{ number_format(($cantidad / $stats['total_pedidos']) * 100, 1) }}%
                                                        @else
                                                            0%
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('admin.order-logs') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-1"></i>Volver a Logs de Pedidos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection