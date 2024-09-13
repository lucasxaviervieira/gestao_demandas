<?php

class Controller
{

    public function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            extract($data);

            require_once $viewPath;
        } else {
            throw new \Exception("View {$view} not found.");
        }
    }
}
