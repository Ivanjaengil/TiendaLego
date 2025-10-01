<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo LEGO</title>
    <link rel="stylesheet" href="{{asset('css/piezaslego.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .add-to-cart {
            background-color: #FF0000;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .add-to-cart:hover {
            background-color: #cc0000;
        }

        .pieza-card {
            position: relative;
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .ripple {
            position: absolute;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            pointer-events: none;
            width: 100px;
            height: 100px;
            transform: scale(0);
            animation: ripple-effect 0.6s linear;
        }

        @keyframes ripple-effect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .add-to-cart, .view-details {
            position: relative;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <header>
        <a href="" class="logo">
            <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60px">
        </a>
        <ul class="navbar">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('piezaslego.index') }}" class="active">PiezasLego</a></li>
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

        <div class="products-grid">
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
                            <img src="{{ asset('img/torre.png') }}" alt="{{ $pieza->nombre }}">
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
                    <h3>{{ $pieza->nombre }}</h3>
                    <p>{{ $pieza->descripcion }}</p>
                    <div class="product-price">{{ number_format($pieza->precio, 2) }}€</div>
                    <button class="add-to-cart" data-id="{{ $pieza->id }}">Añadir al Carrito</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <footer class="footer">
    <div class="footer-content">
        <!-- Información de Contacto -->
        <div class="footer-section">
            <h4>Redes Sociales</h4>
            <!-- Redes Sociales -->
            <div class="social-links">
                <a href="https://x.com/LEGO_Group" class="social-link">
                    <img src="{{ asset('img/x.png') }}" alt="Twitter" style="width: 45px; height: 45px;">
                </a>
                <a href="https://www.facebook.com/LEGO/" class="social-link">
                    <img src="{{ asset('img/facebook.png') }}" alt="Facebook" style="width: 45px; height: 45px;">
                </a>
                <a href="https://www.instagram.com/lego/" class="social-link">
                    <img src="{{ asset('img/instagram.png') }}" alt="Instagram" style="width: 45px; height: 45x;">
                </a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <p class="copyright">&copy; 2024 LEGO Store</p>
    </div>
</footer>

    <script src="{{ asset('js/catalog.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.add-to-cart').click(function(e) {
            e.preventDefault();
            
            var id = $(this).data('id');
            
            $.ajax({
                url: '{{ route("carrito.add") }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    if(response.success) {
                        alert('Producto añadido al carrito');
                    }
                }
            });
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación del header
            const header = document.querySelector('header');
            header.style.opacity = '0';
            header.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                header.style.transition = 'all 0.5s ease';
                header.style.opacity = '1';
                header.style.transform = 'translateY(0)';
            }, 100);

            // Animación para el título de la sección
            const sectionTitle = document.querySelector('h1, h2');
            if (sectionTitle) {
                sectionTitle.style.opacity = '0';
                sectionTitle.style.transform = 'translateX(-30px)';
                
                setTimeout(() => {
                    sectionTitle.style.transition = 'all 0.5s ease';
                    sectionTitle.style.opacity = '1';
                    sectionTitle.style.transform = 'translateX(0)';
                }, 300);
            }

            // Animación para las piezas LEGO
            const piezas = document.querySelectorAll('.pieza-card');
            piezas.forEach((pieza, index) => {
                pieza.style.opacity = '0';
                pieza.style.transform = 'scale(0.8)';
                
                setTimeout(() => {
                    pieza.style.transition = 'all 0.5s ease';
                    pieza.style.opacity = '1';
                    pieza.style.transform = 'scale(1)';
                }, 500 + (index * 100));
            });

            // Efecto hover para las piezas
            piezas.forEach(pieza => {
                pieza.addEventListener('mouseenter', () => {
                    pieza.style.transform = 'translateY(-10px) scale(1.03)';
                    pieza.style.boxShadow = '0 10px 20px rgba(0,0,0,0.2)';
                });

                pieza.addEventListener('mouseleave', () => {
                    pieza.style.transform = 'translateY(0) scale(1)';
                    pieza.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
                });
            });

            // Animación para los botones
            const buttons = document.querySelectorAll('.add-to-cart, .view-details');
            buttons.forEach((button, index) => {
                button.style.opacity = '0';
                button.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    button.style.transition = 'all 0.5s ease';
                    button.style.opacity = '1';
                    button.style.transform = 'translateY(0)';
                }, 800 + (index * 50));
            });

            // Efecto de click para los botones
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    let ripple = document.createElement('div');
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);

                    let x = e.clientX - e.target.offsetLeft;
                    let y = e.clientY - e.target.offsetTop;

                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Animación al hacer scroll
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observar elementos que aparecen al hacer scroll
            document.querySelectorAll('.pieza-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>