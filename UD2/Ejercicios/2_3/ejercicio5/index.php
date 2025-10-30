<?php
include_once "funciones.php";
$allProducts = getProductos();
//Funcionalidad agregar producto a carrito.
if (isset($_GET['idProducto']) && is_int(intval($_GET['idProducto']))) {
    //Compruebo que exista un carrito creado
    if(!isset($_COOKIE['carrito'])){
        //Creo el carrito
        $carritoId = addCarrito();
        setcookie('carrito',$carritoId,time()+172800);
    }else{
        //Obtengo id del carrito actual.
        $carritoId = $_COOKIE['carrito'];
    }
    $producto = new Producto();
    $producto->setId($_GET['idProducto']);
    //Agrego el producto al carrito
    addProductoCarrito($carritoId, $producto);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>

<body>
    <h1>Productos</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Carrito</th>
        </tr>
        <?php
        foreach ($allProducts as $p) {
            echo "<tr>";
            echo "<td>", $p->getNombre(), "</td>";
            echo "<td>", $p->getDescripcion(), "</td>";
            echo "<td>", $p->getPrecio(), " €</td>";
            echo "<td><a href='?idProducto=", $p->getID(), "'>Agregar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    if(isset($_COOKIE['carrito']) || isset($carritoId)){
        echo "<br><a href='carrito.php'>Ver carrito</a>";
    }
    ?>
</body>

</html>