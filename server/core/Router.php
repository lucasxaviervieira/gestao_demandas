<?php

require_once('../app/utils/ConstructUrl.php');

class Router
{
    public function __construct()
    {
        $url = $this->parseUrl();

        $controllerName = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'LoginController';
        $controllerPath = '../app/controllers/' . $controllerName . '.php';

        $constructUrlModel = new ConstructUrl('/error');
        $errorUrl = $constructUrlModel->getUrl();

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controller = new $controllerName();

            $method = isset($url[1]) ? $url[1] : 'index';
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], array_slice($url, 2));
            } else {
                header("Location: $errorUrl");
            }
        } else {
            header("Location: $errorUrl");
        }
    }

    private function parseUrl()
    {
        if (strlen($_GET['url']) > 0) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}