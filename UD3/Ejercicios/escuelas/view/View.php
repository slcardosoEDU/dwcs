<?php
namespace Ejercicios\escuelas\view;

class View{

    /**
     * Muestra la vista correspondiente declarada en el fichero $viewName-view.php
     * @param string $viewName
     * @param array $data Datos a pasarle en la vista en un array asociativo.
     * @return void
     *
     */
    public function showView(string $viewName, ?array $data=null){
        include_once VIEW_PATH."$viewName-view.php";
    }
}