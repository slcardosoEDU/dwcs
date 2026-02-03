<?php
namespace Ejercicios\ejercicio4_2\controller;

use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\SensorModel;
use Ejercicios\ejercicio4_2\model\vo\SensorVo;
use Firebase\JWT\JWT;
use Exception;

class SensorController extends Controller
{

    public function store()
    {
        $this->request->validate(
            [
                'mac' => 'required|string|max:17|min:17',
                'localizacion' => 'required|string|max:50'
            ]
        );
        try {
            $usuarioActual = $this->request->usuario;
            $sensor = $this->request->body();
            $sensor = new SensorVo($sensor['mac'], $sensor['localizacion'], $usuarioActual->getCasaId());
            $sensor = SensorModel::add($sensor);
            
            if($sensor === null){
                Response::serverError();
                return;
            }

            $data = $sensor->toArray();
            $data['token'] = $this->generateJWT($sensor);
            Response::json($data, 201);

        }catch(Exception $th){
            Response::serverError();
        }

    }

    public function index()
    {

    }

    public function show(string $mac)
    {

    }

    public function update(string $mac)
    {

    }

    private function generateJWT(SensorVo $sensor):string{
        $payload = [
            'sub' => $sensor->getMac(),
            'iat' => time(),
            'exp' => time() + 5184000, // 60 dias
            'rol' => 'sensor'
        ];

        // Devolver el token JWT
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']);
        return $jwt;
    }

}