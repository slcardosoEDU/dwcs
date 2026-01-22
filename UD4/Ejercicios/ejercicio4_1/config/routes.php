<?php
use Ejercicios\ejercicio4_1\controller\BandaController;
use Ejercicios\ejercicio4_1\core\Router;

//Endpoints de bandas
$router->get('/bandas',[BandaController::class, 'index']);
$router->get('/bandas/{id}',[BandaController::class, 'show']);
$router->post('/bandas',[BandaController::class, 'store']);
$router->put('/bandas/{id}',[BandaController::class, 'update']);
$router->delete('/bandas/{id}',[BandaController::class, 'destroy']);