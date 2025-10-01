<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito</title>

  <!-- CSRF para AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('css/carrito.css') }}?v=140">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
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
      <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
      <li><a href="{{ route('carrito.index') }}" class="active">Carrito</a></li>
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

  <!-- CONTENIDO DEL CARRITO -->
  <div class="cart-container">
    <div class="cart-card">
      <h1 class="cart-title">Mi Carrito de Compras</h1>

      <div class="cart-content">
        <!-- Columna izquierda: productos -->
        <div class="cart-items">
          @if(session('cart') && count(session('cart')) > 0)
            @foreach(session('cart') as $id => $details)
              <div class="cart-item" data-id="{{ $id }}">
                <div class="cart-item-image">
                  <img src="{{ asset($details['imagen']) }}" alt="{{ $details['nombre'] }}">
                </div>
                <div class="cart-item-details">
                  <h3>{{ $details['nombre'] }}</h3>
                  <p class="precio-unitario">Precio unitario: {{ number_format($details['precio'], 2) }}€</p>
                  <div class="quantity-controls">
                    <button class="decrease-quantity">-</button>
                    <input type="number" value="{{ $details['cantidad'] }}" min="1" class="quantity-input">
                    <button class="increase-quantity">+</button>
                  </div>
                  <p class="subtotal">Subtotal: {{ number_format($details['precio'] * $details['cantidad'], 2) }}€</p>
                  <button class="remove-item">Eliminar</button>
                </div>
              </div>
            @endforeach
          @else
            <div class="empty-cart">
              <p>Tu carrito está vacío</p>
              <a href="{{ route('piezaslego.index') }}" class="continue-shopping">Continuar Comprando</a>
            </div>
          @endif
        </div>

        <!-- Columna derecha: resumen -->
        @if(session('cart') && count(session('cart')) > 0)
          <div class="cart-summary sticky-summary">
            <h3>Resumen del Pedido</h3>
            <p><strong>Total: </strong><span id="cart-total">{{ $total }}</span></p>
            <a href="{{ route('pago.mostrar') }}" class="checkout-button">Proceder al Pago</a>
          </div>
        @endif
      </div>
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

  <!-- Rutas Laravel para el JS externo -->
  <script>
    window.routes = {
      carritoRemove: "{{ route('carrito.remove') }}",
      carritoUpdate: "{{ url('/carrito/update') }}",
      piezaslegoIndex: "{{ route('piezaslego.index') }}"
    };
  </script>

  <!-- JS del carrito -->
  <script src="{{ asset('js/carrito.js') }}?v=2"></script>
</body>
</html>
