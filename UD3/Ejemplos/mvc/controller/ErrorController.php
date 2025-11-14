<?php

class ErrorController{
    public function pageNotFound(){
        include_once VIEW_PATH."page_not_found-view.html";
        header("HTTP/1.1 404 Page not found");
        exit;
    }
}