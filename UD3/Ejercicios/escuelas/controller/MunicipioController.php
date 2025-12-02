<?php
namespace Ejercicios\escuelas\controller;
use Ejercicios\escuelas\model\MunicipioModel;

class MunicipioController extends Controller
{

    public static function getMunicipiosProvinciaJSON(): void
    {
        $codProvincia = isset($_REQUEST['cod_provincia']) ? (int) $_REQUEST['cod_provincia'] : '';

        if ($codProvincia === null) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el parámetro cod_provincia']);
            return;
        }
        $filtro = !empty($codProvincia)?['cod_provincia' => $codProvincia]:null;
        $municipiosVO = MunicipioModel::getFilter($filtro );

        // Construimos un array simple para json_encode
        $jsonArray = [];
        foreach ($municipiosVO as $m) {
            $jsonArray[] = [
                'cod_municipio' => $m->getCodMunicipio(),
                'nombre' => $m->getNombre()
            ];
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($jsonArray, JSON_UNESCAPED_UNICODE);
    }

}