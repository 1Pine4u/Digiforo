<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/style.css">
    <title>Inicio de Sesión</title>
</head>
<body>
<header>
    <a href="cierre.php">Volver al inicio</a>
</header>
<h1>INICIAR SESIÓN</h1>
<form method="post" action="login.php">
    <span style="color: black;">Introduce usuario :</span> <input type="text" name="usuario" required>
    <br>
    <span style="color: black;">Introduce tu contraseña :</span> <input type="password" name="password" required>
    <br>
    <input type="submit" value="Iniciar Sesión">
</form>

</body>

<?php
error_reporting(4);
session_start();

if ($_POST) {
    $nombre = $_POST['usuario'];
    $password = $_POST['password'];

    $conexion = mysqli_connect("localhost", "root", "", "foro");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "SELECT * FROM usuario WHERE nombre = '$nombre' AND contra = '$password'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        $_SESSION['usuario_nombre'] = $fila['nombre']; // Establecer el nombre de usuario en la sesión
        header("Location: perfil.php");
        exit();
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    mysqli_close($conexion);
}
?>



