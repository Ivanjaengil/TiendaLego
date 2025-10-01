<x-guest-layout>
    <div class="auth-container">
        <div class="login-box">
            <h1 class="login-title">Crear Cuenta</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input 
                            id="name" 
                            class="form-input" 
                            type="text" 
                            name="name" 
                            placeholder="Nombre completo"
                            :value="old('name')" 
                            required 
                            autofocus 
                        />
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

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
                            :value="old('email')" 
                            required 
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

                <!-- Confirm Password -->
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
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="login-button">
                    Registrarse
                </button>

                <a href="{{ route('login') }}" class="forgot-password">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </form>
        </div>
    </div>
</x-guest-layout>