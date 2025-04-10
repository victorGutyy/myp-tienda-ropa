@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<div class="container mt-5">
    <h2 class="text-center text-success">Catálogo de Tenis</h2>
    <p class="text-center text-muted">Encuentra el mejor calzado deportivo con calidad garantizada.</p>
    
    <div class="row">
        @for ($i = 1; $i <= 12; $i++)
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="{{ asset('assets/img/tenis' . $i . '.jpg') }}" class="card-img-top" alt="Tenis {{ $i }}">
                    <div class="card-body text-center">
                        <h5 class="card-title product-title">Modelo Tenis {{ $i }}</h5>
                        <p class="card-text product-price">Precio sin IVA: <strong>$150.000</strong></p>
                        <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product" value="Tenis {{ $i }}">
                        <input type="hidden" name="price" value="150000">
                        <button type="submit" class="btn btn-primary w-100">Añadir al carrito 🛒</button>
                        </form>

                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let addToCartButtons = document.querySelectorAll(".add-to-cart");
        
        addToCartButtons.forEach(button => {
            button.addEventListener("click", function() {
                let product = this.getAttribute("data-product");
                let price = this.getAttribute("data-price");
                alert(`Producto agregado al carrito: ${product} - Precio: $${price}`);
            });
        });
    });
</script>
@endsection
