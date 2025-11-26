<?php
namespace Ejemplos\mvc\controller;
use Ejemplos\mvc\model\ResenaModel;
use Ejemplos\mvc\model\Resena;
use Exception;
class ResenaController extends Controller
{

    

    public function addResena()
    {
        
        try {
            $resena = new Resena();
            $resena->codArticulo = $_REQUEST['cod_articulo'] ?? null;
            $resena->descripcion = $_REQUEST['descripcion'] ?? null;
            $resena->setFechaHora("now");
            if(!ResenaModel::addResena($resena)){
                throw new Exception("Error agregando resena: ");
            }
            $articulo = new ArticuloController();
            $articulo->listarResenas();
            
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView('error_add_resena');
        }
    }

}