{{-- resources/views/components/guest-layout.blade.php --}}
@php
    // Si existe manifest, @vite usará /build/assets; si falta alguna entrada o no hay manifest, usamos fallback.
    $expected = [
        'resources/css/app.css',
        'resources/css/auth.css',
        'resources/js/app.js',
    ];
    $manifestPath = public_path('build/manifest.json');
    $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;

    $missing = [];
    if ($manifest) {
        foreach ($expected as $entry) {
            if (!array_key_exists($entry, $manifest)) {
                $missing[] = $entry;
            }
        }
    } else {
        $missing = $expected;
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- CSS base propio -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <!-- Iconos / Fuentes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @if ($manifest && empty($missing))
        {{-- Manifest OK: usa Vite/Build --}}
        @vite($expected)
    @else
        {{-- Fallback SIN Vite: incrustamos desde resources/* --}}
        @php
            $appCss  = resource_path('css/app.css');
            $authCss = resource_path('css/auth.css');
            $appJs   = resource_path('js/app.js');
        @endphp

        @if (file_exists($appCss))
            <style>{{ file_get_contents($appCss) }}</style>
        @endif

        @if (file_exists($authCss))
            <style>{{ file_get_contents($authCss) }}</style>
        @endif

        {{-- Incrusta JS solo si es vanilla (sin imports/ESM). No es necesario para el register/login. --}}
        @if (file_exists($appJs))
            @php $appJsContent = file_get_contents($appJs); @endphp
            @if (strpos($appJsContent, 'import ') === false && strpos($appJsContent, 'export ') === false)
                <script>{!! $appJsContent !!}</script>
            @endif
        @endif
    @endif

    @stack('styles')
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
                <span class="user"><i class="ri-user-fill"></i> {{ Auth::user()->name }}</span>
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
        {{ $slot }}
    </main>
</body>
</html>
