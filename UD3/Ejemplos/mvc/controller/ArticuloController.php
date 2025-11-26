<?php
namespace Ejemplos\mvc\controller;
use Ejemplos\mvc\model\ArticuloModel;
use Ejemplos\mvc\model\ResenaModel;

class ArticuloController extends Controller{

    

    public function listarArticulos(){
        $articulosTodos = ArticuloModel::getArticulos();
        if(isset($articulosTodos)){
            $this->vista->showView("lista_productos", $articulosTodos);            
        }else{
            $this->vista->showView("error_lista");
        }
    }

    public function listarResenas(){
        $codArticulo = $_REQUEST['cod_articulo']??null;
        if(!isset($codArticulo)){
            $error = new ErrorController();
            $error->pageNotFound();
        }

        $articulo = ArticuloModel::getArticulo($codArticulo);
        if(isset($articulo)){
            $resenas = ResenaModel::getResenasArticulo($codArticulo);
            $datos = ['articulo'=>$articulo, 'resenas'=>$resenas];
            $this->vista->showView("listar_resenas", $datos);   
        }else{
            $error = new ErrorController();
            $error->pageNotFound();
        }
    }
}