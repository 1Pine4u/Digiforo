<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/style.css">
    <title>Registrarse</title>
</head>
<body>
<header>
    <a href="cierre.php">Volver al inicio</a>
</header>
<h1>CREAR USARIO</h1>
<form method="post" action="crearusuario.php">
    <span style="color: black;">Introduce usuario :</span><input type="text" name="usuario" required>
    <br>
    <span style="color: black;">Introduce tu contraseña :</span><input type="password" name="password" required>
    <br>
    <span style="color: black;">Introduce tu correo :</span><input type="text" name="correo" required>
    <br>
    <input type="submit" value="Crear un usuario">
</form>
</body>
</html>

<?php
error_reporting(4);
if($_POST)
{
    $nombre=$_POST['usuario'];
    $password=$_POST['password'];
    $correo=$_POST['correo'];

    function validarNombreUsuario($nombre) {
        if (!preg_match('/[!@#$%^&*()\-_=+<>?]/', $nombre)) {
            return false;
        }

        if (strlen($nombre) < 10 || strlen($nombre) > 30) {
            return false;
        }

        if (ctype_digit(substr($nombre, 0, 1))) {
            return false;
        }

        return true;
    }

    function validarContrasena($password) {

        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
        if (strlen($password) < 5 || strlen($password) > 20) {
            return false;
        }

        return true;
    }


    if (!validarNombreUsuario($nombre)) {
        echo "El nombre de usuario debe cumplir los siguientes requisitos : <br>";
        echo "1.- Contener mínimo un caracter especial <br>";
        echo "2.- Máximo 30 caracteres y mínimo 10 <br>";
        echo "3.- No puede comenzar por un número <br>";
        exit();
    }

    if (!validarContrasena($password)) {
        echo "La contraseña de usuario debe cumplir los siguientes requisitos : <br>";
        echo "1.- Contener al menos un número <br>";
        echo "2.- Una letra mayúscula <br>";
        echo "3.- Longitud entre 5 y 20 caracteres <br>";
        exit();
    }

    $conexion=mysqli_connect("localhost","root","","foro");

    $consulta_existe_usuario = "SELECT * FROM usuario WHERE nombre='$nombre'";
    $resultado_existe_usuario = mysqli_query($conexion, $consulta_existe_usuario);

    if (mysqli_num_rows($resultado_existe_usuario) > 0) {
        echo "El nombre de usuario ya está en uso.";
        exit();
    }

    $consulta="INSERT INTO usuario (nombre, contra, correo, fecha) VALUES ('$nombre', '$password', '$correo', NOW())";
    $resultado=mysqli_query($conexion,$consulta);

    if($conexion)
    {
        header("Location:login.php");
        exit();
    }
    else
    {
        echo("Error!!, no se ha podido establecer la conexión!!!");
    }
}
?>

