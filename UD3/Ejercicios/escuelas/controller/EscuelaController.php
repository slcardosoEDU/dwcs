<?php
namespace Ejercicios\escuelas\controller;
use Ejercicios\escuelas\model\EscuelaModel;
use Ejercicios\escuelas\model\MunicipioModel;
use Ejercicios\escuelas\model\ProvinciaModel;
class EscuelaController extends Controller
{
    public function listarEscuelas()
    {
        $filterMunicipio = $_REQUEST['cod_municipio'] ?? '';
        $filterNombre = $_REQUEST['nombre'] ?? '';
        $filterProvincia = $_REQUEST['cod_provincia'] ?? '';
        
        $provincias = ProvinciaModel::getFilter(null);
        
        $municipios = MunicipioModel::getFilter(!empty($filterProvincia)?['cod_provincia'=>(int) $filterProvincia]:null);
        if (!empty($filterMunicipio)) {
            $filtros['cod_municipio'] = intval($filterMunicipio);
        }
        $filtros['nombre'] = $filterNombre;
        $escuelas = EscuelaModel::getFilter($filtros);

        $this->vista->showView("lista_escuelas", ['provincias' => $provincias, 'municipios' => $municipios, 'escuelas' => $escuelas]);

    }
}