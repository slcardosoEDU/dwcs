<?php
use Ejemplos\escuelas\core\Router;

//Endpoints para municipios
$router->get('/municipios', [MunicipioController::class, 'index']);
