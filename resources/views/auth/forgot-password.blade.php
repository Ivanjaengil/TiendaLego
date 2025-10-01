<x-guest-layout>
    <div class="auth-container">
        <div class="login-box">
            <h1 class="login-title">¿Olvidaste tu contraseña?</h1>
            
            <p class="description">
                {{ __('No te preocupes. Simplemente ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.') }}
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input 
                            id="email" 
                            class="form-input" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            placeholder="nombre@ejemplo.com"
                        />
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="login-button">
                    {{ __('Enviar enlace de recuperación') }}
                </button>

                <a href="{{ route('login') }}" class="forgot-password">
                    ← Volver al inicio de sesión
                </a>
            </form>
        </div>
    </div>
</x-guest-layout>