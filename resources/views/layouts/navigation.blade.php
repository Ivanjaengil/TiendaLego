<nav class="bg-[#1a1a1d] border-b-2 border-red-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20"> <!-- 👈 altura fija -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" class="h-12">
                </a>
            </div>

            <!-- Links -->
            <ul class="flex space-x-8 text-yellow-400 font-semibold">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-red-600' : '' }}">Home</a></li>
                <li><a href="{{ route('piezaslego.index') }}" class="{{ request()->routeIs('piezaslego.index') ? 'text-red-600' : '' }}">PiezasLego</a></li>
                <li><a href="{{ route('carrito.index') }}" class="{{ request()->routeIs('carrito.index') ? 'text-red-600' : '' }}">Carrito</a></li>
                <li><a href="{{ route('contacto.index') }}" class="{{ request()->routeIs('contacto.index') ? 'text-red-600' : '' }}">Contacto</a></li>
            </ul>

            <!-- Botones -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="flex items-center text-yellow-400">
                        <i class="fas fa-user text-red-600 mr-1"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center text-yellow-400">
                        <i class="fas fa-user-plus text-red-600 mr-1"></i> Registrarse
                    </a>
                @endguest
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-yellow-400">Perfil</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
