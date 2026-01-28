<?php
use Ejercicios\ejercicio4_1\controller\BandaController;
use Ejercicios\ejercicio4_1\core\middleware\JwtMiddleware;
use Ejercicios\ejercicio4_1\core\middleware\LogMiddleware;
use Ejercicios\ejercicio4_1\core\Router;
use Ejercicios\ejercicio4_1\controller\AuthController;

//Endpoints de bandas
$router->get('/bandas',[BandaController::class, 'index'], [LogMiddleware::class]);
$router->get('/bandas/{id}',[BandaController::class, 'show']);
$router->post('/bandas',[BandaController::class, 'store']);
$router->put('/bandas/{id}',[BandaController::class, 'update'], [JwtMiddleware::class]);
$router->delete('/bandas/{id}',[BandaController::class, 'destroy'], [JwtMiddleware::class]);

//Endpoints Auth
$router->post('/login',[AuthController::class, 'login']);
$router->post('/register',[AuthController::class, 'register']);



