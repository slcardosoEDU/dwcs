<?php
namespace Ejemplos\mvc\model;
use Pdo;
class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=articulos', 'root', 'bitnami');
        return $db;
    }

}