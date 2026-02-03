<?php
namespace Ejercicios\ejercicio4_2\controller;

use Ejercicios\ejercicio4_2\model\UsuarioModel;
use Ejercicios\ejercicio4_2\core\Response;
use Firebase\JWT\JWT;

class AuthController extends Controller{

    public function login(){
        $this->request->validate([
            'email'=>'required|string|max:256',
            'password' => 'required|string|max:255'
        ]);
        $user = $this->request->body();
        $user = UsuarioModel::getByEmailPassword($user['email'],$user['password']);
        
        if($user === null){
            Response::json(['Error' => 'Error de autenticación'],401);
            return;
        }
        $payload = [
            'sub' => $user->getId(),
            'iat' => time(),
            'exp' => time() + 3600,
            'rol' => 'user'
        ];

        // Devolver el token JWT
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']);

        Response::json(['token' => $jwt],200);
    }
}