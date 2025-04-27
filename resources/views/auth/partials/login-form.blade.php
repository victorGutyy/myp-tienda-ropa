<form action="{{ route('login.post') }}" method="POST" class="mb-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-control rounded-3" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control rounded-3" required>
    </div>

    @if ($errors->has('password'))
        <div class="alert alert-danger small mt-1">
            {{ $errors->first('password') }}
        </div>
    @endif

    <button type="submit" class="btn btn-success w-100 rounded-3 py-2">Iniciar Sesión</button>

    <div class="text-center mt-2">
        <a href="{{ route('password.request') }}" class="text-decoration-none small">¿Olvidaste tu contraseña?</a>
    </div>
    <p class="text-center mt-2 small text-muted">
        Al iniciar sesión, aceptas nuestra <a href="{{ route('politica') }}">Política de Tratamiento de Datos</a>.
    </p>
</form>
<div class="text-center mt-2">
    ¿No tienes cuenta? <a href="{{ route('register.form') }}">Regístrate</a>
</div>
