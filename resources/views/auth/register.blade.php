@extends('layout')

@section('title', 'Registro de Usuario')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center text-success mb-3">Crear una cuenta</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Registrarse</button>
        </form>

        <div class="text-center mt-3">
            ¿Ya tienes cuenta? <a href="{{ route('home') }}">Inicia sesión</a>
            

        </div>
        <div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="acepto" name="acepto" required>
    <label class="form-check-label" for="acepto">
        Acepto el <a href="{{ route('politica') }}" target="_blank">tratamiento de mis datos personales</a> según lo establecido en la Ley 1581 de 2012.
    </label>
</div>

    </div>
</div>
@endsection
