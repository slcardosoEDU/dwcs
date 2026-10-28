<?php
    require_once "accesodatos.php";
    $juegos = getAllVideojuegos();
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
            <th>Género</th>
            <th colspan="2">Acciones</th>
        </tr>
        <!-- Datos de ejemplo. Tiene que ser dinámico -->
         <?php
         foreach($juegos as $juego){
             echo "<tr>";
             echo "    <td>".$juego['nombre']."</td>";
             echo "    <td>".$juego['plataforma']."</td>";
             echo "    <td>".$juego['anio_lanzamiento']."</td>";
             echo "    <td>".$juego['genero']??""."</td>";
             echo "    <td><a href=\"altamodificacion.php?id=".$juego['id']."\">Editar</a></td>";
             echo "    <td><a href=\"eliminar.php?id=".$juego['id']."\">Eliminar</a></td>";
             echo "</tr>";
             
         }
         ?>
        
    </table>
         <a href="altamodificacion.php">Nuevo juego</a>
</body>
</html>