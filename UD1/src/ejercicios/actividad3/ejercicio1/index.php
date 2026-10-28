<?php
require_once "bd.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Valido
    $nic = $_POST['nic'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $error = [];
    if (empty($nic)) {
        $error[] = "El nic es un campo obligatorio.";
    }

    if (empty($pass)) {
        $error[] = "El nic es un campo obligatorio.";
    }

    //Recupero nic de la BD
    if (count($error) === 0) {
        $usuario = getUserByNic($nic);
        if (!$usuario || $usuario['contrasena'] != sha1($pass)) {
            $error[] = "Usuario o contraseña no coinciden";
        } else {

            header("Location: principal.html");
            die();
        }
    }
    //Compruebo contrasena y si es correcto
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Acceso a la web</h1>
    <form action="" method="post">
        <label for="nic">Nombre usuario</label>
        <input type="text" name="nic"><br>
        <label for="pass">Contraseña</label>
        <input type="password" name="pass"><br>
        <button type="submit">Acceder</button>
    </form>
    <?php
    if (isset($error) && count($error) > 0) {
        echo "<div>";
        echo "<h2>No se ha podido acceder</h2><ul>";
        foreach ($error as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul></div>";
    }
    ?>
    No tienes cuenta? <a href="registro.php">Registrate</a>
</body>

</html>