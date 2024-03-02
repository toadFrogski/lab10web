<?php

namespace Core\Routing;

use Core\HttpFoundation\Request;
use Core\Routing\Route;
use Exception;

class Router
{
    private array $routes = [];

    public function __construct(Route ...$routes)
    {
        $this->add(...$routes);
    }
    public function add(Route ...$routes)
    {
        foreach ($routes as $r) {
            $this->routes[$r->getName()] = $r;
        }
    }

    public function dispatch(string $uri, string $method)
    {
        try {
            $request = new Request($uri);
            if (empty($route = $this->match($request->getPath(), $method))) {
                throw new Exception("No route found");
            }
            [$handlerController, $handlerMethod] = $route->getHandler();
            $controller = new $handlerController;
            echo $controller->{$handlerMethod}($request);
            die();
        } catch (\Exception $e) {
            header("HTTP/1.0 404 Not Found");
            die();
        }
    }

    public function redirect(string $name)
    {
        $route = $this->matchName($name);
        $route = (empty($route)) ? $name : $route->getPath();
        header("Location:" . $route);
        die();
    }

    private function match(string $path, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route->getPath() == $path && $route->getMethod() == $method) {
                return $route;
            }
        }
    }

    private function matchName(string $name)
    {
        foreach ($this->routes as $route) {
            if ($route->getName() == $name) {
                return $route;
            }
        }
    }
}
