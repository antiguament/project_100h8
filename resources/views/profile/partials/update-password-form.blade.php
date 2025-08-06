<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="update_password_current_password">Contraseña Actual</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" id="update_password_current_password" name="current_password" 
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                   autocomplete="current-password" required>
        </div>
        @error('current_password', 'updatePassword')
            <span class="text-danger">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="update_password_password">Nueva Contraseña</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" id="update_password_password" name="password" 
                   class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                   autocomplete="new-password" required>
        </div>
        <small class="form-text text-muted">
            Usa 8 o más caracteres con una combinación de letras, números y símbolos.
        </small>
        @error('password', 'updatePassword')
            <span class="text-danger">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="update_password_password_confirmation">Confirmar Nueva Contraseña</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
            </div>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" 
                   class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                   autocomplete="new-password" required>
        </div>
        @error('password_confirmation', 'updatePassword')
            <span class="text-danger">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-warning">
            <i class="fas fa-sync-alt"></i> Actualizar Contraseña
        </button>
    </div>
</form>
