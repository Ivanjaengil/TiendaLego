<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Proceso de Pago</title>

  <link rel="stylesheet" href="{{ asset('css/pago.css') }}?v=4">
</head>
<body>
  <div class="payment-container">
    <h1>Finalizar Compra</h1>

    <div class="order-summary">
      <p class="total-amount">Total a pagar: {{ number_format($total, 2) }}€</p>
    </div>

    <form action="{{ route('pago.procesar') }}" method="POST" id="payment-form">
      @csrf

      <!-- Datos del comprador -->
      <div class="form-group">
        <div class="form-row">
          <input type="text" name="nombre" placeholder="Nombre completo" required>
          <input type="email" name="email" placeholder="Email" required>
        </div>
      </div>

      <!-- Métodos de pago -->
      <div class="form-group">
        <h3 class="group-title">Método de pago</h3>

        <div class="payment-option">
          <input type="radio" name="metodo_pago" id="paypal" value="paypal">
          <label for="paypal">PayPal</label>
        </div>

        <div class="payment-option">
          <input type="radio" name="metodo_pago" id="tarjeta" value="tarjeta">
          <label for="tarjeta">Tarjeta</label>
        </div>

        <!-- Formulario de tarjeta -->
        <div id="tarjeta-form" class="card-form">
          <input class="card-input card-number" type="text" name="numero_tarjeta" placeholder="Número de tarjeta" inputmode="numeric" autocomplete="cc-number" maxlength="19">
          <div class="card-row">
            <input class="card-input" type="text" name="titular" placeholder="Titular de la tarjeta" autocomplete="cc-name">
          </div>
          <div class="card-row">
            <input class="card-input" type="text" name="caducidad" placeholder="MM/AA" inputmode="numeric" autocomplete="cc-exp" maxlength="5">
            <input class="card-input" type="password" name="cvv" placeholder="CVV" inputmode="numeric" autocomplete="cc-csc" maxlength="4">
          </div>
        </div>

        <div class="payment-option">
          <input type="radio" name="metodo_pago" id="transferencia" value="transferencia">
          <label for="transferencia">Transferencia</label>
        </div>

        <!-- Botones Apple/Google (solo display con transferencia) -->
        <div id="transferencia-images" class="transfer-container">
          <button type="button" class="payment-button">
            <img src="{{ asset('img/logo-Apple.png') }}" alt="Pagar con Apple">
          </button>
          <button type="button" class="payment-button">
            <img src="{{ asset('img/logo-google.png') }}" alt="Pagar con Google">
          </button>
        </div>

        <!-- Mensaje de error (sin método seleccionado) -->
        <div id="payment-error" class="payment-error" role="alert" aria-live="polite" hidden></div>
      </div>

      <!-- Dirección -->
      <div class="form-group">
        <div class="form-row">
          <input type="text" name="direccion" placeholder="Dirección" required>
        </div>
        <div class="form-row">
          <input type="text" name="ciudad" placeholder="Ciudad" required>
          <input type="text" name="codigo_postal" placeholder="C.P." required>
        </div>
        <input type="text" name="pais" placeholder="País" required>
      </div>

      <!-- Acciones -->
      <div class="actions">
        <a href="{{ route('carrito.index') }}" class="cancel-button" id="cancel-order">
          Cancelar Compra
        </a>

        <button
          type="button"
          class="pay-button"
          id="pay-now"
          data-paypal="{{ route('paypal.form') }}"
        >
          Pagar ahora
        </button>
      </div>
      <div id="payment-error" class="payment-error" role="alert" aria-live="polite" hidden></div>

    </form>
  </div>

  <script src="{{ asset('js/pago.js') }}?v=4"></script>
</body>
</html>
