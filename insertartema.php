<?php
session_start(); // Iniciar sesión o continuar sesión existente

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_nombre'])) {
    // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

// Obtener el nombre de usuario de la sesión
$autor = $_SESSION['usuario_nombre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar</title>
    <link rel="stylesheet" href="./estilos/style.css">
</head>
<body>
<header>
    <h1>Crear una nueva publicación</h1>
    <ul class="menu">
        <li>
            <a href="">Menú de navegación</a>
            <ul class="submenu">
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="respuesta.php">Ver respuestas</a></li>
                <li><a href="login.php">Cambiar de usuario</a></li>
                <li><a href="cierre.php">Salir</a></li>
            </ul>
        </li>
    </ul>
</header>
<form method="post" action="insertartema.php" enctype="multipart/form-data">
    <span style="color: black;">Autor :</span><input type="text" name="autor" value="<?php echo $autor; ?>" required readonly>
    <br>
    <span style="color: black;">Título :</span><input type="text" name="titulo" required>
    <br>
    <span style="color: black;">Contenido :</span><textarea name="contenido" rows="5" cols="32" required style="resize:none;"></textarea>
    <br>
    <br>
    <span style="color: black;">Seleccione archivo para subir :</span><input type="file" name="archivo">
    <br>
    <input type="submit" value="Publicar">
</form>
</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_POST) {
    $autor = $_POST['autor'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    if ($_FILES['archivo']['error'] !== UPLOAD_ERR_NO_FILE) {
        $temporal = $_FILES['archivo']['tmp_name'];
        $archivo = $_FILES['archivo']['name'];

        $rutacompleta = "C:/xampp/htdocs/PHP/practica final/archivos/".$archivo;

        if (move_uploaded_file($temporal, $rutacompleta)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
            exit;
        }
    }

    $conexion = mysqli_connect("localhost", "root", "", "foro");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO publicaciones (contenido, titulo, fecha, respuesta, autor) VALUES ('$contenido', '$titulo', NOW(), '0', '$autor')";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        header("Location: perfil.php");
        exit;
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>


