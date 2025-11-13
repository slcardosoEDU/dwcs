<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño monolítico</title>
</head>



<?php
// Conectamos con la base de datos
$error = false;
try {
    $db = new PDO('mysql:host=mariadb; dbname=articulos', 'root', 'bitnami');
    $res = $db->query('SELECT fecha, titulo FROM articulo');
} catch (PDOException $th) {
    $error = true;
}

//Lanzamos una consulta para recuperar los artículos que haya en la BD

?>
<!-- Si se ha producido un error lo mostramos. -->
 <?php if($error): ?>
    <h1>Se ha producido un error</h1>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet harum in maxime animi earum cum? Deserunt cum quos officiis beatae nesciunt harum. Voluptates nobis sequi ea, totam itaque aliquid perferendis.
<?php else: ?>
<!-- Generamos una tabla HTML con el resultado de la consulta -->
<h1>Listado de Artículos</h1>
<table>
    <tr>
        <th>Fecha</th>
        <th>Titulo</th>
    </tr>
    <?php
    // Recorremos fila a fila el resultado de la consulta
    while ($row = $res->fetch()) {
        echo "<tr>";
        echo "<td> " . $row['fecha'] . " </td>";
        echo "<td> " . $row['titulo'] . " </td>";
        echo "</tr>";
    }
    echo "</table>";
    // Cerramos la conexión con la BD
    $res->closeCursor();
    $db = null;
    ?>
</table>
<?php endif; ?>
</body>

</html>