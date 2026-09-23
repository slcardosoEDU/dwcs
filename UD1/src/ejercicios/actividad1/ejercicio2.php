<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.2.2</title>
</head>

<body>
    <h1>Ejercicio 2</h1>
    <?php
    //Definicion de constantes
    define("USER", "admin");
    define("PASS","1234");
    //HASH de 1234 para login2
    // define("PASS", '$2y$12$f3X/J1rf5ZEnSXVIFR0yrOzc17kQy60yrq/3YJMQ9nglzi5NvkeUK');

    function login($user, $pass)
    {
        return !empty($user) && !empty($pass) && $user === USER && password_verify($pass, PASS);
    }


    function login2($user, $pass)
    {
        $hash = password_hash($pass,NULL);
        return !empty($user) && !empty($pass) && $user == USER && $hash == PASS;
    }
    $usr = "admin";
    $pass = "1234";
    echo "El login para $usr y $pass es ", login($usr, $pass) ? "correcto" : "incorrecto";
    ?>


</body>

</html>