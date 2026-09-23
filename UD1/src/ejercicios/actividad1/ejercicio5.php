<?php
function reverso(int $numero): int
{
    $enString = strval($numero);
    $reverso = strrev($enString);
    return intval($reverso);
}
$numero = 789;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>

<body>
    <h1>Ejercicio 5</h1>
    El reverso del número <?= $numero ?> es:
    <span style="color: red"><?= reverso($numero) ?></span>;
    <br>
    El tipo es <?php var_dump(reverso($numero)); ?>
</body>

</html>