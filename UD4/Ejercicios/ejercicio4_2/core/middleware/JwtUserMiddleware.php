<?php
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\UsuarioModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Acciones a realizar por el middleware.
 */
class JwtUserMiddleware implements Middleware
{
    public function handle(Request &$request)
    {
        $token = $request->getHeader('Authorization');
        $token = str_replace('Bearer ','',$token);
        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']));
            if($payload->rol !== 'user'){
                Response::json(['Error' => 'Token incorrecto para usuario.'],401);
                exit;
            }

            $request->usuario = UsuarioModel::get($payload->sub);
        } catch (\Throwable $th) {
            Response::json(['Error' => 'Autenticación fallida.'],401);
            exit;
        }
    }
}

