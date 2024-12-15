<?php
class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = strtok($_SERVER['REQUEST_URI'], '?');
        $params = $_GET;

        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path], $params);
        } else {
            echo "404 Not Found";
        }
    }
}
?>