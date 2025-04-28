@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<div class="container mt-5">
    <h2 class="text-center text-success">Catálogo de Ropa Femenina</h2>
    <p class="text-center text-muted">Descubre nuestra selección de moda femenina, ideal para cada ocasión.</p>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="{{ asset('assets/img/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title product-title">{{ $product->name }}</h5>
                        <p class="card-text product-price">
                            Precio sin IVA: <strong>${{ number_format($product->price, 0, ',', '.') }}</strong>
                        </p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Tallas --}}
                            <select name="size_id" class="form-control mb-2" required>
                                <option value="">Seleccione Talla</option>
                                @foreach ($product->variants->unique('size_id') as $variant)
                                    @if ($variant->size)
                                        <option value="{{ $variant->size->id }}">{{ $variant->size->label }}</option>
                                    @endif
                                @endforeach
                            </select>

                            {{-- Colores --}}
                            <select name="color_id" class="form-control mb-2" required>
                                <option value="">Seleccione Color</option>
                                @foreach ($product->variants->unique('color_id') as $variant)
                                    @if ($variant->color)
                                        <option value="{{ $variant->color->id }}">{{ $variant->color->name }}</option>
                                    @endif
                                @endforeach
                            </select>


                            <button type="submit" class="btn btn-primary w-100">Añadir al carrito 🛒</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
