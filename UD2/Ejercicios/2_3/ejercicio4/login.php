<?php
include_once "funciones.php";
session_start();
if (isset($_SESSION['loged'])) {
    header("Location: restringido.php");
    exit;
}
//Si se esta logueando comprobamos usuario y contrasena.
if (
    isset($_POST['nic']) && isset($_POST['pass']) &&
    !empty($_POST['nic']) && !empty($_POST['pass'])
) {
    if (comprobar_usuario($_POST['nic'], $_POST['pass'])) {
        //Se cumple el login
        $_SESSION['loged'] = $_POST['nic'];
        //Impedir el acceso a la cookie de sesion por Js.
        $sesParams = session_get_cookie_params();
        setcookie(
            session_name(),
            session_id(),
            $sesParams['lifetime'],
            $sesParams['path'],
            $sesParams['domain'],
            $sesParams['secure'],
            true
        );
        $_SESSION['t_login'] = time();
        //Lo mandamos a la seccion restrigida.
        header("Location: restringido.php");
        exit;

    }

    $error = "Login incorrecto";

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
    <fieldset>
        <form action="" method="post">
            <label for="nic">Nombre de usuario (nic)</label><br>
            <input type="text" name="nic"><br>
            <label for="pass">Contraseña</label><br>
            <input type="password" name="pass"><br>
            <button type="submit">Acceder</button>
        </form>
    </fieldset>
    <?php
    if (isset($error)) {
        echo "<pre style='color:red'>$error </pre>";
    }
    ?>
    <a href="registro.php">Registrar usuario</a>

</body>

</html>