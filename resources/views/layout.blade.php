<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logomyp.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
</head>

@php use Illuminate\Support\Facades\Auth; @endphp

<body>
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">MYP_TIENDA@SOLOMODA.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:355-555-9999">355-555-9999</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center text-success logo h1" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logomyp.jpg') }}" alt="Logo MYP" class="logo-img">
            <span class="ms-2">MYP TIENDA DE ROPA</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">NOSOTROS</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">CONTACTANOS</a></li>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item mx-2">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-custom btn-sm">
                                    <i class="fas fa-cogs me-1"></i> Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-sign-out-alt me-1"></i> Salir
                                    </button>
                                </form>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <a class="nav-icon position-relative text-decoration-none me-3" href="{{ route('cart.index') }}">
                    <i class="fa fa-fw fa-shopping-cart text-dark"></i>
                    <span class="badge rounded-pill bg-light text-dark">
                        {{ count(session('cart', [])) }}
                    </span>
                </a>
                <button type="button" class="btn btn-outline-success btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fas fa-sign-in-alt "></i> Iniciar Sesión
                </button>
            </div>
        </div>
    </div>
    </nav>

   <!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Aquí sí debe ir el include correctamente -->
            <div class="modal-body">
                @include('auth.partials.login-form')
            </div>

        </div>
    </div>
</div>



    <!-- Contenido -->
    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3">MYP TIENDA DE ROPA</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><i class="fas fa-map-marker-alt fa-fw"></i> 123 Consectetur at ligula 10660</li>
                        <li><i class="fa fa-phone fa-fw"></i> <a class="text-decoration-none" href="tel:010-020-0340">355-555-9999</a></li>
                        <li><i class="fa fa-envelope fa-fw"></i> <a class="text-decoration-none" href="mailto:info@company.com">MYP_TIENDA@SOLOMODA.com</a></li>
                    </ul>
                    <div class="mt-3">
                        <a href="https://facebook.com" target="_blank" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com" target="_blank" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com" target="_blank" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="https://wa.me/573001234567" target="_blank" class="text-light"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

   <!-- JS -->
<script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/templatemo.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<div id="chatbot-container">
    <div id="chatbot-header">
        <img src="{{ asset('assets/img/logomyp.jpg') }}" alt="Logo MYP">
        <span>Asesor de Moda MYP</span>
    </div>
    <div id="chatbox"></div>
    <input type="text" id="chat-input" placeholder="Escribe tu pregunta...">
</div>
<!-- Botón flotante del chatbot -->
<button id="chat-toggle-btn" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #28a745;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    color: white;
    font-size: 28px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    z-index: 9999;
">
    💬
</button>


<!-- Script principal del chatbot -->
<script>
const chatInput = document.getElementById("chat-input");
const chatbox = document.getElementById("chatbox");
const chatContainer = document.getElementById("chatbot-container");
const toggleBtn = document.getElementById("chat-toggle-btn");

let userName = null;
let isWaitingForName = true;

// Mostrar el primer mensaje del chatbot
chatbox.innerHTML += `<div><strong>MYP:</strong> ¡Hola! Bienvenido a MYP Tienda de Ropa. ¿Cómo te llamas?</div>`;

chatInput.addEventListener("keydown", async function (e) {
    if (e.key === "Enter" && chatInput.value.trim() !== "") {
        const message = chatInput.value.trim();
        chatbox.innerHTML += `<div><strong>Tú:</strong> ${message}</div>`;
        chatInput.value = "";

        if (isWaitingForName) {
            userName = message;
            isWaitingForName = false;
            chatbox.innerHTML += `<div><strong>MYP:</strong> ¡Mucho gusto, ${userName}! ¿En qué puedo ayudarte hoy?</div>`;
            return;
        }

        try {
            const res = await fetch("http://127.0.0.1:8001/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    name: userName,
                    question: message
                })
            });

            const data = await res.json();
            chatbox.innerHTML += `<div><strong>MYP:</strong> ${data.response}</div>`;
            chatbox.scrollTop = chatbox.scrollHeight;
        } catch (err) {
            chatbox.innerHTML += `<div style="color:red;"><strong>Error:</strong> No se pudo conectar con el chatbot.</div>`;
        }
    }
});

// Mostrar/Ocultar el chatbot
toggleBtn.addEventListener("click", () => {
    const isVisible = chatContainer.style.display === "block";
    chatContainer.style.display = isVisible ? "none" : "block";
});
</script>






</body>
</html>
