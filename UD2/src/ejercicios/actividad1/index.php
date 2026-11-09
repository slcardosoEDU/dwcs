<?php
if (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
}
if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
    //Establezco el $nombre para que me enseñe el saludo.
    $nombre = $_POST['nombre'];
    //Creo la cookie
    setcookie("nombre", $nombre, time() + 300);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo</title>
</head>

<body>
    <?php
    if (isset($nombre)):
        echo "<h1>Hola $nombre</h1>";
    else:
    ?>
        <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre"><br>
            <button type="submit">Enviar</button>
        </form>
    <?php
    endif
    ?>
</body>

</html>