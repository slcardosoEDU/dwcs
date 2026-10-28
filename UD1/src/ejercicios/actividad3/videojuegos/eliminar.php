<?php
    require_once "accesodatos.php";
    $mensaje = "Error inesperado ";
    $id = $_GET['id'];
    if(!isset($id) || !is_numeric($id)){
        $mensaje = "Error. No se puede identificar el videojuego.";
    }else{
        $videojuego = getVideojuego($id);
        if(!$videojuego){
        $mensaje = "Error. No se puede recuperar el videojuego indicado.";
        }else{
            if(deleteVideojuego($id)){
                $mensaje = "Se ha eliminado el videojuego ".$videojuego['nombre'];
            }else{
                $mensaje = "Error eliminando el videojuego ".$videojuego['nombre'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videjuego eliminado</title>
</head>

<body>
    <h1>
        <?= $mensaje ?>
    </h1>
    <a href="index.php">Ver todos</a>
</body>

</html>