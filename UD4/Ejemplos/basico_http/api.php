<?php

/**
 * Todo el trafico que reciba el servidor se redirige a este fichero.
 */

echo "Redirige bien! <br>";

// Obtener URI de la petición HTTP
$uri = $_SERVER['REQUEST_URI'];
// Obtenemos el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

//Obtener cuerpo de la petición
$body = file_get_contents('php://input');

echo "uri = $uri<br>";
echo "método = $method<br>";

echo "cuerpo = $body";