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
            <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2 mb-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label">Categoría</label>
                    <select name="category_id" class="form-select">
                        <option value="">Todas</option>
                        @foreach(($categories ?? []) as $cat)
                            <option value="{{ $cat->id }}" {{ (($filters['category_id'] ?? '') == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="" {{ (($filters['status'] ?? '') === '') ? 'selected' : '' }}>Todos</option>
                        <option value="active" {{ (($filters['status'] ?? '') === 'active') ? 'selected' : '' }}>Activos</option>
                        <option value="inactive" {{ (($filters['status'] ?? '') === 'inactive') ? 'selected' : '' }}>Inactivos</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Buscar</label>
                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Nombre o descripción">
                </div>
                <div class="col-12 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filtrar</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary" title="Limpiar filtros"><i class="fas fa-undo"></i></a>
                </div>
            </form>
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
                        @php $currentCategory = null; @endphp
                        @forelse ($products as $product)
                            @php $categoryName = optional($product->category)->name; @endphp
                            @if ($categoryName !== $currentCategory)
                                <tr class="table-secondary">
                                    <td colspan="11">
                                        <strong>{{ $categoryName ?? 'Sin categoría' }}</strong>
                                    </td>
                                </tr>
                                @php $currentCategory = $categoryName; @endphp
                            @endif
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
                                <td>{{ $product->category->name }}</td>
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
                {{ $products->links() }}
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
