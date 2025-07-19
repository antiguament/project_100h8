@extends('adminlte::page')

@section('title', 'Prueba de Almacenamiento')

@section('content_header')
    <h1>Prueba de Configuración de Almacenamiento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Información del Sistema de Archivos</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Configuración</th>
                        <th>Valor</th>
                    </tr>
                    <tr>
                        <td>Ruta de almacenamiento (storage_path)</td>
                        <td>{{ $testPath }}</td>
                    </tr>
                    <tr>
                        <td>Ruta pública (public_path)</td>
                        <td>{{ $publicPath }}</td>
                    </tr>
                    <tr>
                        <td>¿Existe el directorio de almacenamiento?</td>
                        <td class="{{ $storageExists ? 'text-success' : 'text-danger' }}">
                            {{ $storageExists ? 'Sí' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td>¿Existe el directorio público de almacenamiento?</td>
                        <td class="{{ $publicStorageExists ? 'text-success' : 'text-danger' }}">
                            {{ $publicStorageExists ? 'Sí' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td>¿El enlace simbólico existe?</td>
                        <td class="{{ $isLinked ? 'text-success' : 'text-danger' }}">
                            {{ $isLinked ? 'Sí' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Destino del enlace simbólico</td>
                        <td>{{ $linkTarget }}</td>
                    </tr>
                </table>
            </div>

            @if(!empty($categoryImages))
                <h4 class="mt-4">Imágenes de Categorías en la Base de Datos</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Ruta de la imagen</th>
                                <th>¿Existe el archivo?</th>
                                <th>URLs de prueba</th>
                                <th>Vista previa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoryImages as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['image_path'] }}</td>
                                    <td class="{{ $item['exists'] ? 'text-success' : 'text-danger' }}">
                                        {{ $item['exists'] ? 'Sí' : 'No' }}
                                    </td>
                                    <td>
                                        <div class="mb-1">
                                            <small>asset():</small><br>
                                            <a href="{{ $item['asset_url'] }}" target="_blank">{{ $item['asset_url'] }}</a>
                                        </div>
                                        <div class="mb-1">
                                            <small>url():</small><br>
                                            <a href="{{ $item['url'] }}" target="_blank">{{ $item['url'] }}</a>
                                        </div>
                                        <div>
                                            <small>Direct URL:</small><br>
                                            <a href="{{ $item['direct_url'] }}" target="_blank">{{ $item['direct_url'] }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item['exists'])
                                            <img src="{{ $item['direct_url'] }}" style="max-width: 100px; max-height: 100px;" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">No disponible</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning mt-4">
                    No se encontraron categorías con imágenes en la base de datos.
                </div>
            @endif

            @if($storageExists && !empty($categories))
                <h4 class="mt-4">Archivos en el directorio de categorías</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del archivo</th>
                                <th>Ruta completa</th>
                                <th>¿Existe?</th>
                                <th>URLs de prueba</th>
                                <th>Vista previa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $file)
                                <tr>
                                    <td>{{ $file['name'] }}</td>
                                    <td>{{ $file['path'] }}</td>
                                    <td class="{{ $file['exists'] ? 'text-success' : 'text-danger' }}">
                                        {{ $file['exists'] ? 'Sí' : 'No' }}
                                    </td>
                                    <td>
                                        <div class="mb-1">
                                            <small>asset():</small><br>
                                            <a href="{{ $file['url'] }}" target="_blank">{{ $file['url'] }}</a>
                                        </div>
                                        <div class="mb-1">
                                            <small>url():</small><br>
                                            <a href="{{ $file['storage_url'] }}" target="_blank">{{ $file['storage_url'] }}</a>
                                        </div>
                                        <div>
                                            <small>Direct URL:</small><br>
                                            <a href="{{ $file['direct_url'] }}" target="_blank">{{ $file['direct_url'] }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if($file['exists'] && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file['name']))
                                            <img src="{{ $file['direct_url'] }}" style="max-width: 100px; max-height: 100px;" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">No es una imagen</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-4">
                <h4>Prueba de carga de imagen</h4>
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Subir imagen de prueba:</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Se creará una nueva categoría de prueba con esta imagen.</small>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la categoría de prueba:</label>
                        <input type="text" name="name" class="form-control" value="Categoría de prueba " required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Subir imagen de prueba
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop
