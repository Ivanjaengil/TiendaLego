<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo LEGO</title>
    <link rel="stylesheet" href="{{asset('css/carrito.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .cart-item-image img {
            width: 100px; /* Ajusta el tamaño según lo que necesites */
            height: 100px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        .checkout-button {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            cursor: pointer;
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
            <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
            <li><a href="{{ route('carrito.index') }}"  class="active">Carrito</a></li>
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
    <div class="cart-container">
        <h1 class="cart-title">Mi Carrito de Compras</h1>
        
        <div class="cart-items">
            @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $id => $details)
                    <div class="cart-item" data-id="{{ $id }}">
                        <div class="cart-item-image">
                            @switch(strtolower($details['nombre']))
                                @case('casa papa noel')
                                    <img src="{{ asset('img/Oficina-PapaNoel.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('titanic')
                                    <img src="{{ asset('img/Titanic.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('autobus de batalla')
                                    <img src="{{ asset('img/bus.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('torre eiffel')
                                    <img src="{{ asset('img/torre.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('radio')
                                    <img src="{{ asset('img/radio.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('vengadores')
                                    <img src="{{ asset('img/Torre-vengadores.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('arbol de navidad')
                                    <img src="{{ asset('img/Arbol.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('taxi')
                                    <img src="{{ asset('img/taxi.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('museo')
                                    <img src="{{ asset('img/Museo.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('trineo')
                                    <img src="{{ asset('img/Trineo.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('cabina telefono')
                                    <img src="{{ asset('img/Cabina.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('groot')
                                    <img src="{{ asset('img/Groot.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('jardin')
                                    <img src="{{ asset('img/Jardin.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('torre')
                                    <img src="{{ asset('img/Torre.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @case('flores')
                                    <img src="{{ asset('img/Flores.png') }}" alt="{{ $details['nombre'] }}">
                                    @break
                                @default
                                    <img src="{{ asset('img/lego-logo.jpg') }}" alt="{{ $details['nombre'] }}">
                            @endswitch
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
                
                <div class="cart-summary">
                    <div class="total">
                        <h3>Total: <span id="cart-total">{{ number_format($total, 2) }}€</span></h3>
                    </div>
                    <a href="{{ route('pago.mostrar') }}" class="checkout-button">Proceder al Pago</a>
                </div>
            @else
                <div class="empty-cart">
                    <p>Tu carrito está vacío</p>
                    <a href="{{ route('piezaslego.index') }}" class="continue-shopping">Continuar Comprando</a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.increase-quantity').click(function(e) {
                e.preventDefault();
                var input = $(this).siblings('.quantity-input');
                input.val(parseInt(input.val()) + 1);
                updateQuantity($(this).closest('.cart-item'));
            });

            $('.decrease-quantity').click(function(e) {
                e.preventDefault();
                var input = $(this).siblings('.quantity-input');
                if(parseInt(input.val()) > 1) {
                    input.val(parseInt(input.val()) - 1);
                    updateQuantity($(this).closest('.cart-item'));
                }
            });

            $('.quantity-input').change(function() {
                updateQuantity($(this).closest('.cart-item'));
            });

            $('.remove-item').click(function(e) {
                e.preventDefault();
                var cartItem = $(this).closest('.cart-item');
                var id = cartItem.data('id');

                $.ajax({
                    url: '/carrito/remove',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            function updateQuantity(cartItem) {
                var id = cartItem.data('id');
                var cantidad = cartItem.find('.quantity-input').val();

                $.ajax({
                    url: '/carrito/update',
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        cantidad: cantidad
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });

        // Nuevas animaciones
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

            // Animación del título
            const cartTitle = document.querySelector('.cart-title');
            cartTitle.style.opacity = '0';
            cartTitle.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                cartTitle.style.transition = 'all 0.5s ease';
                cartTitle.style.opacity = '1';
                cartTitle.style.transform = 'translateY(0)';
            }, 300);

            // Animación de los items del carrito
            const cartItems = document.querySelectorAll('.cart-item');
            cartItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-30px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, 500 + (index * 200));
            });

            // Animación del resumen del carrito
            const cartSummary = document.querySelector('.cart-summary');
            if (cartSummary) {
                cartSummary.style.opacity = '0';
                cartSummary.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    cartSummary.style.transition = 'all 0.5s ease';
                    cartSummary.style.opacity = '1';
                    cartSummary.style.transform = 'translateY(0)';
                }, 800);
            }

            // Animación para carrito vacío
            const emptyCart = document.querySelector('.empty-cart');
            if (emptyCart) {
                emptyCart.style.opacity = '0';
                emptyCart.style.transform = 'scale(0.9)';
                
                setTimeout(() => {
                    emptyCart.style.transition = 'all 0.5s ease';
                    emptyCart.style.opacity = '1';
                    emptyCart.style.transform = 'scale(1)';
                }, 300);
            }

            // Efectos hover para los items del carrito
            cartItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    item.style.transform = 'translateY(-5px)';
                    item.style.boxShadow = '0 8px 15px rgba(0,0,0,0.1)';
                });

                item.addEventListener('mouseleave', () => {
                    item.style.transform = 'translateY(0)';
                    item.style.boxShadow = '0 4px 8px rgba(0,0,0,0.05)';
                });
            });

            // Animación para los botones de cantidad
            const quantityButtons = document.querySelectorAll('.increase-quantity, .decrease-quantity');
            quantityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 100);
                });
            });

            // Animación para el botón de eliminar
            const removeButtons = document.querySelectorAll('.remove-item');
            removeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const item = this.closest('.cart-item');
                    item.style.transition = 'all 0.5s ease';
                    item.style.transform = 'translateX(100%)';
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.style.transform = 'translateX(0)';
                        item.style.opacity = '1';
                    }, 500);
                });
            });
        });
    </script>
</body>
</html>