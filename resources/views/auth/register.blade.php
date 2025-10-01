{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="auth-container">
        <div class="auth-box">
            <h1 class="auth-title">Registrarse</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nombre --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input
                            id="name"
                            class="form-input"
                            type="text"
                            name="name"
                            placeholder="Nombre completo"
                            value="{{ old('name') }}"
                            required
                            autofocus
                        />
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input
                            id="email"
                            class="form-input"
                            type="email"
                            name="email"
                            placeholder="Correo electrónico"
                            value="{{ old('email') }}"
                            required
                        />
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input
                            id="password"
                            class="form-input"
                            type="password"
                            name="password"
                            placeholder="Contraseña"
                            required
                        />
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input
                            id="password_confirmation"
                            class="form-input"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirmar contraseña"
                            required
                        />
                    </div>
                </div>

                {{-- Botón --}}
                <button type="submit" class="auth-button">
                    Registrarse
                </button>

                {{-- Links --}}
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="login-link">
                        ¿Ya tienes cuenta? Inicia sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
