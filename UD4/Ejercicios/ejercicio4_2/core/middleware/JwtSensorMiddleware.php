<?php
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\SensorModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Acciones a realizar por el middleware.
 */
class JwtSensorMiddleware implements Middleware
{
    public function handle(Request &$request)
    {
        $token = $request->getHeader('Authorization');
        $token = str_replace('Bearer ','',$token);
        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']));
            if($payload->rol !== 'sensor'){
                Response::json(['Error' => 'Token incorrecto para sensor.'],401);
                exit;
            }
            $request->sensor = SensorModel::get($payload->sub);
        } catch (\Throwable $th) {
            Response::json(['Error' => 'Autenticación fallida.'],401);
            exit;
        }
    }
}

