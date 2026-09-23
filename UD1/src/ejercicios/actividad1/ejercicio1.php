<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.1</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
   <?php
   function calcularIva($base, $percent=21){

        $resultado = $base * $percent /100;
        return $resultado;
    }

    $precio = 30.5;
    echo "El IVA de $precio es ",calcularIva($precio, 10);

   ?>

   
</body>
</html>