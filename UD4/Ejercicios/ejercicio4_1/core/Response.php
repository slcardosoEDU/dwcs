<?php
namespace Ejercicios\ejercicio4_1\core;

class Response{
    public static function json($data, int $status){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function notFound(){
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Recurso no encontrado.']);
    }

    public static function serverError(){
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Se ha producido un error.']);
    }
}