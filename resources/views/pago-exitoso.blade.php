<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <link rel="stylesheet" href="{{ asset('css/piezaslego.css') }}">
    <style>
        .success-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 30px;
            background-color: rgba(26, 26, 26, 0.95);
            border-radius: 15px;
            border: 2px solid #FFD700;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        .success-icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 25px;
            animation: scaleIn 0.5s ease-out;
        }

        h1 {
            color: #FFD700;
            font-size: 2rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        p {
            color: #ffffff;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .back-button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #FF0000;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 25px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .back-button:hover {
            background-color: #4CAF50;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        /* Efecto de confeti */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #FFD700;
            animation: confetti-fall 3s linear infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .success-container {
                margin: 2rem 1rem;
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .success-icon {
                font-size: 50px;
            }
        }

        .success-image {
            width: 150px;
            height: auto;
            object-fit: contain;
            margin: 20px auto;
            display: block;
        }

        .success-icon {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <img src="{{ asset('img/Lego-pago.png') }}" alt="Pago Exitoso" class="success-image">
        </div>
        <h1>¡Pago Exitoso!</h1>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <p>Tu pedido ha sido procesado y registrado correctamente.</p>
        <p>Recibirás un correo electrónico con los detalles de tu compra.</p>
        <a href="{{ route('home') }}" class="back-button">Volver a la tienda</a>
    </div>

    <script>
        // Añadir efecto de confeti
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animationDelay = Math.random() * 3 + 's';
                document.body.appendChild(confetti);
            }
        });
    </script>
</body>
</html>