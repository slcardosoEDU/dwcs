<?php
require_once "accesodatos.php";
$order = $_REQUEST['order'] ?? null;
$order = empty($order) ? null : $order;
$filtros = [];
$filtros_url = '';

foreach ($_REQUEST as $param => $valor) {
    if (str_starts_with($param, 'filtro_') && !empty($valor)) {
        $filtros_url .= '&'.$param.'='.$valor;
        $param = substr($param, 7);
        $filtros[$param] = $valor;
    }
}

$juegos = getViedojuegos($filtros, $order);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
</head>

<body>
    <fieldset>
        <legend>Filtros de búsqueda</legend>
        <form action="" method="post">
            <label for="filtro_nombre">Nombre</label>
            <input type="text" name="filtro_nombre" value=<?= $_REQUEST['filtro_nombre']??'' ?>><br>

            <label for="filtro_plataforma">Plataforma</label>
            <input type="text" name="filtro_plataforma" value=<?= $_REQUEST['filtro_plataforma']??'' ?>><br>

            <label for="filtro_lanzamiento">Año de lanzamiento</label>
            <input type="number" name="filtro_anio_lanzamiento" value=<?= $_REQUEST['filtro_anio_lanzamiento']??'' ?>><br>

            <label for="filtro_genero">Género</label>
            <input type="text" name="filtro_genero" value=<?= $_REQUEST['filtro_genero']??'' ?>><br>

            <button type="submit">Buscar</button>
        </form>
    </fieldset>
    <h1>Videojuegos registrados</h1>
    <table>
        <tr>
            <th><a href="/ejercicios/actividad3/videojuegos/index.php?order=nombre<?= $filtros_url ?>">Nombre</a></th>
            <th> <a href="?order=plataforma<?= $filtros_url ?>">Plataforma</a></th>
            <th> <a href="?order=anio_lanzamiento<?= $filtros_url ?>">Año</a></th>
            <th> <a href="?order=genero<?= $filtros_url ?>">Género</a></th>


            <th colspan="2">Acciones</th>
        </tr>
        <!-- Datos de ejemplo. Tiene que ser dinámico -->
        <?php
        foreach ($juegos as $juego) {
            echo "<tr>";
            echo "    <td>" . htmlspecialchars($juego['nombre']) . "</td>";
            echo "    <td>" . $juego['plataforma'] . "</td>";
            echo "    <td>" . $juego['anio_lanzamiento'] . "</td>";
            echo "    <td>" . $juego['genero'] ?? "" . "</td>";
            echo "    <td><a href=\"altamodificacion.php?id=" . $juego['id'] . "\">Editar</a></td>";
            echo "    <td><a href=\"eliminar.php?id=" . $juego['id'] . "\">Eliminar</a></td>";
            echo "</tr>";
        }
        ?>

    </table>
    <a href="altamodificacion.php">Nuevo juego</a>
</body>

</html>