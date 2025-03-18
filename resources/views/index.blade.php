@extends('layout')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - MYP TIENDA DE ROPA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo.css') }}">
    

</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row shadow-lg rounded p-5 bg-white" style="max-width: 500px; width: 100%;">
            <h2 class="text-center text-success fw-bold">SOLO MODA - MYP TIENDA DE ROPA</h2>
            <p class="text-center text-muted">Accede a tu cuenta o regístrate</p>
            
            <!-- Formulario de Inicio de Sesión -->
            <div id="loginForm">
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
                    <button type="submit" class="btn btn-success w-100 rounded-3 py-2">Iniciar Sesión</button>
                </form>
                <div class="text-center">
                    <p class="mt-3">¿No tienes cuenta? <a href="#" id="showRegister">Regístrate</a></p>
                </div>
            </div>
            
            <!-- Formulario de Registro -->
            <div id="registerForm" style="display: none;">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-3" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2">Registrarse</button>
                </form>
                <div class="text-center">
                    <p class="mt-3">¿Ya tienes cuenta? <a href="#" id="showLogin">Inicia Sesión</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para ir a Contacto -->
    <div class="text-center mt-4">
                <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-lg">📩 Contactarnos</a>
            </div>


    <script>
        $(document).ready(function() {
            $("#showRegister").click(function(e) {
                e.preventDefault();
                $("#loginForm").hide();
                $("#registerForm").fadeIn();
            });
            $("#showLogin").click(function(e) {
                e.preventDefault();
                $("#registerForm").hide();
                $("#loginForm").fadeIn();
            });
        });
    </script>
</body>
</html>
@endsection
