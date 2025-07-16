@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-danger">Error</h1>
                </div>
                <div class="card-body">
                    <h3 class="text-danger">{{ $message ?? 'Ha ocurrido un error inesperado' }}</h3>
                    
                    @if(isset($error) && config('app.debug'))
                        <div class="alert alert-danger mt-4 text-left">
                            <p class="mb-1"><strong>Error:</strong> {{ $error }}</p>
                            @if(isset($exception) && $exception->getMessage())
                                <p class="mb-1"><strong>Mensaje:</strong> {{ $exception->getMessage() }}</p>
                            @endif
                            @if(isset($exception) && $exception->getFile())
                                <p class="mb-1"><strong>Archivo:</strong> {{ $exception->getFile() }}:{{ $exception->getLine() }}</p>
                            @endif
                        </div>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Volver al Inicio
                        </a>
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver Atrás
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
