<?php
require_once "globals.php";

spl_autoload_register(function ($clase) {

    $ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        error_log("No se encuentra la clase : $ruta");
    }
});

$controller = $_REQUEST['controller'] ?? "ErrorController";
try {
    $controller = "Ejercicios\\escuelas\\controller\\$controller";
    $objeto = new $controller();
    $action = $_REQUEST['action'] ?? 'pageNotFound';
} catch (\Throwable $th) {
    $objeto = new Ejercicios\escuelas\controller\ErrorController();
    $action = "pageNotFound";
}

try {
    $objeto->$action();
} catch (\Throwable $th) {
    $objeto = new Ejercicios\escuelas\controller\ErrorController();
    $objeto->pageNotFound();
}