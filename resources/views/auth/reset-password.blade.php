@extends('layout')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row shadow-lg rounded p-5 bg-white" style="max-width: 500px; width: 100%;">
        <h2 class="text-center text-success fw-bold">Establecer Nueva Contraseña</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control rounded-3" required autofocus>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nueva Contraseña</label>
                <input type="password" name="password" class="form-control rounded-3" required>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control rounded-3" required>
            </div>

            <button type="submit" class="btn btn-success w-100 rounded-3 py-2">Restablecer Contraseña</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('index') }}">← Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
