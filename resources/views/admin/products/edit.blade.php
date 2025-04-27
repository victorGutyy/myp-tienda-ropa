@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-success mb-4">Editar Producto</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Atención!</strong> Corrige los siguientes errores:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Muy importante para que funcione el update -->

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del producto</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Cantidad</label>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category">Categoría</label>
            <input type="text" name="category" class="form-control" value="{{ $product->category }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
@