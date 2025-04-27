@extends('layout')

@section('title', 'Contacto')

@section('content')

<div class="container py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contáctanos</h1>
        <p>
            Si tienes alguna consulta o comentario, por favor completa el siguiente formulario y nos pondremos en contacto contigo.
        </p>
    </div>
</div>

<!-- Mostrar mensajes de éxito o error -->
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger text-center">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Contact Form -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" action="{{ route('contact.post') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Nombre</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Tu nombre" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Correo Electrónico</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Tu correo" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Asunto</label>
                <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Asunto" required>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Mensaje</label>
                <textarea class="form-control mt-1" id="message" name="message" placeholder="Escribe tu mensaje" rows="6" required></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
