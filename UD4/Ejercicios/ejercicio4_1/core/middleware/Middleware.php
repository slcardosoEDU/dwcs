<?php
namespace Ejercicios\ejercicio4_1\core\middleware;
use Ejercicios\ejercicio4_1\core\Request;
interface Middleware{
    public function handle(Request $request);
}