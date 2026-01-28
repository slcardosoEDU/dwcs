<?php

namespace Ejercicios\ejercicio4_1\core;
/**
 * Wrapper del HTTP request.
 */
class Request
{

    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function body(): array
    {
        $body_text = file_get_contents('php://input');
        return json_decode($body_text, true) ?? [];
    }

    public function getHeader(string $headerKey){
        $headers = getallheaders();
        return $headers[$headerKey];
    }

    public function validate(array $rules)
    {
        $data = $this->body();
        $errors = [];

        foreach ($rules as $field => $ruleString) {
            $rulesArray = explode('|', $ruleString);
            foreach ($rulesArray as $rule) {
                //Required
                if ($rule === 'required' && !isset($data[$field])) {
                    $errors[$field][] = "Campo obligatorio";
                    continue;
                }
                //Tipo de dato (string, int y numeric)
                if ($rule === 'string' && isset($data[$field]) && !is_string($data[$field])) {
                    $errors[$field][] = "Campo debe ser un string";
                    continue;
                }

                if ($rule === 'int' && isset($data[$field]) && !is_int($data[$field])) {
                    $errors[$field][] = "Campo debe ser un número entero";
                    continue;
                }

                if ($rule === 'numeric' && isset($data[$field]) && !is_numeric($data[$field])) {
                    $errors[$field][] = "Campo debe ser un número";
                    continue;
                }
                //Limites de magnitud
                if (str_starts_with($rule, 'max:')) {
                    $max = (int) explode(':', $rule)[1];
                    $dataLen = is_string($data[$field]) ? strlen($data[$field]) : $data[$field];
                    if (isset($data[$field]) && $dataLen > $max) {
                        $errors[$field][] = "El campo no puede ser mayor de $max";
                        continue;
                    }
                }

                if (str_starts_with($rule, 'min:')) {
                    $min = (int) explode(':', $rule)[1];
                    $dataLen = is_string($data[$field]) ? strlen($data[$field]) : $data[$field];
                    if (isset($data[$field]) && $dataLen < $min) {
                        $errors[$field][] = "El campo no puede ser menor de $min";
                        continue;
                    }
                }

            }

        }

        //Comprobamos si hay errores (no valida)
        if (!empty($errors)) {
            Response::json(
                [
                    'message' => 'Datos invalidos'
                    ,
                    'errors' => $errors
                ]
                ,
                400
            );
            exit;
        }
    }
}