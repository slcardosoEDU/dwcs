<?php
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Request;
class Controller{
    protected ?Request $request;

    public function __construct(?Request $request=null){
        $this->request = $request;
    }
}