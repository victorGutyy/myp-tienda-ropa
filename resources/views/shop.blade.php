@extends('layouts.app')

@section('title', 'Shop - MYP TIENDA DE ROPA')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Nuestra Tienda</h1>

    <div class="row">
        <div class="col-lg-3">
            <h2 class="h4 pb-3">Categorías</h2>
            <ul class="list-unstyled">
                <li><a href="#">Hombres</a></li>
                <li><a href="#">Mujeres</a></li>
                <li><a href="#">Accesorios</a></li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/img/shop_01.jpg') }}" class="card-img-top" alt="Producto 1">
                        <div class="card-body">
                            <h5 class="card-title">Casual</h5>
                            <p class="card-text">$95000</p>
                            <a href="#" class="btn btn-success">Ver más</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/img/shop_02.jpg') }}" class="card-img-top" alt="Producto 2">
                        <div class="card-body">
                            <h5 class="card-title">Formal</h5>
                            <p class="card-text">$105000</p>
                            <a href="#" class="btn btn-success">Ver más</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/img/shop_03.jpg') }}" class="card-img-top" alt="Producto 3">
                        <div class="card-body">
                            <h5 class="card-title">Elegante</h5>
                            <p class="card-text">$119.990</p>
                            <a href="#" class="btn btn-success">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
