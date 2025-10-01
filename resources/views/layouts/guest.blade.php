<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Estilos que ya tenías en el login -->
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <a href="" class="logo"><i class="ri-home-7-fill"></i><span>Logo</span></a>
        <ul class="navbar">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
            <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
            <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
        </ul>

        <div class="main">
            @if (Auth::check())
                <a href="{{ route('profile.edit') }}" class="user"><i class="ri-user-fill"></i>Perfil</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="user">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="user"><i class="ri-user-fill"></i>Iniciar Sesión</a>
                <a href="{{ route('register') }}">Registrarse</a>
            @endif
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>