@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<div class="container mt-5">
    <h2 class="text-center text-success">Catálogo de Ropa Masculina</h2>
    <p class="text-center text-muted">Explora camisas y pantalones elegantes y casuales para caballeros.</p>
    
    <div class="row">
        @for ($i = 1; $i <= 6; $i++)
            <!-- Camisas -->
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="{{ asset('assets/img/camisa' . $i . '.jpg') }}" class="card-img-top" alt="Camisa {{ $i }}">
                    <div class="card-body text-center">
                        <h5 class="card-title product-title">Camisa {{ $i }}</h5>
                        <p class="card-text product-price">Precio: <strong>$80.000</strong></p>
                        <button class="btn btn-primary w-100 add-to-cart" data-product="Camisa {{ $i }}" data-price="80000">Añadir al carrito 🛒</button>
                    </div>
                </div>
            </div>
        @endfor

        @for ($i = 1; $i <= 6; $i++)
            <!-- Pantalones -->
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="{{ asset('assets/img/pantalon' . $i . '.jpg') }}" class="card-img-top" alt="Pantalón {{ $i }}">
                    <div class="card-body text-center">
                        <h5 class="card-title product-title">Pantalón {{ $i }}</h5>
                        <p class="card-text product-price">Precio: <strong>$100.000</strong></p>
                        <button class="btn btn-primary w-100 add-to-cart" data-product="Pantalón {{ $i }}" data-price="100000">Añadir al carrito 🛒</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".add-to-cart").forEach(button => {
            button.addEventListener("click", function() {
                let product = this.dataset.product;
                let price = this.dataset.price;
                alert(`Producto agregado al carrito: ${product} - Precio: $${price}`);
            });
        });
    });
</script>
@endsection
