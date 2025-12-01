<?php
namespace Ejercicios\escuelas\controller;
class ErrorController extends Controller{
    public function pageNotFound(){
        $this->vista->showView("page_not_found");
        header("HTTP/1.1 404 Page not found");
        exit;
    }
}