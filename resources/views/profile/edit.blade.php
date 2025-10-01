<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>

    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="" class="logo">
            <img src="{{ asset('img/lego-logo.jpg') }}" alt="LEGO Logo" width="60px">
        </a>
        <ul class="navbar">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('piezaslego.index') }}">PiezasLego</a></li>
            <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
            <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
        </ul>

        <div class="main">
            @if (Auth::check())
                <a href="{{ route('profile.edit') }}" class="user">
                    <i class="ri-user-fill"></i>Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}" class="user" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class='bx bx-user-minus'></i>Cerrar Sesión
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}" class="user">
                    <i class="ri-user-fill"></i>Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="user">
                    <i class='bx bx-user-plus'></i>Registrarse
                </a>
            @endif
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="auth-container">
        <div class="login-box">
            <div class="profile-section">
                <h2 class="login-title">{{ __('Editar Perfil') }}</h2>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <div class="input-wrapper">
                            <i class="ri-user-line"></i>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-input" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                        </div>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="input-wrapper">
                            <i class="ri-mail-line"></i>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-input" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="login-button">
                        {{ __('Actualizar Perfil') }}
                    </button>
                </form>
            </div>

            <div class="password-section">
                <h3 class="section-title">{{ __('Cambiar Contraseña') }}</h3>

                <div class="form-group">
                    <label class="form-label">Contraseña Actual</label>
                    <div class="input-wrapper">
                        <i class="ri-lock-line"></i>
                        <input type="password" 
                               id="current_password" 
                               name="current_password" 
                               class="form-input" 
                               required>
                    </div>
                    @error('current_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nueva Contraseña</label>
                    <div class="input-wrapper">
                        <i class="ri-lock-password-line"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input" 
                               required>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmar Nueva Contraseña</label>
                    <div class="input-wrapper">
                        <i class="ri-checkbox-circle-line"></i>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input" 
                               required>
                    </div>
                </div>

                <button type="submit" class="login-button">
                    {{ __('Cambiar Contraseña') }}
                </button>
            </div>

            <div class="delete-account-section">
                <h3 class="section-title delete-title">{{ __('Eliminar Cuenta') }}</h3>

                <p class="delete-warning">
                    {{ __('Una vez que tu cuenta sea eliminada, todos tus datos serán permanentemente borrados.') }}
                </p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="ri-shield-keyhole-line"></i>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-input" 
                                   placeholder="Confirmar contraseña" 
                                   required>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="delete-button">
                        {{ __('Eliminar Cuenta') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

