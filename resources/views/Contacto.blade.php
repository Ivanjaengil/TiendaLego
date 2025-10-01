<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Lego</title>
    <link rel="stylesheet" href="{{asset('css/contacto.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            padding-top: 80px; /* Ajusta este valor según la altura de tu header */
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #1a1a1a;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        header.hidden {
            transform: translateY(-100%);
        }
    </style>
</head>
<body>
    <header>
        <a href="" class="logo">
            <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60px">
        </a>
        <ul class="navbar">
            <li><a href="{{ route('home.index') }}" class="active">Home</a></li>
            <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
            <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
            <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
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
                <a href="{{ route('login') }}" class="user"><i class="ri-user-fill"></i>Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="user"><i class='bx bx-user-plus'></i>Registrarse</a>
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



    <script>
        let menuIcon = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');
        
        // Toggle del menú hamburguesa
        menuIcon.addEventListener('click', () => {
            menuIcon.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        });

        // Efecto de scroll para el header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            const scrollPosition = window.scrollY;

            if (scrollPosition > 50) {
                header.style.background = '#000000';
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.3)';
                header.style.transition = 'all 0.3s ease';
            } else {
                header.style.background = 'transparent';
                header.style.boxShadow = 'none';
            }
        });

        // Animaciones para el formulario de contacto
        const formGroups = document.querySelectorAll('.form-group');
        
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                group.style.transition = 'all 0.5s ease';
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, 200 * index);
        });

        // Efecto hover para los campos del formulario
        const inputs = document.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.style.transform = 'scale(1.01)';
                input.style.transition = 'all 0.3s ease';
                input.style.borderColor = '#ff0000';
            });

            input.addEventListener('blur', () => {
                input.style.transform = 'scale(1)';
                input.style.borderColor = '#444';
            });
        });

        // Animación para la información de contacto
        const infoItems = document.querySelectorAll('.info-item');
        
        infoItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(20px)';
            
            setTimeout(() => {
                item.style.transition = 'all 0.5s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 300 * index);
        });

        // Efecto hover para el botón de enviar
        const submitBtn = document.querySelector('.submit-btn');
        
        submitBtn.addEventListener('mouseenter', () => {
            submitBtn.style.transform = 'translateY(-3px)';
            submitBtn.style.boxShadow = '0 5px 15px rgba(255, 0, 0, 0.3)';
        });
        
        submitBtn.addEventListener('mouseleave', () => {
            submitBtn.style.transform = 'translateY(0)';
            submitBtn.style.boxShadow = 'none';
        });

        
    </script>
</body>
</html>
</html>