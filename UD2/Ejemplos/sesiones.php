<?php
//Para trabajar con sesiones. SIEMPRE ANTES
session_start();
//Escritura en variables de sesion.
// $_SESSION['intentos'] = 1;
// $_SESSION['numero_aleatorio'] = rand(1, 1000);
// $_SESSION['frutas'] = array('pera', 'manzana', 'platano');
// $_SESSION['intentos']++;

//Eliminar una variable de sesion
unset($_SESSION['numero_aleatorio']);

//Eliminar la sesión completa.
//1- Destruimos todas las variables de sesión del cliente actual. (opcional)
session_unset();
//2- Eliminamos la cookie de sesion.
$cookie_params = session_get_cookie_params();
setcookie(
    session_name(),
    '',
    time() - 3600,
    $cookie_params['path'],
    $cookie_params['domain'],
    $cookie_params['secure'],
    $cookie_params['httponly']
);
//3- Cerramos la sesion
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
</head>

<body>
    <?php
    echo "Intentos: ", $_SESSION['intentos'] ?? 'No hay';
    echo "Número", $_SESSION['numero_aleatorio'] ?? 'No hay';
    ?>

</body>

</html>