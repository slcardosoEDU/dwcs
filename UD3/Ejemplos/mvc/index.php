<?php
require_once "globals.php";

//Autoload
/**
 * Esta funcion registra un callback que PHP llamara cada vez que encuentre una clase que aun no esta cargada.
 * Ese callback se encarga de buscar el archivo correcto y hacer el require.
 * De este modo podemos indicar simplemente los namespaces que estamos usando (parecido a Java) y evitar porner
 * requires (o includes) cada vez que necesitamos usar una clase.
 */
spl_autoload_register(function ($clase) {

    $ruta = __DIR__ . '/' . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        error_log("No se encuentra la clase : $ruta");
    }
});

$controller = $_REQUEST['controller'] ?? "ErrorController";
try {
    $controller = "Ejemplos\mvc\\Controller\\$controller";
    $objeto = new $controller();
    $action = $_REQUEST['action'] ?? 'pageNotFound';
} catch (\Throwable $th) {
    $objeto = new Ejemplos\mvc\Controller\ErrorController();
    $action = "pageNotFound";
}

try {
    $objeto->$action();
} catch (\Throwable $th) {
    $objeto = new Ejemplos\mvc\Controller\ErrorController();
    $objeto->pageNotFound();
}