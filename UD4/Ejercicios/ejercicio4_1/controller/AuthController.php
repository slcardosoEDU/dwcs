<?php
namespace Ejercicios\Ejercicio4_1\Controller;
use Ejercicios\ejercicio4_1\core\Request;
use Ejercicios\ejercicio4_1\core\Response;
use Ejercicios\ejercicio4_1\model\UsuarioModel;
use Ejercicios\ejercicio4_1\model\vo\UsuarioVo;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController{
    private Request $request;
    private $secretKey = "sad98723hjnd0912.si237dh1209dhEHDFRJWI2d2..3";

    public function __construct(){
        $this->request = new Request();
    }

    public function login(){
        $this->request->validate([
            'email'=>'string|required|max:256',
            'password'=>'string|required|max:256',
            ]);
        $data = $this->request->body();
        $user = UsuarioModel::getByEmailPassword($data['email'], $data['password']);
        if($user ===null){
            Response::json(['message'=>'No autenticado. Revise credenciales.'],401);
            return;
        }
        $token = self::createJwt($user, 3600);
        Response::json(['token'=> $token], 200);

    }

    public function register(){
        $this->request->validate([
            'nombre'=>'string|required|max:128',
            'email'=>'string|required|max:256',
            'password'=>'string|required|max:256',
            ]);
        $data = $this->request->body();
        $usuario = UsuarioVo::fromArray($data);
        $usuario = UsuarioModel::add($usuario);
        
        if($usuario === null){
            Response::serverError();
            return;
        }

        Response::json($usuario->toArray(),201);
    }

    public function validateToken(){
        $token = $this->request->getHeader('Authorization');

        if(!isset($token)){
            Response::json(["messaje"=>"Usuario no autenticado."],401);
            return;
        }

        $token = str_replace('Bearer ','',$token);

        try {
            $payload = JWT::decode($token, new Key($this->secretKey,'HS256'));
            Response::json(["messaje"=>"Usuario con id $payload->sub e email $payload->email. Autenticado!!"],200);
        } catch (Exception $th) {
            Response::json(["messaje"=>"Usuario no autenticado."],401);
        }
        

    }

    private function createJwt(UsuarioVo $vo,  $expireSeconds){
        
        $payload = [
            "sub" => $vo->getId(),
            "email" => $vo->getEmail(),
            "iat" => time(),
            "exp" => time() + $expireSeconds
        ];
        
        $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

        return $jwt;
    }
}