<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios</title>
</head>

<body>

    <form action="/ejemplos/formulario.php" method="POST">
        <input type="text" name="usuario"><br>
        <input type="password" name="contrasena"><br>
        <button type="submit">Enviar</button>
    </form>
    <?php
        if(isset($_POST['usuario'])){
            echo "Entro por POST y el usuario es ", $_POST['usuario'];
        }

        if(isset($_POST['contrasena']) && !empty($_POST['contrasena']) ){
            echo "Entro por POST y la contrasena es ", $_POST['contrasena'];
        }
    ?>

</body>

</html>