<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Lego</title>
    <link rel="stylesheet" href="{{asset('css/piezaslego.css')}}">
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
            <p>Famoso barco Titanic de lego</p>
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
            <img src="{{ asset('img/bus.png') }}" alt="Autobus de batalla">
            <h3>Autobus de batalla</h3>
            <p>Autobus de batalla del juego fornithe</p>
            <div class="product-details">
                <span class="price" data-price="100">€100</span>
            </div>
            <button class="add-to-cart" 
                    data-id="3" 
                    data-nombre="Autobus de batalla"
                    data-precio="100"
                    data-imagen="img/bus.png">
                Añadir al Carrito
            </button>
        </div>

        <!-- Producto 4 -->
        <div class="product-card">
            <div class="product-badge">Nuevo</div>
            <img src="{{ asset('img/torre.png') }}" alt="Torre Eiffel">
            <h3>Torre Eiffel</h3>
            <p>Torre Eiffel de paris</p>
            <div class="product-details">
                <span class="price" data-price="620">€620</span>
            </div>
            <button class="add-to-cart" 
                    data-id="4" 
                    data-nombre="Torre Eiffel"
                    data-precio="620"
                    data-imagen="img/torre.png">
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
                    data-imagen="img/Arbol.png">
                Añadir al Carrito
            </button>
        </div>
    </div>
</section>


<section class="fortnite-collaboration">
    <div class="collaboration-content" style="max-width: 1400px; margin: 0 auto; padding: 20px;">
        <h3 style="font-size: 1.5rem; color: #FFD700; margin-bottom: 20px; text-align: center;">Juega en tu universo favorito</h3>
        <div class="collaboration-container" style="display: flex; align-items: center; gap: 30px;">
            <a href="https://www.fortnite.com/@epic/lego-fortnite?lang=es-ES" target="_blank" style="text-decoration: none; display: block;">
                <img src="{{ asset('img/legofortnite.png') }}" 
                     alt="LEGO Fortnite" 
                     class="fortnite-img"
                     style="width: 1000px; height: auto; object-fit: contain; cursor: pointer; transition: transform 0.2s ease;"
                     onmouseover="this.style.transform='scale(1.01)'" 
                     onmouseout="this.style.transform='scale(1)'"
                >
            </a>
            <p style="margin: 0; font-size: 1rem; color: #ffffff; line-height: 1.4;">
                Cuando construyes sets LEGO® de tus franquicias de videojuegos favoritas, tú decides el rumbo que toma tu próxima aventura. Crea nuevas historias y mundos nunca antes vistos, visita a viejos amigos y haz otros nuevos. Todo es posible y todo está aquí, ¡listo para que te sumerjas!
            </p>
        </div>
    </div>
