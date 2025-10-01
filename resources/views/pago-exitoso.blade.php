<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso - LEGO</title>
    <link rel="stylesheet" href="{{ asset('css/piezaslego.css') }}">
    <style>
        .success-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 20px;
            background-color: #1a1a1a;
            border-radius: 5px;
            border: 1px solid #FFD700;
            text-align: center;
            color: #FFD700;
        }

        .success-icon {
            font-size: 48px;
            color: #00FF00;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FF0000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">✓</div>
        <h1>¡Pago Exitoso!</h1>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <p>Tu pedido ha sido procesado y registrado correctamente.</p>
        <p>Recibirás un correo electrónico con los detalles de tu compra.</p>
        <a href="{{ route('home.index') }}" class="back-button">Volver a la tienda</a>
    </div>
</body>
</html>