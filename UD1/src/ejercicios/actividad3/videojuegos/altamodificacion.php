<?php
require_once "accesodatos.php";
$id = $_GET['id'] ?? null;
$resultado = null;

//Parametros del juego
$nombre = "";
$plataforma = "";
$lanzamiento = "";
$genero = "";
if (isset($id)) {
    $juego = getVideojuego(intval($id));
    $nombre = $juego['nombre'];
    $plataforma = $juego['plataforma'];
    $lanzamiento = $juego['anio_lanzamiento'];
    $genero = $juego['genero'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $plataforma = $_POST['plataforma'];
    $lanzamiento = $_POST['lanzamiento'];
    $genero = $_POST['genero'];
    $genero = empty($genero) ? null : $genero;
    //Modificacion
    if (isset($id)) {

        if (updateVideojuego(intval($id), $nombre, $plataforma, $lanzamiento, $genero)) {
            $resultado = "Se ha modificado el juego con éxito.";
        } else {
            $resultado = "No se ha podido modificar el juego.";
        }
    } else { //Alta
        if (addVideojuego($nombre, $plataforma, $lanzamiento, $genero)) {
            $resultado = "Se ha agregado el juego con éxito.";
        } else {
            $resultado = "No se ha podido agregar el juego.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tiene que ser dinámico -->
    <title>Alta o modificación</title>
</head>

<body>
    <!-- Tiene que ser dinámico -->
    <h1>Alta o modificación</h1>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $nombre ?>" required><br>

        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" value="<?= $plataforma ?>" required><br>

        <label for="lanzamiento">Año de lanzamiento</label>
        <input type="number" name="lanzamiento" value="<?= $lanzamiento ?>" required><br>

        <label for="genero">Género</label>
        <input type="text" name="genero" value="<?= $genero ?>"><br>

        <button type="submit">Guardar</button>
    </form>
    <!-- Mostrar resultados -->
    <?php
    if (isset($resultado)) {

        echo "<div class=\"resultados\">$resultado</div>";
    }
    ?>
    <a href="index.php">Ver todos</a>

</body>

</html>