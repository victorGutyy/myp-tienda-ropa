@extends('layout')

@section('title', 'Sobre Nosotros')

@section('content')

<!-- Banner con imagen de fondo -->
<section class="about-hero d-flex align-items-center">
    <div class="container text-white text-center">
        <h1 class="display-4 fw-bold">¡Bienvenido a MYP Tienda de Ropa!</h1>
        <p class="lead mt-3">
            Pasión por la moda, compromiso con la calidad.<br>
            tenemos experiencias para cada estilo de vida.
        </p>
    </div>
</section>

<!-- Sección de contenido informativo -->
<section class="historia-section">
    <div class="container">
        <h2>Nuestra Historia</h2>
        
        <p>
            MYP Tienda de Ropa nació como un proyecto familiar con el sueño de vestir a Colombia con prendas de excelente calidad y estilo.
            Nos enfocamos en ofrecer productos modernos, asequibles y con diseños únicos que reflejan tu personalidad.
        </p>
        <p>
            Gracias a la confianza de nuestros clientes, hemos expandido nuestra presencia y seguimos trabajando con amor por lo que hacemos.
        </p>
    </div>
</section>

@endsection
