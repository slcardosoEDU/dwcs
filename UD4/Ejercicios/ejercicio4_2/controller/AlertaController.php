<?php
namespace Ejercicios\ejercicio4_2\controller;

use Ejercicios\ejercicio4_1\core\Response;
use Ejercicios\ejercicio4_2\model\AlertaModel;
use Exception;

class AlertaController extends Controller
{

    public function store()
    {
        $sensor = $this->request->sensor;
        try {
            $alerta = AlertaModel::add($sensor->getMac());
            if($alerta === null){
                throw new Exception();
            }
            Response::json($alerta->toArray(),201);
        } catch (\Throwable $th) {
            Response::serverError();
            return;
        }
    }
}