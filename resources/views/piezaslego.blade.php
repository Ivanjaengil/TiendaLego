<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Piezas LEGO</title>

  <!-- CSRF para AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/piezaslego.css') }}?v=121">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <!-- HEADER -->
  <header>
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60">
    </a>

    <ul class="navbar">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('piezaslego.index') }}" class="active">PiezasLego</a></li>
      <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
      <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
    </ul>

    <div class="main">
      @if (Auth::check())
        <a href="{{ route('profile.edit') }}" class="user"><i class="ri-user-fill"></i>Perfil</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="user">
            <i class="ri-logout-box-r-line"></i>Cerrar Sesión
          </a>
        </form>
      @else
        <a href="{{ route('login') }}" class="user">
          <div class="flex items-center">
            <i class="fas fa-user fa-2x mr-2"></i>
            <span class="text-lg">Iniciar Sesión</span>
          </div>
        </a>
        <a href="{{ route('register') }}" class="user">
          <div class="flex items-center">
            <i class="fas fa-user-plus fa-2x mr-2"></i>
            <span class="text-lg">Registrarse</span>
          </div>
        </a>
      @endif

    </div>
  </header>

  <!-- CATÁLOGO -->
  <div class="catalog-container">
    <h1 class="catalog-title">Catálogo de Piezas LEGO</h1>

    <div class="filters">
      <input type="text" id="searchInput" placeholder="Buscar piezas...">
      <select id="sortSelect">
        <option value="name">Ordenar por nombre</option>
        <option value="price-asc">Precio: Menor a Mayor</option>
        <option value="price-desc">Precio: Mayor a Menor</option>
      </select>
    </div>

    <div class="products-grid" id="productsGrid">
      @foreach($piezas as $pieza)
        <div class="product-card" data-price="{{ $pieza->precio }}">
          <div class="product-image">
            @switch(strtolower($pieza->nombre))
              @case('casa papa noel')
                <img src="{{ asset('img/Oficina-PapaNoel.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('titanic')
                <img src="{{ asset('img/titanic.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('autobus de batalla')
                <img src="{{ asset('img/bus.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('torre eiffel')
                <img src="{{ asset('img/torre-eiffel.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('radio')
                <img src="{{ asset('img/radio.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('vengadores')
                <img src="{{ asset('img/Torre-vengadores.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('arbol de navidad')
                <img src="{{ asset('img/Arbol.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('taxi')
                <img src="{{ asset('img/taxi.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('museo')
                <img src="{{ asset('img/Museo.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('trineo')
                <img src="{{ asset('img/Trineo.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('cabina telefono')
                <img src="{{ asset('img/Cabina.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('groot')
                <img src="{{ asset('img/Groot.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('jardin')
                <img src="{{ asset('img/Jardin.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('torre')
                <img src="{{ asset('img/Torre.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @case('flores')
                <img src="{{ asset('img/Flores.png') }}" alt="{{ $pieza->nombre }}">
                @break
              @default
                <img src="{{ asset('img/lego-logo.jpg') }}" alt="{{ $pieza->nombre }}">
            @endswitch
          </div>

          <div class="product-info">
            <h3 class="product-name">{{ $pieza->nombre }}</h3>
            <p>{{ $pieza->descripcion }}</p>
            <div class="product-price">{{ number_format($pieza->precio, 2) }}€</div>
            <button class="add-to-cart" data-id="{{ $pieza->id }}">Añadir al Carrito</button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h4>Redes Sociales</h4>
        <div class="social-links">
          <a href="https://x.com/LEGO_Group" class="social-link">
            <img src="{{ asset('img/x.png') }}" alt="Twitter" style="width: 45px; height: 45px;">
          </a>
          <a href="https://www.facebook.com/LEGO/" class="social-link">
            <img src="{{ asset('img/facebook.png') }}" alt="Facebook" style="width: 45px; height: 45px;">
          </a>
          <a href="https://www.instagram.com/lego/" class="social-link">
            <img src="{{ asset('img/instagram.png') }}" alt="Instagram" style="width: 45px; height: 45px;">
          </a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 LEGO Store</p>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Rutas para JS externo -->
  <script>
    window.routes = {
      carritoAdd: "{{ route('carrito.add') }}"
    };
  </script>

  <!-- JS externo de PiezasLego -->
  <script src="{{ asset('js/piezaslego.js') }}?v=1"></script>
</body>
</html>
