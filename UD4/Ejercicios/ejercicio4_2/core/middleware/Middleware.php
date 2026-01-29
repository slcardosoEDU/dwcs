<?php
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
/**
 * Acciones a realizar por el middleware.
 */
interface Middleware{
    public function handle(Request $request);
}