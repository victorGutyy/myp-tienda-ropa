@extends('layout')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row shadow-lg rounded p-5 bg-white" style="max-width: 500px; width: 100%;">
        <h2 class="text-center text-success fw-bold">Recuperar Contraseña</h2>
        <p class="text-center text-muted">Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control rounded-3" required>
                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2">Enviar enlace</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('index') }}">Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
