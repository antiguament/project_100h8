@extends('adminlte::page')

@section('title', 'Detalles de la Categoría')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles de la Categoría: {{ $category->name }}</h1>
        <div>
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Información Básica</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $category->slug }}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $category->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de Creación</th>
                            <td>{{ $category->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Última Actualización</th>
                            <td>{{ $category->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Descripción</h4>
                    <div class="p-3 bg-light rounded">
                        {!! $category->description ? nl2br(e($category->description)) : '<em>Sin descripción</em>' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Productos en esta categoría</h4>
            <div>
                <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}" class="btn btn-sm btn-info mr-2">
                    <i class="fas fa-list"></i> Ver Todos ({{ $category->products_count }})
                </a>
                <a href="{{ route('admin.products.create', ['category_id' => $category->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 50px;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info mr-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info mb-0">
                    No hay productos en esta categoría.
                </div>
            @endif
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Acciones</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" 
                  onsubmit="return confirm('¿Estás seguro de eliminar esta categoría? Esta acción no se puede deshacer.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Eliminar Categoría
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table th {
            width: 200px;
        }
    </style>
@stop
