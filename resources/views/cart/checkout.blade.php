@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-success">Resumen del Pedido</h2>
    <p class="text-center text-muted">Gracias por tu compra. A continuación se muestra el resumen de tu pedido:</p>

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['product'] }}</td>
                        <td>${{ number_format($item['price'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-end">
        <h4>Total a pagar: <span class="text-success">${{ number_format($total, 0, ',', '.') }}</span></h4>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">Volver al inicio</a>
        <a href="{{ route('cart.confirm') }}" class="btn btn-success">Confirmar Compra ✅</a>
    </div>
</div>
@endsection
