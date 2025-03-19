@extends('layout')

@section('title', 'Crear Producto')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Agregar Nuevo Producto</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Producto</button>
    </form>
</div>
@endsection
