<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles</title>
    <link rel="stylesheet" href="./estilos/style.css">
</head>
<body>
<header>
    <h1>PERFIL</h1>
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
    <h1>FORO DE CONSULTAS</h1>
    <?php
error_reporting(4);

$conexion = mysqli_connect("localhost", "root", "", "foro");

if (!$conexion) {
    echo("Error al establecer conexión");
} else {
    
    $actualizar_respuestas = "UPDATE publicaciones SET respuesta = (SELECT COUNT(*) FROM respuesta WHERE respuesta.publicaciones = publicaciones.Id_publicaciones)";

    $resultado_actualizacion = mysqli_query($conexion, $actualizar_respuestas);

    if ($resultado_actualizacion) {
        echo("Actualización de respuestas exitosa.");
    } else {
        echo("Error al actualizar las respuestas: " . mysqli_error($conexion));
    }

    $select_publicaciones = "SELECT * FROM publicaciones";
    $resultado_publicaciones = mysqli_query($conexion, $select_publicaciones);

    echo("<br><br><table align='center' border='1'>");
    echo("<tr>");
    echo("<th style='width: 5%;'>Ver</th>");
    echo("<th style='width: 5%;'>Id</th>");
    echo("<th style='width: 30%;'>Contenido</th>");
    echo("<th style='width: 10%;'>Título</th>");
    echo("<th style='width: 30%;'>Fecha</th>");
    echo("<th style='width: 5%;'>Respuestas</th>");
    echo("<th style='width: 10%;'>Autor</th>");
    echo("</tr>");

    while ($filas = mysqli_fetch_row($resultado_publicaciones)) {
        echo("<tr>");
        echo("<td style='width: 5%;'><a class='sinestilo' href='respuesta.php?id=".$filas[0]."'>Más</a></td>");
        echo("<td style='width: 5%;'>".$filas[0]."</td>");
        echo("<td style='width: 35%;'>".$filas[1]."</td>");
        echo("<td style='width: 10%;'>".$filas[2]."</td>");
        echo("<td style='width: 30%;'>".$filas[3]."</td>");
        echo("<td style='width: 5%;'>".$filas[4]."</td>");
        echo("<td style='width: 10%;'>".$filas[5]."</td>");
        echo("</tr>");
    }

    echo("</table>");

    mysqli_close($conexion);
}
?>

</body>
</html>