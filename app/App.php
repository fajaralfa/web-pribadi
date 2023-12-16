<?php

namespace App;

class App
{
    private array $routes = [];
    private ?string $not_found_view = null;

    public function route(
        string $method, string $path, string|array|callable $controller, ...$middlewares
    ) {
        $this->routes[$path][$method] = [$controller, $middlewares];
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? '/';

        [$controller, $middlewares] = $this->routes[$path][$method] ?? null;

        if(is_null($controller)) {
            http_response_code(404);
            echo $this->show_not_found_page();
            return;
        }

        foreach($middlewares as $mw)
            $this->execute($mw);

        echo $this->execute($controller);
    }

    private function execute(string|array|callable $any): string
    {
        if(is_string($any)) {
            return (new $any)();
        } else if(is_array($any)) {
            [$Class, $method] = $any;
            return (new $Class)->$method();
        } else if(is_callable($any)) {
            return $any();
        } else {
            throw new \TypeError("Target type doesn't match any");
        }
    }

    public function set_not_found_view(string $name = '404')
    {
        $this->not_found_view = $name;
    }

    public function show_not_found_page(): string
    {
        if(is_null($this->not_found_view)) {
            return 'Page Not Found';
        } else {
            return view($this->not_found_view);
        }
    }

    public function dump_routes()
    {
        var_dump($this->routes);
    }
}
