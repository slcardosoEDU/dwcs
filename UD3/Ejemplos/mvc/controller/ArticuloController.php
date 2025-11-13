<?php
require_once $_SERVER['DOCUMENT_ROOT']."/Ejemplos/mvc/model/ArticuloModel.php";
class ArticuloController{

    public function listarArticulos(){
        $data = ArticuloModel::getArticulos();
        if(isset($data)){
            include_once $_SERVER['DOCUMENT_ROOT']."/Ejemplos/mvc/view/lista_productos-view.php";
        }else{
            include_once $_SERVER['DOCUMENT_ROOT']."/Ejemplos/mvc/view/error_lista-view.html";
        }
    }
}