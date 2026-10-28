<?php
require_once "accesodatos.php";

$todos = getAllVideojuegos();
$uno = getVideojuego(2);
$res = addVideojuego("test","test",2026);
$res = addVideojuego("test2","test2",2026,"test2");
$res = updateVideojuego(2, "updated", "updated", 2000,"updated");
$res = updateVideojuego(2, "updated", "updated", 2000);
$res = deleteVideojuego(2);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
</head>
<body>
    <h1>Videojuegos registrados</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Plataforma</th>
            <th>Año</th>
            <th>Nombre</th>
            <th>Género</th>
        </tr>
        <!-- Datos de ejemplo. Tiene que ser dinámico -->
        <tr>
            <td>God of War</td>
            <td>PlayStation 4</td>
            <td>2018</td>
            <td>Acción</td>
            <td><a href="altamodificacion.php?id=2">Editar</a></td>
            <td><a href="eliminar.php?id=2">Eliminar</a></td>
        </tr>
        <tr>
            <td>Minecraft</td>
            <td>PC</td>
            <td>2011</td>
            <td>Sandbox</td>
            <td><a href="altamodificacion.php?id=3">Editar</a></td>
            <td><a href="eliminar.php?id=3">Eliminar</a></td>
        </tr>
        <tr>
            <td>Fortnite</td>
            <td>PC</td>
            <td>2017</td>
            <td>Battle Royale</td>
            <td><a href="altamodificacion.php?id=3">Editar</a></td>
            <td><a href="eliminar.php?id=3">Eliminar</a></td>
        </tr>
    </table>

</body>
</html>