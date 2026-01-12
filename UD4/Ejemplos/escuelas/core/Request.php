<?php

namespace Ejemplos\escuelas\core;
/**
 * Wrapper del HTTP request.
 */
class Request{

    public function uri():string{
        return $_SERVER['REQUEST_URI'];
    }

    public function method():string{
        return $_SERVER['REQUEST_METHOD'];
    }

    public function body():array{
        $body_text = file_get_contents('php://input');
        return json_decode($body_text,true) ?? [];
    }
}