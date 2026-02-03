<?php
namespace Ejercicios\ejercicio4_2\core;

class Response{
    public static function json(array $data, int $status){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function notFound(){
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['Error' => 'Recurso no encontrado.']);
    }

    public static function serverError(){
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['Error' => 'Error de servidor.']);
    }
}