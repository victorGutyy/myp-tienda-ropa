@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<div class="container mt-5">
    <h2 class="text-center text-success">Catálogo de Tenis</h2>
    <p class="text-center text-muted">Encuentra el mejor calzado deportivo con calidad garantizada.</p>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body text-center">
                        <h5 class="card-title product-title">{{ $product->name }}</h5>
                        <p class="card-text product-price">Precio sin IVA: <strong>${{ number_format($product->price, 0, ',', '.') }}</strong></p>
                        
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Tallas --}}
                            <select name="size_id" class="form-control mb-2" required>
                                <option value="">Seleccione Talla</option>
                                @php
                                    $sizes = $product->variants->map(function ($variant) {
                                        return $variant->size;
                                    })->unique('id');
                                @endphp
                                @foreach ($sizes as $size)
                                    @if ($size)
                                        <option value="{{ $size->id }}">{{ $size->label }}</option>
                                    @endif
                                @endforeach
                            </select>

                            {{-- Colores --}}
                            <select name="color_id" class="form-control mb-2" required>
                                <option value="">Seleccione Color</option>
                                @php
                                    $colors = $product->variants->map(function ($variant) {
                                        return $variant->color;
                                    })->unique('id');
                                @endphp
                                @foreach ($colors as $color)
                                    @if ($color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            {{-- Botón --}}
                            <button type="submit" class="btn btn-primary w-100">Añadir al carrito 🛒</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
