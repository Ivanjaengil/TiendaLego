<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">
    <header>
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60px">
        </a>

        <ul class="navbar">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
            <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
            <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
        </ul>

        <div class="main">
            @auth
                <span class="user">
                    <i class="ri-user-fill"></i> {{ Auth::user()->name }}
                </span>
                <a href="{{ route('profile.edit') }}" class="user">Perfil</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="user">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="user">
                    <i class="fas fa-user mr-2"></i> Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="user">
                    <i class="fas fa-user-plus mr-2"></i> Registrarse
                </a>
            @endauth
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <main>
        @hasSection('content')
            @yield('content')        {{-- Para vistas con @extends --}}
        @else
            {{ $slot ?? '' }}        {{-- Para vistas con <x-app-layout> --}}
        @endif
    </main>
</body>
</html>
