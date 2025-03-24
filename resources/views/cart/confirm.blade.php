@extends('layout')

@section('content')
<div class="container text-center mt-5">
    <h2 class="text-success">¡Compra Confirmada! 🎉</h2>
    <p class="lead">Gracias por tu compra. Pronto recibirás tu pedido.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver al inicio</a>
</div>
@endsection
