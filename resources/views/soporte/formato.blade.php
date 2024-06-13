<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            max-width: 600px;
            padding: 2rem;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #8379BE;
            padding-bottom: 1rem;
        }

        .header h1 {
            color: #8379BE;
            margin: 0;
            font-size: 24px;
        }

        .content {
            margin: 2rem 0;
        }

        .content p {
            margin: 0.5rem 0;
            font-size: 16px;
        }

        .content p i {
            color: #555;
        }

        .content h3 {
            color: #8379BE;
            font-size: 20px;
            margin-top: 2rem;
        }

        .content blockquote {
            background-color: #f0f8ff;
            border-left: 4px solid #8379BE;
            margin: 1rem 0;
            padding: 1rem;
            font-style: italic;
            color: #555;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Formulario de Contacto</h1>
        </div>
        <div class="content">
            <p><b>Nombre: </b><i>{{ $nombre }}</i></p>
            <p><b>Email: </b><i>{{ $email }}</i></p>
            <p><b>Tipo de Usuario: </b><i>{{ $tipoUsuario }}</i></p>
            <p><b>Asunto: </b><i>{{ $asunto }}</i></p>
            <h3>Contenido</h3>
            <blockquote>
                {{ $contenido }}
            </blockquote>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} <a href="{{ route('home') }}">octoCHAT</a>. Todos los derechos reservados.
        </div>
    </div>
</body>

</html>
