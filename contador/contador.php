<?php
// Ruta al archivo que almacenará el contador de visitas
$archivo_contador = "./contador/contador.txt";

// Leer el contador actual de visitas
$contador = (file_exists($archivo_contador)) ? (int)file_get_contents($archivo_contador) : 0;

// Incrementar el contador de visitas
$contador++;

// Guardar el contador actualizado
file_put_contents($archivo_contador, $contador);

// Mostrar el contador de visitas
echo "<br> Eres el usuario número : " . $contador;

