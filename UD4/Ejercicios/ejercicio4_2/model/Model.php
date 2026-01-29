<?php
namespace Ejercicios\ejercicio4_2\model;
use Pdo;

abstract class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=domotica', 'root', 'bitnami');
        return $db;
    }


}