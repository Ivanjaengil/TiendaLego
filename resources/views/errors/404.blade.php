<!DOCTYPE html>
<html>
<head>
    <title>Página no encontrada</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #222327;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
        }
        .error-image {
            width: 610px;
            margin-bottom: 2rem;
        }
        .error-code {
            font-size: 6rem;
            color: #ff0000;
            margin: 0;
        }
        .error-message {
            font-size: 1.5rem;
            color: #fff200;
            margin: 1rem 0;
        }
        .home-button {
            margin-top: 2rem;
            padding: 0.8rem 1.5rem;
            background-color: #ff0000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .home-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            background-color: #00ff00;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="{{ asset('img/lego-error.png') }}" alt="Error 404" class="error-image">
        <h1 class="error-code">404</h1>
        <p class="error-message">¡Ups! Esta pagina no existe</p>
        <a href="{{ route('home') }}" class="home-button">Volver al inicio</a>
    </div>
</body>
</html>