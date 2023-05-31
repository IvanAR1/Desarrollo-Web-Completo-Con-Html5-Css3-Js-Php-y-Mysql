<?php

namespace MVC;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public array $putRoutes = [];
    public array $deleteRoutes = [];


    public function get($url, $fn)
    {
        header("Access-Control-Allow-Methods: GET");
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        header("Access-Control-Allow-Methods: POST");
        $this->postRoutes[$url] = $fn;
    }

    public function put($url, $fn)
    {
        header("Access-Control-Allow-Methods: PUT");
        $this->putRoutes[$url] = $fn;
    }

    public function delete($url, $fn)
    {
        header("Access-Control-Allow-Methods: DELETE");
        $this->deleteRoutes[$url] = $fn;
    }

    public function validate()
    {
        // Protect Routes...
        session_start();

        // Fixed protected routes...
        // $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        // $auth = $_SESSION['login'] ?? null;
        
        $currentUrl = ltrim($_SERVER['REQUEST_URI'] ?? '/');
        $currentUrl = explode('?', $currentUrl)[0];

        switch(method())
        {
            case 'GET':
                header("Access-Control-Allow-Methods: GET");
                if(empty($this->getRoutes[$currentUrl])):$fn = null;break;endif;
                $fn = $this->getRoutes[$currentUrl];
                break;
            case 'POST':
                header("Access-Control-Allow-Methods: POST");
                if(empty($this->postRoutes[$currentUrl])):$fn = null;break;endif;
                $fn = $this->postRoutes[$currentUrl];
                break;
            case 'PUT':
                header("Access-Control-Allow-Methods: PUT");
                PUT();
                if(empty($this->putRoutes[$currentUrl])):$fn = null;break;endif;
                $fn = $this->putRoutes[$currentUrl];
                break;
            case 'DELETE':
                header("Access-Control-Allow-Methods: DELETE");
                DELETE();
                if(empty($this->deleteRoutes[$currentUrl])):$fn = null;break;endif;
                $fn = $this->deleteRoutes[$currentUrl];
                break;
            default:
                $fn = null;
                break;
        }

        if ( !empty($fn) ) {
            // Call user fn will call a function when we don't know what it will be
            call_user_func($fn, $this); // This is for passing arguments
        } else {
            $this->render('not-found');
        }
    }

    public function render(string $view, $data = array())
    {
        if(method() === 'GET')
        {
            header("Content-Type: text/html; charset=UTF-8");
            //TWIG
            $loader = new FilesystemLoader(__DIR__ . '\views');
            $twig = new Environment($loader, array());
            echo $twig->render($view.'.view.php', $data);
            return;
        }
    }
}
