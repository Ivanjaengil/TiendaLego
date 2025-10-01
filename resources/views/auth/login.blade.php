<x-guest-layout>
    <div class="auth-container">
        <div class="login-box">
            <h1 class="login-title">Iniciar Sesión</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
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
                            autofocus 
                        />
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
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

                <!-- Remember Me -->
                <div class="remember-me">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">Recordarme</label>
                </div>

                <!-- Botón -->
                <button type="submit" class="login-button">Iniciar Sesión</button>

                <!-- Links -->
                <div class="auth-links">
                    <a href="{{ route('password.request') }}" class="forgot-password">
                        ¿Olvidaste tu contraseña?
                    </a>
                    <a href="{{ route('register') }}" class="register-link">
                        ¿No tienes cuenta? Regístrate
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
