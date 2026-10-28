<?php

/**
 * Funciones de manipulación de datos en la BD.
 */

define("DSN", "mysql:host=db;dbname=desarrollo");
define("USER", "usuario");
define("PASS", "abc1234");

function getConnection(): PDO
{
    $conexion = new PDO(DSN, USER, PASS);
    return $conexion;
}

function addVideojuego(string $nombre, string $plataforma, int $lanzamiento, ?string $genero = null): bool
{
    $toret = false;
    if (isset($genero)) {
        $sql = "INSERT INTO videojuegos(nombre, plataforma, anio_lanzamiento, genero) 
        VALUES ('$nombre','$plataforma',$lanzamiento,'$genero')";
    } else {
        $sql = "INSERT INTO videojuegos(nombre, plataforma, anio_lanzamiento) 
        VALUES ('$nombre','$plataforma',$lanzamiento)";
    }

    try {
        $db = getConnection();
        $toret = $db->exec($sql) === 1;
    } catch (PDOException $th) {
        error_log("Error agregando videojuego [$sql] " . $th->getMessage());
        $toret = false;
    } finally {
        $db = null;
    }

    return $toret;
}

function updateVideojuego(int $id, string $nombre, string $plataforma, int $lanzamiento, ?string $genero = null): bool
{
    $toret = false;

    if (isset($genero)) {
        $sql = "UPDATE videojuegos 
        SET nombre='$nombre',plataforma='$plataforma',anio_lanzamiento=$lanzamiento,genero='$genero' 
        WHERE id = $id";
    } else {
        $sql = "UPDATE videojuegos 
        SET nombre='$nombre',plataforma='$plataforma',anio_lanzamiento=$lanzamiento,genero= NULL 
        WHERE id = $id";
    }
    try {
        $db = getConnection();
        $toret = $db->exec($sql) === 1;
    } catch (PDOException $th) {
        error_log("Error actualizando videojuego [$sql] " . $th->getMessage());
        $toret = false;
    } finally {
        $db = null;
    }

    return $toret;
}

function deleteVideojuego(int $id): bool
{
    $toret = false;
    $sql = "DELETE FROM videojuegos WHERE id = $id";
    try {
        $db = getConnection();
        $toret = $db->exec($sql) === 1;
    } catch (PDOException $th) {
        error_log("Error eliminando videojuego [$sql] " . $th->getMessage());
        $toret = false;
    } finally {
        $db = null;
    }

    return $toret;
}
/**
 * @return array con las claves [id, nombre, plataforma, anio_lanzamiento, genero ] o falso en caso de que no
 *         se encuentre el videojuego.
 */
function getVideojuego(int $id): array|false
{
    $toret = null;
    $sql = "SELECT id, nombre, plataforma, anio_lanzamiento, genero FROM videojuegos WHERE id = $id";
    try {
        $db = getConnection();
        $statement = $db->query($sql);
        if ($statement) {
            $toret = $statement->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $th) {
        error_log("Error obteniendo un videojuego [$sql] " . $th->getMessage());
        $toret = null;
    } finally {
        $db = null;
    }

    return $toret;
}

/**
 * @return array con todos los videojuegos registrados en formato de matriz. Cada fila del array
 * contiene otro array con el formato [id, nombre, plataforma, anio_lanzamiento, genero].
 */
function getAllVideojuegos(): array
{
    $toret = [];
    $sql = "SELECT id, nombre, plataforma, anio_lanzamiento, genero FROM videojuegos";
    try {
        $db = getConnection();
        $statement = $db->query($sql);
        if ($statement) {
            $toret = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $th) {
        error_log("Error obteniendo todos los videojuegos [$sql] " . $th->getMessage());
        $toret = [];
    } finally {
        $db = null;
    }

    return $toret;
}
