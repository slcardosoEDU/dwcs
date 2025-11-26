<?php
namespace Ejemplos\mvc\controller;
use Ejemplos\mvc\view\View;
class Controller{
    protected View $vista;

    public function __construct(){
        $this->vista = new View();
    }
}