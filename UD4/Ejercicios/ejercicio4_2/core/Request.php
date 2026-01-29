<?php

namespace Ejercicios\ejercicio4_2\core;

use Ejercicios\ejercicio4_2\model\vo\UsuarioVo;
/**
 * Wrapper del HTTP request.
 */
class Request
{
    public ?UsuarioVo $usuario = null;

    /**
     * @return Uri de la pertición HTTP
     */
    public function uri(): string
    {
        //TODO
    }

    /**
     * 
     * @return Método de la petición HTTP
     */
    public function method(): string
    {
        //TODO
    }

    /**
     * 
     * @return JSON de la petición HTTP formateado como un array asociativo.
     */
    public function body(): array
    {
        //TODO
    }

    /**
     * @param string $headerKey Clave de la cabecera HTTP
     * @return Valor de la cabecera HTTP o null si no se encuentra.
     */
    public function getHeader(string $headerKey):?string
    {
        //TODO
    }

    /**
     * Comprueeba si los atributos del JSON que va en el cuerpo de la petición cumplen con las reglas indicadas en $rules.
     * El formato de $rules es ['atributo_X' => 'regla1|regla2|...|regla_n', ..., 'atributo_Y' => 'regla1|regla2|...|regla_n']
     * Si algun atributo no cumple con sus reglas de validación (HTTP 400) se responde con un error de validación y se corta la ejecución.
     * @param array $rules
     * @return void
     */
    public function validate(array $rules)
    {
        //TODO

    }


}