<?php

use Ejercicios\ejercicio4_2\controller\AlertaController;
use Ejercicios\ejercicio4_2\controller\AuthController;
use Ejercicios\ejercicio4_2\controller\SensorController;
use Ejercicios\ejercicio4_2\core\middleware\JwtUserMiddleware;
//Endpoint de login
$router->post('/login',[AuthController::class,'login']);

//Endpoints de sensores
$router->post('/sensores',[SensorController::class,'store'],[JwtUserMiddleware::class]);
$router->get('/sensores',[SensorController::class,'index']);
$router->get('/sensores/{mac}',[SensorController::class,'show']);
$router->put('/sensores/{mac}',[SensorController::class,'update']);

//Endpoints de alertas
$router->post('/alertas',[AlertaController::class,'store']);





