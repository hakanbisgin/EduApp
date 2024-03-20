<?php

namespace App;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        $route = preg_replace('/\//', '\/', $route);
        $route = preg_replace('/\{([a-z_-]+)}/', '(?P<\1>[a-z0-9-]+)', $route);
        $route = '/^' . $route . '$/';
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch(): void
    {
        $uri = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        if ($uri === '') {
            $uri = '/';
        }
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes[$method] as $route => $handler) {
            if (preg_match($route, $uri, $matches)) {
                $controller = new $handler['controller'];
                $action = $handler['action'];
                $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
                try {
                    call_user_func_array([$controller, $action], $matches);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
                return;
            }
        }
        http_response_code(404);
        view('errors.404');;
    }

    public function resource($route, $controller)
    {
        $this->get($route, $controller, 'index');
        $this->get($route . '/create', $controller, 'create');
        $this->post($route, $controller, 'store');
        $this->get($route . '/{id}', $controller, 'show');
        $this->get($route . '/{id}/edit', $controller, 'edit');
        $this->post($route . '/{id}', $controller, 'update');
        $this->post($route . '/{id}/delete', $controller, 'destroy');
    }
}