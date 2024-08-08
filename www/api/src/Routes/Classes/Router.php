<?php

namespace Routes\Classes;

use App\Exceptions\AppException;
use App\Http\Middleware\AuthMiddleware;
use App\Response;
use Exception;

class Router
{
    private $prefix;

    public function __construct(string $prefix = "")
    {
        $this->prefix = $prefix;
    }

    private $routes = [];


    public function getPath(string $uri)
    {
        $path =  str_replace(PREFIX_URI . '/' . $this->prefix, '', $uri);
        return ($path === "/") ? $path : rtrim($path, '/');
    }


    public function add(string $method, string $path, callable $callback)
    {
        if (!in_array($method, ALLOWED_METHODS)) {
            throw new AppException();
        }

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function route(string $method, string $path, AuthMiddleware $middleware = null)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && preg_match('#^' . $route['path'] . '$#', $path, $matches)) {
                $middleware->handle($method, $path, function () use ($route, $matches) {
                    array_shift($matches);
                    call_user_func_array($route['callback'], $matches);
                });
                return;
            }
        }

        throw new AppException(404, 'Rota não definida.');
    }
}
