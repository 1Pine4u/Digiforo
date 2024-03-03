<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/style.css">
    <title>Foro</title>
</head>
<body>
    <header>
        <a href="crearusuario.php">Crear Usuario</a>
        <a href="login.php">Iniciar Sesión</a>
    </header>
    <h1>Bienvenido a mi foro</h1>
    <div>
    <img src="./estilos/cabecera.png" alt="">
    </div>
    <div id="cookie">
        Este sitio web utiliza cookies. Al continuar utilizando este sitio, aceptas su uso.
        <button onclick="aceptarCookies()">Aceptar</button>
    </div>
    <script>
        function aceptarCookies() {
            document.getElementById("cookie").style.display = "none";
        }

        window.onload = function() {
            document.getElementById("cookie").style.display = "block";
        };
    </script>
    <?php include './contador/contador.php'; ?>
</body>
</html>