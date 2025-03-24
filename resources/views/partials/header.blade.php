<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center text-success logo h1" href="{{ url('/') }}">
            <!-- Agregamos el Logo -->
            <img src="{{ asset('assets/img/logomyp.jpg') }}" alt="Logo MYP" class="logo-img">
            <span class="ms-2">MYP TIENDA DE ROPA</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    
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
                <a class="nav-icon position-relative text-decoration-none" href="{{ route('cart.index') }}">
                <i class="fa fa-fw fa-shopping-cart text-dark"></i>
                <span class="badge rounded-pill bg-light text-dark">
                {{ count(session('cart', [])) }}
                </span>
                 </a>
                 
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
        </div>
    </div>
</nav>
