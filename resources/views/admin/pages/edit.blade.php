@extends('adminlte::page')

@section('title', 'Editar Página')

@push('css')
<!-- Include any additional CSS here -->
@endpush

@section('content_header')
    <h1>Editar Página: {{ $page->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.direct-update', $page) }}" method="POST" enctype="multipart/form-data" id="page-edit-form">
                @csrf
                @method('POST')
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Información Básica</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Título *</label>
                                    <input type="text" name="title" id="title" class="form-control" 
                                           value="{{ old('title', $page->title) }}" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug *</label>
                                    <input type="text" name="slug" id="slug" class="form-control" 
                                           value="{{ old('slug', $page->slug) }}" required>
                                    <small class="form-text text-muted">URL amigable (usar guiones para separar palabras)</small>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hero_title">Título del Héroe *</label>
                                    <input type="text" name="hero_title" id="hero_title" class="form-control" 
                                           value="{{ old('hero_title', $page->hero_title) }}" required>
                                    @error('hero_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hero_subtitle">Subtítulo del Héroe *</label>
                                    <textarea name="hero_subtitle" id="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                                    @error('hero_subtitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hero_image">Imagen del Héroe</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="hero_image" name="hero_image">
                                        <label class="custom-file-label" for="hero_image">
                                            {{ $page->hero_image ? basename($page->hero_image) : 'Seleccionar archivo' }}
                                        </label>
                                    </div>
                                    @if($page->hero_image)
                                        <div class="mt-2">
                                            <img src="{{ $page->hero_image_url }}" alt="{{ $page->title }}" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    @endif
                                    @error('hero_image')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Features Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Características Principales</h3>
                            </div>
                            <div class="card-body" id="features-container">
                                @php $features = old('features', $page->features ?? []); @endphp
                                @foreach($features as $index => $feature)
                                    <div class="feature-item mb-3 border p-3">
                                        <div class="form-group">
                                            <label>Título de la característica</label>
                                            <input type="text" name="features[{{ $index }}][title]" class="form-control" 
                                                   value="{{ $feature['title'] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="features[{{ $index }}][description]" class="form-control" rows="2" required>{{ $feature['description'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Ícono (ej: fas fa-check)</label>
                                            <input type="text" name="features[{{ $index }}][icon]" class="form-control" 
                                                   value="{{ $feature['icon'] ?? '' }}" required>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm remove-feature">Eliminar</button>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-secondary btn-sm" id="add-feature">
                                    <i class="fas fa-plus"></i> Agregar Característica
                                </button>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Información de Contacto</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Dirección *</label>
                                            <input type="text" name="address" id="address" class="form-control" 
                                                   value="{{ old('address', $page->address) }}" required>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Teléfono *</label>
                                            <input type="text" name="phone" id="phone" class="form-control" 
                                                   value="{{ old('phone', $page->phone) }}" required>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico *</label>
                                            <input type="email" name="email" id="email" class="form-control" 
                                                   value="{{ old('email', $page->email) }}" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="whatsapp">WhatsApp *</label>
                                            <input type="text" name="whatsapp" id="whatsapp" class="form-control" 
                                                   value="{{ old('whatsapp', $page->whatsapp) }}" required>
                                            @error('whatsapp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Status & SEO -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Estado y SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" 
                                               value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Página Activa</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Título SEO</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" 
                                           value="{{ old('meta_title', $page->meta_title) }}">
                                    <small class="form-text text-muted">Título que aparecerá en los resultados de búsqueda</small>
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Descripción SEO</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                                    <small class="form-text text-muted">Descripción que aparecerá en los resultados de búsqueda</small>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Redes Sociales</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                        </div>
                                        <input type="url" name="facebook" id="facebook" class="form-control" 
                                               value="{{ old('facebook', $page->facebook) }}" placeholder="https://facebook.com/tu-pagina">
                                    </div>
                                    @error('facebook')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                        </div>
                                        <input type="url" name="instagram" id="instagram" class="form-control" 
                                               value="{{ old('instagram', $page->instagram) }}" placeholder="https://instagram.com/tu-cuenta">
                                    </div>
                                    @error('instagram')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="whatsapp_link">Enlace de WhatsApp *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                        </div>
                                        <input type="url" name="whatsapp_link" id="whatsapp_link" class="form-control" 
                                               value="{{ old('whatsapp_link', $page->whatsapp_link) }}" required 
                                               placeholder="https://wa.me/1234567890">
                                    </div>
                                    @error('whatsapp_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function() {
        // Auto-generate slug from title
        $('#title').on('blur', function() {
            const title = $(this).val();
            if (title && !$('#slug').val()) {
                const slug = title.toLowerCase()
                    .replace(/[^\w\s]/gi, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-');
                $('#slug').val(slug);
            }
        });

        // Handle file input label
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Add new feature
        let featureIndex = {{ count(old('features', $page->features ?? [])) }};
        $('#add-feature').click(function() {
            const newFeature = `
                <div class="feature-item mb-3 border p-3">
                    <div class="form-group">
                        <label>Título de la característica</label>
                        <input type="text" name="features[${featureIndex}][title]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="features[${featureIndex}][description]" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ícono (ej: fas fa-check)</label>
                        <input type="text" name="features[${featureIndex}][icon]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-feature">Eliminar</button>
                </div>
            `;
            $('#features-container').prepend(newFeature);
            featureIndex++;
        });

        // Remove feature
        $(document).on('click', '.remove-feature', function() {
            if (confirm('¿Estás seguro de eliminar esta característica?')) {
                $(this).closest('.feature-item').remove();
            }
        });
    });
</script>
@endpush
