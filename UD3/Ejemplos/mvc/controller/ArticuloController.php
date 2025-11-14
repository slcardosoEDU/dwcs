<?php
require_once MODEL_PATH."ArticuloModel.php";
class ArticuloController{

    public function listarArticulos(){
        $data = ArticuloModel::getArticulos();
        if(isset($data)){
            include_once VIEW_PATH."lista_productos-view.php";
        }else{
            include_once VIEW_PATH."error_lista-view.html";
        }
    }
}