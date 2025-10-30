<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>

<body>
    <h1>Productos</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>
        <?php
        include_once "funciones.php";
        $idCarrito = $_COOKIE['carrito'] ?? -1;
        $productos = getProductosCarrito($idCarrito);
        foreach ($productos as $p) {
            echo "<tr>";
            echo "<td>", $p->getNombre(), "</td>";
            echo "<td>", $p->getDescripcion(), "</td>";
            echo "<td>", $p->getPrecio(), " €</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><a href="index.php">Seguir comprando</a>
</body>

</html>