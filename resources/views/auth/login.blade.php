@extends('layout')

@section('content')

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row shadow-lg rounded p-5 bg-white" style="max-width: 500px; width: 100%;">
        <h2 class="text-center text-success fw-bold">SOLO MODA - MYP TIENDA DE ROPA</h2>
        <p class="text-center text-muted">Accede a tu cuenta o regístrate</p>
        
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

            <div class="text-end">
                <a href="{{ route('password.request') }}" class="text-decoration-none small">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn btn-success w-100 rounded-3 py-2">Iniciar Sesión</button>

            <p class="text-center mt-2 small text-muted">
                Al iniciar sesión, aceptas nuestra <a href="{{ route('politica') }}">Política de Tratamiento de Datos</a> y nuestras prácticas de seguridad informática.
            </p>
        </form>

        <div class="text-center">
            <p class="mt-3">¿No tienes cuenta? <a href="{{ route('register.form') }}">Regístrate</a></p>
        </div>
    </div>
</div>

@endsection
