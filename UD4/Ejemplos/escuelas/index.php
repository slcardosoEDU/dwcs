<?php
require_once "globals.php";
use Ejemplos\escuelas\core\Request;
use Ejemplos\escuelas\controller\MunicipioController;

spl_autoload_register(function ($clase) {

    $ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        error_log("No se encuentra la clase : $ruta");
    }
});

// 0. Declarar endpoints
$endpoints = [
    // Endpoints de municipio
    ['method' => 'GET', 'uri' => '/municipios', 'handler' => [MunicipioController::class, 'index']],
    ['method' => 'GET', 'uri' => '/municipios/{id}', 'handler' => [MunicipioController::class, 'show']],
    ['method' => 'DELETE', 'uri' => '/municipios/{id}', 'handler' => [MunicipioController::class, 'destroy']],
    ['method' => 'PUT', 'uri' => '/municipios/{id}', 'handler' => [MunicipioController::class, 'update']],
    ['method' => 'POST', 'uri' => '/municipios', 'handler' => [MunicipioController::class, 'store']],

];

// 1 Obtener el método, uri y body de la peticion
$request = new Request();

// 2. Localizar el endpoint.
// Recorro todos los endpoints declarados
foreach ($endpoints as $route) {
    // Compruebo si el método coincide
    if ($route['method'] == $request->method()) {
        // Creo el patron para ese endpoint concreto.
        $patern = '#^' . preg_replace('#\{[\w]+\}#', '([\w]+)', $route['uri']) . '$#';
        // Para /municipios/{id}
        //  $patern = '#^/municipios/([\w]+)$#'
        // Para /municipios
        //  $patern = '#^/municipios$#'
        // Para /municipios/{id}/calles/4
        //  $patern = '#^/municipios/([\w]+)/calles/([\w]+)$#'

        // Compruebo si la uri encaja
        if (preg_match($patern, $request->uri(), $matches)) {
            unset($matches[0]);
            // Llamar al método del controlador adecuado
            $controller = new $route['handler'][0]();
            call_user_func_array([$controller, $route['handler'][1]], $matches);
            exit;
        }

    }

}

// 3. Llamar al método del controlador correspondiente.