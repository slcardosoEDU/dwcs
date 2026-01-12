<?php
require_once "globals.php";
use Ejemplos\escuelas\core\Request;
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
    ['method'=>'GET','uri'=>'/municipios','handler'=>['MunicipioController','index']],
    ['method'=>'GET','uri'=>'/municipios/{id}','handler'=>['MunicipioController','show']],
    ['method'=>'DELETE','uri'=>'/municipios/{id}','handler'=>['MunicipioController','destroy']],
    ['method'=>'UPDATE','uri'=>'/municipios/{id}','handler'=>['MunicipioController','update']],
    ['method'=>'POST','uri'=>'/municipios','handler'=>['MunicipioController','store']],
    
];

// 1 Obtener el método, uri y body de la peticion
$request = new Request();

// 2. Localizar el endpoint.
    // Recorro todos los endpoints declarados
    foreach($endpoints as $route){
        // Compruebo si el método coincide
        if($route['method'] == $request->method()){
            // Compruebo si la uri encaja
        }
        
    }
        
// 3. Llamar al método del controlador correspondiente.