@extends('layout')

@section('title', 'Sobre Nosotros')

@section('content')
<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-8 text-white">
                <h1>Sobre Nosotros</h1>
                <p>Una marca familiar diseñana para impactar el mundo. Encuentra la mejor moda y calzado con la mejor calidad y estilo.</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('assets/img/about-hero.svg') }}" alt="Nosotros">
            </div>
        </div>
    </div>
</section>
@endsection
