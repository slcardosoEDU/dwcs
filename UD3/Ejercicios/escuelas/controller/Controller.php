<?php
namespace Ejercicios\escuelas\controller;
use Ejercicios\escuelas\view\View;
class Controller{
    protected View $vista;

    public function __construct(){
        $this->vista = new View();
    }
}