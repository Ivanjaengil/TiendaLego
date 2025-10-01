<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tienda Lego</title>

  <!-- CSRF para AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v=120">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- Estilos mínimos específicos (si ya los tienes en welcome.css, puedes quitarlos) -->
  <style>
    body { padding-top: 80px; }
    header { position: fixed; top: 0; width: 100%; background-color: #1a1a1a; z-index: 1000; transition: transform 0.3s ease; }
    header.hidden { transform: translateY(-100%); }
    .add-to-cart {
      width: 100%; background-color: #FF0000; color: white; border: none;
      padding: 12px 25px; border-radius: 5px; cursor: pointer; font-size: 16px;
      margin-top: auto; transition: all 0.3s ease;
    }
    .add-to-cart:hover { background-color: #4CAF50; transform: translateY(-2px); box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
    .product-details { display: flex; flex-direction: column; margin-top: auto; }
    .price { margin-bottom: 15px; }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header>
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60">
    </a>

    <ul class="navbar">
      <li><a href="{{ route('home') }}" class="active">Home</a></li>
      <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
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

  <!-- DESTACADOS -->
  <section class="featured-products">
    <h2>Sets Exclusivos</h2>

    <div class="product-grid">
      <!-- Producto 1 -->
      <div class="product-card">
        <div class="product-badge">Nuevo</div>
        <img src="{{ asset('img/Oficina-PapaNoel.png') }}" alt="Casa Papa Noel">
        <h3>Casa Papa Noel</h3>
        <p>Oficina de Correos de Papa Noel</p>
        <div class="product-details">
          <span class="price" data-price="100">€100</span>
        </div>
        <button class="add-to-cart"
                data-id="1"
                data-nombre="Casa Papa Noel"
                data-precio="100"
                data-imagen="img/Oficina-PapaNoel.png">
          Añadir al Carrito
        </button>
      </div>

      <!-- Producto 2 -->
      <div class="product-card">
        <div class="product-badge">Nuevo</div>
        <img src="{{ asset('img/Titanic.png') }}" alt="Titanic">
        <h3>Titanic</h3>
        <p>Famoso barco Titanic de LEGO</p>
        <div class="product-details">
          <span class="price" data-price="600">€600</span>
        </div>
        <button class="add-to-cart"
                data-id="2"
                data-nombre="Titanic"
                data-precio="600"
                data-imagen="img/Titanic.png">
          Añadir al Carrito
        </button>
      </div>

      <!-- Producto 3 -->
      <div class="product-card">
        <div class="product-badge">Nuevo</div>
        <img src="{{ asset('img/bus.png') }}" alt="Autobús de batalla">
        <h3>Autobús de batalla</h3>
        <p>Autobús de batalla del juego Fortnite</p>
        <div class="product-details">
          <span class="price" data-price="100">€100</span>
        </div>
        <button class="add-to-cart"
                data-id="3"
                data-nombre="Autobús de batalla"
                data-precio="100"
                data-imagen="img/bus.png">
          Añadir al Carrito
        </button>
      </div>

      <!-- Producto 4 -->
      <div class="product-card">
        <div class="product-badge">Nuevo</div>
        <img src="{{ asset('img/torre-eiffel.png') }}" alt="Torre Eiffel">
        <h3>Torre Eiffel</h3>
        <p>Torre Eiffel de París</p>
        <div class="product-details">
          <span class="price" data-price="620">€620</span>
        </div>
        <button class="add-to-cart"
                data-id="4"
                data-nombre="Torre Eiffel"
                data-precio="620"
                data-imagen="img/torre-eiffel.png">
          Añadir al Carrito
        </button>
      </div>

      <!-- Producto 5 -->
      <div class="product-card">
        <div class="product-badge">Nuevo</div>
        <img src="{{ asset('img/radio.png') }}" alt="Radio">
        <h3>Radio</h3>
        <p>Radio retro</p>
        <div class="product-details">
          <span class="price" data-price="100">€100</span>
        </div>
        <button class="add-to-cart"
                data-id="5"
                data-nombre="Radio"
                data-precio="100"
                data-imagen="img/radio.png">
          Añadir al Carrito
        </button>
      </div>
    </div>
  </section>

  <!-- Colaboración Fortnite -->
  <section class="fortnite-collaboration">
    <div class="collaboration-content" style="max-width: 1400px; margin: 0 auto; padding: 20px;">
      <h3 style="font-size: 1.5rem; color: #FFD700; margin-bottom: 20px; text-align: center;">
        Juega en tu universo favorito
      </h3>

      <div class="collaboration-container" style="display: flex; align-items: center; gap: 30px;">
        <a href="https://www.fortnite.com/@epic/lego-fortnite?lang=es-ES" target="_blank" style="text-decoration: none; display: block;">
          <img src="{{ asset('img/legofortnite.png') }}"
               alt="LEGO Fortnite"
               class="fortnite-img"
               style="width: 1000px; height: auto; object-fit: contain; cursor: pointer;">
        </a>

        <p class="collaboration-text" style="margin: 0; font-size: 1rem; color: #ffffff; line-height: 1.4;">
          Cuando construyes sets LEGO® de tus franquicias de videojuegos favoritas, tú decides el rumbo que toma tu próxima aventura. Crea nuevas historias y mundos nunca antes vistos, visita a viejos amigos y haz otros nuevos. Todo es posible y todo está aquí, ¡listo para que te sumerjas!
        </p>
      </div>
    </div>
  </section>

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
      carritoAdd: "{{ route('carrito.add') }}",
      piezaslegoIndex: "{{ route('piezaslego.index') }}"
    };
  </script>

  <!-- JS externo de Home -->
  <script src="{{ asset('js/home.js') }}?v=1"></script>
</body>
</html>
