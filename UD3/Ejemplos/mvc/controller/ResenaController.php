<?php
namespace Ejemplos\mvc\controller;
use ArticuloModel;
use Ejemplos\mvc\model\ResenaModel;
use Ejemplos\mvc\model\Resena;
use Exception;
class ResenaController
{

    public function nuevaResena(){
        $codArticulo = $_REQUEST['cod_articulo']??null;
        if(!isset($codArticulo)){
            $error = new ErrorController();
            $error->pageNotFound();
        }

        $articulo = ArticuloModel::getArticulo($codArticulo);
    }

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
            $this->listarResenasArticulo();
            
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            include_once VIEW_PATH."error_add_resena-view.html";
        }
    }

    public function listarResenasArticulo(?int $codArticulo = null)
    {

    }
}