</section>


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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menú hamburguesa
        let menuIcon = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');
        
        menuIcon.addEventListener('click', function() {
            menuIcon.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        });

        // Cerrar menú al hacer scroll
        window.addEventListener('scroll', function() {
            menuIcon.classList.remove('bx-x');
            navbar.classList.remove('open');
        });

        // Animación de productos al hacer scroll
        const productCards = document.querySelectorAll('.product-card');
        
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        productCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease-in-out';
            observer.observe(card);
        });

        // Funcionalidad del carrito
        $('.add-to-cart').click(function(e) {
            e.preventDefault();
            
            let button = $(this);
            let producto = {
                id: button.data('id'),
                nombre: button.data('nombre'),
                precio: button.data('precio'),
                imagen: button.data('imagen')
            };

            $.ajax({
                url: '{{ route("carrito.add") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: producto.id,
                    nombre: producto.nombre,
                    precio: producto.precio,
                    imagen: producto.imagen
                },
                success: function(response) {
                    if(response.success) {
                        button.css('backgroundColor', '#cc0000');
                        button.text('¡Añadido!');
                        
                        setTimeout(() => {
                            button.css('backgroundColor', '#FF0000');
                            button.text('Añadir al Carrito');
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al añadir al carrito:', error);
                    alert('Error al añadir el producto al carrito');
                }
            });
        });

        // Efecto hover en las tarjetas de productos
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Animación del logo de Fortnite
        const fortniteLogo = document.querySelector('.collaboration-container img');
        if(fortniteLogo) {
            fortniteLogo.style.transition = 'transform 0.3s ease';
            fortniteLogo.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            fortniteLogo.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        }
    });

    let lastScrollPosition = 0;
    const header = document.querySelector('header');
    
    window.addEventListener('scroll', () => {
        const currentScrollPosition = window.pageYOffset;
        
        if (currentScrollPosition > lastScrollPosition) {
            // Scrolling down
            header.classList.add('hidden');
        } else {
            // Scrolling up
            header.classList.remove('hidden');
        }
        
        lastScrollPosition = currentScrollPosition;
    });

    // Nuevas animaciones de entrada
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

        // Animación del título principal
        const mainTitle = document.querySelector('h2');
        mainTitle.style.opacity = '0';
        mainTitle.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            mainTitle.style.transition = 'all 0.5s ease';
            mainTitle.style.opacity = '1';
            mainTitle.style.transform = 'translateY(0)';
        }, 300);

        // Animación de las tarjetas de productos
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(40px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 500 + (index * 200)); // Cada tarjeta aparece 200ms después que la anterior
        });

        // Animación de la sección de Fortnite5
        const fortniteSectionTitle = document.querySelector('.fortnite-collaboration h2');
        const fortniteLogo = document.querySelector('.collaboration-container img');
        
        fortniteSectionTitle.style.opacity = '0';
        fortniteSectionTitle.style.transform = 'translateX(-30px)';
        
        fortniteLogo.style.opacity = '0';
        fortniteLogo.style.transform = 'scale(0.8)';

        // Observador de intersección para la sección de Fortnite
        const fortniteObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        fortniteSectionTitle.style.transition = 'all 0.8s ease';
                        fortniteSectionTitle.style.opacity = '1';
                        fortniteSectionTitle.style.transform = 'translateX(0)';
                    }, 100);

                    setTimeout(() => {
                        fortniteLogo.style.transition = 'all 0.8s ease';
                        fortniteLogo.style.opacity = '1';
                        fortniteLogo.style.transform = 'scale(1)';
                    }, 400);
                }
            });
        }, { threshold: 0.2 });

        fortniteObserver.observe(document.querySelector('.fortnite-collaboration'));

        // Animación del footer
        const footer = document.querySelector('.footer');
        const socialLinks = document.querySelectorAll('.social-link');
        
        footer.style.opacity = '0';
        footer.style.transform = 'translateY(20px)';
        
        socialLinks.forEach(link => {
            link.style.opacity = '0';
            link.style.transform = 'scale(0.8)';
        });

        const footerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.style.transition = 'all 0.5s ease';
                    footer.style.opacity = '1';
                    footer.style.transform = 'translateY(0)';

                    socialLinks.forEach((link, index) => {
                        setTimeout(() => {
                            link.style.transition = 'all 0.5s ease';
                            link.style.opacity = '1';
                            link.style.transform = 'scale(1)';
                        }, 200 + (index * 150));
                    });
                }
            });
        }, { threshold: 0.2 });

        footerObserver.observe(footer);
    });

    const fortniteImg = document.querySelector('.fortnite-img');
    const collaborationText = document.querySelector('.collaboration-text');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Animar el texto primero
                setTimeout(() => {
                    collaborationText.classList.add('visible');
                }, 200);
                
                // Luego animar la imagen
                setTimeout(() => {
                    fortniteImg.classList.add('visible');
                    
                    // Añadir animación de flotación suave
                    let floating = true;
                    const floatAnimation = () => {
                        if (!floating) return;
                        fortniteImg.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            if (!floating) return;
                            fortniteImg.style.transform = 'translateY(0px)';
                        }, 1000);
                    };

                    setInterval(floatAnimation, 2000);
                    
                    fortniteImg.addEventListener('mouseenter', () => {
                        floating = false;
                        fortniteImg.style.transform = 'scale(1.05) rotate(2deg)';
                    });
                    
                    fortniteImg.addEventListener('mouseleave', () => {
                        floating = true;
                        fortniteImg.style.transform = 'translateY(0)';
                    });
                }, 500);
            }
        });
    }, { threshold: 0.2 });

    observer.observe(document.querySelector('.collaboration-container'));
</script>


</body>
</html>