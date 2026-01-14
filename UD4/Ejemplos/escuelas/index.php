<?php
require_once "globals.php";
use Ejemplos\escuelas\core\Request;
use Ejemplos\escuelas\core\Router;

spl_autoload_register(function ($clase) {

    $ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        error_log("No se encuentra la clase : $ruta");
    }
});

$request = new Request();
$router = new Router();

require_once 'config/routes.php';

$router->dispatch($request);
