<?php
class Router {
    public function __construct() {
        $url = $this->parseUrl();
        
        $controllerName = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        $controllerPath = '../app/controllers/' . $controllerName . '.php';
        
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controller = new $controllerName();
            
            $method = isset($url[1]) ? $url[1] : 'index';
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], array_slice($url, 2));
            }
        } else {
            echo "404 - Controller not found";
        }
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}