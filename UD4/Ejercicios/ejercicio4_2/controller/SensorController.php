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

            if ($sensor === null) {
                Response::serverError();
                return;
            }

            $data = $sensor->toArray();
            $data['token'] = $this->generateJWT($sensor);
            Response::json($data, 201);

        } catch (Exception $th) {
            Response::serverError();
        }

    }

    public function index()
    {
        $casaId = $this->request->usuario->getCasaId();
        try {
            $sensores = SensorModel::getFilter(casaID: $casaId);
            $data = [];
            foreach ($sensores as $sensor) {
                $data[] = $sensor->toArray();
            }
            Response::json($data, 200);
        } catch (\Throwable $th) {
            Response::serverError();
            return;
        }
    }

    public function show(string $mac)
    {
        try {
            $sensor = $this->request->sensor;
            if ($sensor === null) {
                Response::notFound();
                return;
            }

            if ($sensor->getMac() !== $mac) {
                Response::json(['Error' => 'Acceso no autorizado'], 403);
                return;
            }

            $data = $sensor->toArray();
            $data['token'] = $this->generateJWT($sensor);
            Response::json($data, 200);

        } catch (\Throwable $th) {
            Response::serverError();
        }
    }

    public function update(string $mac)
    {
        $this->request->validate([
            'localizacion' => 'required|string|max:256'
        ]);

        try {
            $sensor = SensorModel::get($mac);
            if ($sensor === null) {
                Response::notFound();
                return;
            }

            if ($sensor->getCasaId() !== $this->request->usuario->getCasaId()) {
                Response::json(['Error' => 'Acceso no autorizado'], 403);
                return;
            }

            $sensor->setLocalizacion($this->request->body()['localizacion']);
            Response::json($sensor->toArray(),200);

        } catch (Exception $th) {
            Response::serverError();
            return;
        }
    }

    private function generateJWT(SensorVo $sensor): string
    {
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