<?php

use Ejercicios\ejercicio4_2\controller\AlertaController;
use Ejercicios\ejercicio4_2\controller\AuthController;
use Ejercicios\ejercicio4_2\controller\SensorController;
use Ejercicios\ejercicio4_2\core\middleware\JwtUserMiddleware;
use Ejercicios\ejercicio4_2\core\middleware\JwtSensorMiddleware;
//Endpoint de login
$router->post('/login', [AuthController::class, 'login']);

//Endpoints de sensores
$router->post('/sensores', [SensorController::class, 'store'], [JwtUserMiddleware::class]);
$router->get('/sensores', [SensorController::class, 'index'], [JwtUserMiddleware::class]);
$router->get('/sensores/{mac}', [SensorController::class, 'show'], [JwtSensorMiddleware::class]);
$router->put('/sensores/{mac}', [SensorController::class, 'update'], [JwtUserMiddleware::class]);

//Endpoints de alertas
$router->post('/alertas', [AlertaController::class, 'store'], [JwtSensorMiddleware::class]);





