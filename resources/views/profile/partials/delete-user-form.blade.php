<div class="callout callout-danger">
    <h5><i class="icon fas fa-exclamation-triangle"></i> Eliminar Cuenta</h5>
    <p>
        Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. 
        Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.
    </p>
    
    <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#confirmDeleteModal">
        <i class="fas fa-trash-alt"></i> Eliminar Cuenta
    </button>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="confirmDeleteModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar su cuenta? Esta acción no se puede deshacer.</p>
                    <p class="mb-0">Ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.</p>
                    
                    <div class="form-group mt-3">
                        <label for="delete_password">Contraseña</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" id="delete_password" name="password" 
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                   placeholder="Ingrese su contraseña" required>
                        </div>
                        @error('password', 'userDeletion')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Eliminar Cuenta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    // Mostrar el modal si hay errores de validación
    @if($errors->userDeletion->isNotEmpty())
        $(document).ready(function() {
            $('#confirmDeleteModal').modal('show');
        });
    @endif
</script>
@endpush
