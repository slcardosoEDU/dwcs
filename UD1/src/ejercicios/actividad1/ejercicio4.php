<?php
define("PI", 3.1416);
function volumenCilindro(float $r, float $h): float
{
    return $r ** 2 * $h * PI;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <h1>Ejercicio 4</h1>
    Volumen de un cilindro de radio 5cm y altura 20.5cm es: 
    <span style="color: red"><?= volumenCilindro(5, 20.5) ?>cm</span>;
</body>

</html>