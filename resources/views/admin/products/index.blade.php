@extends('adminlte::page')

@section('title', $title ?? 'Lista de Productos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $title ?? 'Productos' }}</h1>
        <div>
            @if(isset($category))
                <a href="{{ route('admin.products.create', ['category_id' => $category->id]) }}" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Nuevo Producto en {{ $category->name }}
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Ver Todos los Productos
                </a>
            @else
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            @endif
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @isset($categories)
                <form method="GET" action="{{ route('admin.products.index') }}" class="mb-3">
                    <div class="form-row align-items-end">
                        <div class="col-md-6">
                            <label for="category_id">Filtrar por categoría</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                        @if( (isset($category) && $category->id == $cat->id) || (request('category_id') == $cat->id) ) selected @endif>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-filter"></i> Aplicar filtro
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            @endisset

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Preferencia 1</th>
                            <th>Preferencia 2</th>
                            <th>Preferencia 3</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ route('product.image', ['filename' => basename($product->image)]) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 50px;"
                                             onerror="this.onerror=null; this.src='{{ asset('storage/' . $product->image) }}';">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ optional($product->category)->name ?? '-' }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->preferencia_uno ?? '-' }}</td>
                                <td>{{ $product->preferencia_dos ?? '-' }}</td>
                                <td>{{ $product->preferencia_tres ?? '-' }}</td>
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
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No hay productos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .img-thumbnail {
            max-width: 50px;
            height: auto;
        }
    </style>
@stop
