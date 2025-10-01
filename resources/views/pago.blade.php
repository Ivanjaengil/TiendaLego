<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Proceso de Pago - LEGO</title>
    <link rel="stylesheet" href="{{ asset('css/piezaslego.css') }}">
    <style>
        .payment-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 20px;
            background-color: #1a1a1a;
            border-radius: 5px;
            border: 1px solid #FFD700;
        }

        h1, h2, h3 {
            color: #FFD700;
            margin-bottom: 15px;
        }

        .order-summary {
            background-color: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #FFD700;
        }

        .total-amount {
            color: #FFD700;
            font-size: 18px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            background-color: #2a2a2a;
            border: 1px solid #FFD700;
            border-radius: 5px;
            color: white;
        }

        input:focus {
            outline: none;
            border-color: #FF0000;
        }

        .payment-option {
            background-color: #2a2a2a;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #FFD700;
        }

        .payment-option:hover {
            border-color: #FF0000;
        }

        .payment-option label {
            color: #FFD700;
            margin-left: 5px;
        }

        .pay-button {
            width: 100%;
            padding: 10px;
            background-color: #FF0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            font-weight: bold;
        }

        .pay-button:hover {
            background-color: #cc0000;
        }

        /* Estilo para los radio buttons */
        input[type="radio"] {
            width: auto;
            margin-bottom: 0;
        }

        /* Estilo para cuando el radio button está seleccionado */
        input[type="radio"]:checked + label {
            color: #FF0000;
        }

        ::placeholder {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Finalizar Compra</h1>
        
        <div class="order-summary">
            <p class="total-amount">Total a pagar: {{ number_format($total, 2) }}€</p>
        </div>

        <form action="{{ route('pago.procesar') }}" method="POST" id="payment-form">
            @csrf
            
            <div class="form-group">
                <div class="form-row">
                    <input type="text" name="nombre" placeholder="Nombre completo" required>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
            </div>

            <div class="form-group">
                <h3>Método de pago</h3>
                <div class="payment-option">
                    <input type="radio" name="metodo_pago" id="tarjeta" value="tarjeta" required>
                    <label for="tarjeta">Tarjeta</label>
                </div>

                <div class="payment-option">
                    <input type="radio" name="metodo_pago" id="paypal" value="paypal">
                    <label for="paypal">PayPal</label>
                </div>

                <div class="payment-option">
                    <input type="radio" name="metodo_pago" id="transferencia" value="transferencia">
                    <label for="transferencia">Transferencia</label>
                </div>
            </div>

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

            <button type="submit" class="pay-button">Pagar ahora</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('payment-form');
            form.addEventListener('submit', function() {
                const button = this.querySelector('.pay-button');
                button.disabled = true;
                button.textContent = 'Procesando...';
            });
        });
    </script>
</body>
</html>