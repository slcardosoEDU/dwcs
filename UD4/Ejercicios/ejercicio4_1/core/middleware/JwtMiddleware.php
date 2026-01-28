<?php
namespace Ejercicios\ejercicio4_1\core\middleware;
use Ejercicios\ejercicio4_1\core\Request;
use Ejercicios\ejercicio4_1\core\Response;
use Ejercicios\ejercicio4_1\model\UsuarioModel;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JwtMiddleware implements Middleware{
    public function handle(Request $request){
        //Comprobar que el usuario está autenticado.
        $token = $request->getHeader('Authorization');

        if(!isset($token)){
            Response::json(["messaje"=>"Usuario no autenticado."],401);
            exit;
        }

        $token = str_replace('Bearer ','',$token);

        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'],$_ENV['JWT_ALGO']));
            //$request->usuario = UsuarioModel::get($payload->sub);
        } catch (Exception $th) {
            Response::json(["messaje"=>"Usuario no autenticado.",
                                   "login" => $_SERVER['SERVER_NAME']."/login"],401);
            exit;
        }
    }

    
}