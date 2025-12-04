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
        $filters = ['nombre' => $filterNombre];
        if (!empty($filterMunicipio)) {
            $filters['cod_municipio'] = intval($filterMunicipio);

        }

        $provincias = ProvinciaModel::getFilter();
        $municipios = MunicipioModel::getFilter(!empty($filterProvincia)?['cod_provincia'=>intval($filterProvincia)]:null);
        $escuelas = EscuelaModel::getFilter($filters);

        $this->vista->showView("lista_escuelas",['municipios'=>$municipios, 
                                                                'escuelas'=>$escuelas,
                                                                'provincias'=>$provincias]);
    }
}