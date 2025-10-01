<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="{{asset('css/contacto.css')}}?v=140">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <a href="{{route('home')}}" class="logo">
            <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60px">
        </a>
        <ul class="navbar">
            <li><a href="{{ route('home') }}" >Home</a></li>
            <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
            <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
            <li><a href="{{ route('contacto.index') }}"class="active">Contacto</a></li>
        </ul>

        <div class="main">
            @if (Auth::check())
                <a href="{{ route('profile.edit') }}" class="user"><i class="ri-user-fill"></i>Perfil</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
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
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="contact-container">
        <h1>Contacto</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="contact-form">
            <form action="{{ route('contacto.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>              

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="asunto">Asunto:</label>
                    <input type="text" id="asunto" name="asunto" required>
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Enviar Mensaje</button>
            </form>
        </div>

        <div class="contact-info">
            <h2>Información de Contacto</h2>
            <div class="info-item">
                <i class="ri-map-pin-line"></i>
                <p>Calle Principal 123, Ciudad</p>
            </div>
            <div class="info-item">
                <i class="ri-phone-line"></i>
                <p>+34 123 456 789</p>
            </div>
            <div class="info-item">
                <i class="ri-mail-line"></i>
                <p>info@tulegostore.com</p>
            </div>
        </div>
    </div>
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
        <p class="copyright">&copy; 2024 LEGO Store</p>
    </div>
</footer>

<!-- JS -->
<script src="{{ asset('js/contacto.js') }}?v=1"></script>
</body>
</html>
