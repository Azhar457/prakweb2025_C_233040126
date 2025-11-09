<?php

class App
{
    // Properti (Pastikan defaultnya juga PascalCase)
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    // Method
    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($url[0])) {
            // Ubah URL (misal: 'user') menjadi Nama Class (misal: 'User')
            $controllerName = ucfirst($url[0]);
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        // Load controller jika gagal
        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        // Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Parameter
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}