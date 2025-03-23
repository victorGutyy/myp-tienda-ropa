<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    
</head>

@php use Illuminate\Support\Facades\Auth; @endphp

<body>
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">MYP_TIENDA@SOLOMODA.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:355-555-9999">355-555-9999</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center text-success logo h1" href="{{ url('/') }}">
            <!-- Agregamos el Logo -->
            <img src="{{ asset('assets/img/logomyp.jpg') }}" alt="Logo MYP" class="logo-img">
            <span class="ms-2">MYP TIENDA DE ROPA</span>
        </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>

                        
                     @auth
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item mx-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-custom btn-sm">
                    <i class="fas fa-cogs me-1"></i> Admin
                    </a>
                     </li>
                     <li class="nav-item">
                     <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Salir
                    </button>
                    </form>
                    </li>
                    @endif
                    @endauth

                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="badge rounded-pill bg-light text-dark">7</span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido dinámico de cada página -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3">MYP TIENDA DE ROPA</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><i class="fas fa-map-marker-alt fa-fw"></i> 123 Consectetur at ligula 10660</li>
                        <li><i class="fa fa-phone fa-fw"></i> <a class="text-decoration-none" href="tel:010-020-0340">355-555-9999</a></li>
                        <li><i class="fa fa-envelope fa-fw"></i> <a class="text-decoration-none" href="mailto:info@company.com">MYP_TIENDA@SOLOMODA.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/templatemo.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
