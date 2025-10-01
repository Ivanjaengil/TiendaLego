<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pagar con PayPal</title>

  <link rel="stylesheet" href="{{ asset('css/from.css') }}?v=2">
</head>
<body>
  <div class="paypal-container">
    <h1>Pagar con PayPal</h1>
    <p class="paypal-total">Total a pagar: €{{ number_format($total ?? 0, 2) }}</p>

    <form method="POST" action="{{ route('paypal.create') }}" id="paypal-redirect-form">
      @csrf

      <div class="actions">
        <a href="{{ route('pago.mostrar') }}" class="back-btn" id="go-back">Volver método de pago</a>


        <button type="submit" class="paypal-submit-btn" id="paypal-submit-btn">
          Continuar a PayPal
        </button>
      </div>
    </form>

    <div id="paypal-hint" class="paypal-hint" hidden>Redirigiendo a PayPal…</div>
  </div>

  <script src="{{ asset('js/from.js') }}?v=2"></script>
</body>
</html>
