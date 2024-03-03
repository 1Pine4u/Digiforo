<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/style.css">
    <title>Respuestas</title>
</head>
<body>
<header>
    <h1>RESPUESTAS</h1>
    <ul class="menu">
        <li>
            <a href="">Menú de navegación</a>
            <ul class="submenu">
                <li><a href="insertartema.php">Crear nueva publicación</a></li>
                <li><a href="login.php">Cambiar de usuario</a></li>
                <li><a href="cierre.php">Salir</a></li>
            </ul>
        </li>
    </ul>
</header>

<?php
error_reporting(4);

$conexion = mysqli_connect("localhost", "root", "", "foro");

if (!$conexion) {
    echo("Error al establecer conexión");
} else {
    // Obtener el ID de la publicación desde $_GET
    if ($_GET && isset($_GET['id'])) {
        $id_publicacion = $_GET['id'];

        $consulta_respuestas = "SELECT respuesta.id_respuesta, respuesta.publicaciones, respuesta.autor, respuesta.mensaje FROM publicaciones JOIN respuesta ON publicaciones.Id_publicaciones = respuesta.publicaciones WHERE publicaciones.Id_publicaciones = $id_publicacion";

        $resultado_respuestas = mysqli_query($conexion, $consulta_respuestas);

        if (mysqli_num_rows($resultado_respuestas) > 0) {
            echo("<br><br><table align='center' border='1' style='width: 90%;'>");
            echo("<tr>");
            echo("<th style='width: 10%;'>ID</th>");
            echo("<th style='width: 40%;'>AUTOR</th>");
            echo("<th style='width: 50%;'>MENSAJE</th>");
            echo("</tr>");

            while ($fila = mysqli_fetch_row($resultado_respuestas)) {
                echo("<tr>");
                echo("<td style='width: 10%;'>" . $fila[1] . "</td>");
                echo("<td style='width: 40%;'>" . $fila[2] . "</td>");
                echo("<td style='width: 50%;'>" . $fila[3] . "</td>");
                echo("</tr>");
            }

            echo("</table>");
        } else {
            echo("No hay respuestas para esta publicación.");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $autor = $_POST['autor'];
        $mensaje = $_POST['mensaje'];
        $id_publicacion = $_POST['id_publicacion'];

        $insert = "INSERT INTO respuesta (publicaciones, autor, mensaje) VALUES ('$id_publicacion', '$autor', '$mensaje')";

        $resultado = mysqli_query($conexion, $insert);

        if ($resultado) {
            header("Location: perfil.php");
            exit;
        } else {
            echo("Error al insertar la respuesta: " . mysqli_error($conexion));
        }
    }
}

mysqli_close($conexion);
?>

<div>
    <form method="post" action="respuesta.php">
        <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion; ?>">
        <span style="color: black;">Autor :</span><input type="text" name="autor" required>
        <br>
        <span style="color: black;">Mensaje :</span><textarea name="mensaje" rows="5" cols="32" required style="resize:none;">
        </textarea>
        <br>
        <input type="submit" value="Responder">
    </form>
</div>

</body>
</html>
