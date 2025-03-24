@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-success"><i class="fa fa-shopping-cart"></i> Tu Carrito de Compras</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $index => $item)
                    <tr>
                        <td>{{ $item['product'] }}</td>
                        <td>${{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="text-center">
                            <form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('¿Eliminar este producto del carrito?');">
                                @csrf
                                <input type="hidden" name="index" value="{{ $index }}">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $total = array_sum(array_column($cart, 'price'));
        @endphp

        <div class="d-flex justify-content-between align-items-center mt-3">
            <h4 class="text-success">Total a pagar: ${{ number_format($total, 0, ',', '.') }}</h4>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Proceder al pago</a>
        </div>
    </div>
</div>

@endsection
