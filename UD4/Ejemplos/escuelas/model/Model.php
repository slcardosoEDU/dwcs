<?php
namespace Ejemplos\escuelas\model;
use Pdo;

abstract class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=escolas_infantis', 'root', 'bitnami');
        return $db;
    }


}