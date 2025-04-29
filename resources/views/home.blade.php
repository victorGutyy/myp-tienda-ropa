@extends('layout')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-dark">
                    <h1>Bienvenido a nuestra tienda</h1>
                    <p>Encuentra la mejor moda y calzado con la mejor calidad y estilo. Explora nuestras ofertas exclusivas.</p>
                    
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/img/home-banner.jpg') }}" alt="Banner Home" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="container py-5">
        <div class="row text-center">
            <div class="col-lg-6 m-auto">
                <h2 class="h2">Productos</h2>
                <p>Explora algunos de nuestros productos más populares y en tendencia.</p>
            </div>
        </div>
        <div class="row">
            <!-- Producto 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('assets/img/marca_tenis.jpg') }}" class="card-img-top" alt="Producto 1">
                    <div class="card-body">
                        <h5 class="card-title">tenis</h5>
                        <p class="card-text">Desde $150.000</p>
                        <a href="{{ route('tenis') }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Producto 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('assets/img/femenino.jpg') }}" class="card-img-top" alt="Producto 2">
                    <div class="card-body">
                        <h5 class="card-title">Ropa Femenina</h5>
                        <p class="card-text">Desde $80.000</p>
                        <a href="{{ route('ropa.femenina') }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Producto 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('assets/img/masculino.jpg') }}" class="card-img-top" alt="Producto 3">
                    <div class="card-body">
                        <h5 class="card-title">Ropa masculina</h5>
                        <p class="card-text">Desde $80.000</p>
                        <a href="{{ route('ropa.masculina') }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
