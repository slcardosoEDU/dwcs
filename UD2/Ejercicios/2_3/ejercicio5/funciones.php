<?php
/**
 * Funciones para manipular datos en la BD.
 */
include_once "producto.php";
define("DB_DSN", "mysql:host=mariadb; dbname=e_335");
define("DB_USER", "root");
define("DB_PASS", "bitnami");

function getConnection()
{
    $db = null;
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $ex) {
        die("Error de conexion con la BD: " . $ex->getMessage());
    }
    return $db;
}

function getProductos(): array
{
    $sql = "SELECT id_producto, nombre, descripcion, precio FROM PRODUCTO";
    $productos = [];
    $db = getConnection();
    try {
        $statement = $db->query($sql);
        foreach ($statement as $row) {
            $p = new Producto();
            $p->setId($row['id_producto']);
            $p->setNombre($row['nombre']);
            $p->setdescripcion($row['descripcion']);
            $p->setPrecio($row['precio']);
            $productos[] = $p;
        }
        $statement->closeCursor();
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $db = null;
    }
    return $productos;

}
/**
 * Agrega un nuevo carrito a la BD.
 * @return id del carrito agregado.
 */
function addCarrito(): int
{
    $sql = "INSERT INTO CARRITO(id_carrito) VALUES (NULL)";
    $db = getConnection();
    $idCarrito = -1;
    try {
        if ($db->exec($sql)) {
            $sql = "SELECT MAX(id_carrito) as id FROM CARRITO";
            $statement = $db->query($sql);
            $row = $statement->fetch();
            $idCarrito = $row['id'];
            $statement->closeCursor();
        }

    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $db = null;
    }

    return $idCarrito;

}
/**
 * Agrega el producto al carrito indicado.
 * @param int $idCarrito
 * @param Producto $producto
 * @return true si se ha producido o false en caso contrario.
 */
function addProductoCarrito(int $idCarrito, Producto $producto): bool
{
    $sql = "INSERT INTO CARRITO_PRODUCTO(id_carrito, id_producto) VALUES (:id_carrito,:id_producto)";
    $db = getConnection();
    $toret = false;
    try {
        $statement = $db->prepare($sql);
        $statement->bindValue("id_carrito", $idCarrito, PDO::PARAM_INT);
        $statement->bindValue("id_producto", $producto->getId(), PDO::PARAM_INT);
        $toret = $statement->execute();
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $db = null;
    }
    return $toret;
}

/**
 * 
 * Devuelve todos los productos de un carrito en un array.
 * @param int $idCarrito
 * @return array
 */
function getProductosCarrito(int $idCarrito): array
{
    $sql = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio 
            FROM CARRITO_PRODUCTO cp
            INNER JOIN PRODUCTO p ON cp.id_producto = p.id_producto
            WHERE cp.id_carrito = ?";
    $productos = [];
    $db = getConnection();
    try {
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $idCarrito, PDO::PARAM_INT);
        $statement->execute();
        foreach ($statement as $row) {
            $p = new Producto();
            $p->setId($row['id_producto']);
            $p->setNombre($row['nombre']);
            $p->setdescripcion($row['descripcion']);
            $p->setPrecio($row['precio']);
            $productos[] = $p;
        }
        $statement->closeCursor();
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $db = null;
    }
    return $productos;

}