<?php
use Ejercicios\ejercicio4_1\controller\BandaController;
use Ejercicios\ejercicio4_1\core\Router;
use Ejercicios\ejercicio4_1\controller\AuthController;

//Endpoints de bandas
$router->get('/bandas',[BandaController::class, 'index']);
$router->get('/bandas/{id}',[BandaController::class, 'show']);
$router->post('/bandas',[BandaController::class, 'store']);
$router->put('/bandas/{id}',[BandaController::class, 'update']);
$router->delete('/bandas/{id}',[BandaController::class, 'destroy']);

//Endpoints Auth
$router->post('/login',[AuthController::class, 'login']);
$router->post('/register',[AuthController::class, 'register']);
$router->get('/autenticado',[AuthController::class, 'validateToken']);


