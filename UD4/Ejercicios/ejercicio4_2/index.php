<?php
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Router;

//Cargamos configuracion
$_ENV = parse_ini_file(__DIR__.'/config/.env');

//Autoload
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
