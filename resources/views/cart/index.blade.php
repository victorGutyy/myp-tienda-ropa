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
    $total = array_sum(array_column($cart, 'price')); // con IVA incluido
    $subtotal = $total / 1.19;
    $iva = $total - $subtotal;
@endphp


<div class="text-end mt-3">
<p><strong>Subtotal:</strong> ${{ number_format($subtotal, 0, ',', '.') }}</p>
<p><strong>IVA (19%):</strong> ${{ number_format($iva, 0, ',', '.') }}</p>
<h4><strong>Total a pagar:</strong> <span class="text-success">${{ number_format($total, 0, ',', '.') }}</span></h4>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Proceder al pago</a>
        </div>
    </div>
</div>

@endsection
