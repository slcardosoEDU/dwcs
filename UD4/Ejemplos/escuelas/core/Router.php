<?php
namespace Ejemplos\escuelas\core;

class Router
{

    private $routes = [];

    public function get(string $uri, array $handler)
    {
        $this->routes[] = ['method' => 'GET', 'uri' => $uri, 'handler' => $handler];
    }

    public function post(string $uri, array $handler)
    {
        $this->routes[] = ['method' => 'POST', 'uri' => $uri, 'handler' => $handler];
    }

    public function put(string $uri, array $handler)
    {
        $this->routes[] = ['method' => 'PUT', 'uri' => $uri, 'handler' => $handler];
    }

    public function delete(string $uri, array $handler)
    {
        $this->routes[] = ['method' => 'DELETE', 'uri' => $uri, 'handler' => $handler];

    }

    public function dispatch(Request $request)
    {
        // Recorro todos los endpoints declarados
        foreach ($this->routes as $route) {
            // Compruebo si el método coincide
            if ($route['method'] == $request->method()) {
                // Creo el patron para ese endpoint concreto.
                $patern = '#^' . preg_replace('#\{[\w]+\}#', '([\w]+)', $route['uri']) . '$#';
                // Para /municipios/{id}
                //  $patern = '#^/municipios/([\w]+)$#'
                // Para /municipios
                //  $patern = '#^/municipios$#'
                // Para /municipios/{id}/calles/4
                //  $patern = '#^/municipios/([\w]+)/calles/([\w]+)$#'

                // Compruebo si la uri encaja
                if (preg_match($patern, $request->uri(), $matches)) {
                    unset($matches[0]);
                    // Llamar al método del controlador adecuado
                    $controller = new $route['handler'][0]();
                    call_user_func_array([$controller, $route['handler'][1]], $matches);
                    return;
                }
            }

        }
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint no encontrado']);
    }
}