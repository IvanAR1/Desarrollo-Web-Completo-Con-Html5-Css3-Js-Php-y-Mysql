<?php

namespace Router;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Router
{
    private $routes = [];
    private $prefix = '';
    
    public function get(string $route, callable | string | array $callback)
    {
        $this->addRoute('GET',$route,$callback);
    }

    public function post(string $route, callable | string | array $callback)
    {
        $this->addRoute('POST',$route,$callback);
    }

    public function put(string $route, callable | string | array $callback)
    {
        $this->addRoute('PUT',$route,$callback);
    }

    public function delete(string $route, callable | string | array $callback)
    {
        $this->addRoute('DELETE',$route,$callback);
    }

    public function prefix(string $prefix, callable $callback)
    {
        $previousPrefix = $this->prefix;
        $this->prefix .= $prefix;
        $callback($this);
        $this->prefix = $previousPrefix;
    }
    
    public function addRoute(string $method, string $route, callable | string | array $callback)
    {
        $route = $this->prefix . $route;
        $this->routes[] = [$method,$route,$callback];
    }

    public function dispatch()
    {
        $uri = ltrim($_SERVER['REQUEST_URI'] ?? '/');
        $uri = explode('?',$uri)[0];
        $method = $_SERVER['REQUEST_METHOD'];
        foreach($this->routes as $route)
        {
            list($routeMethod, $routeUri, $callback) = $route;
            if($method != $routeMethod):continue;endif;
            $params = [];
            $routeUriParts = explode('/',$routeUri);
            $uriParts = explode('/',$uri);
            if(count($routeUriParts) != count($uriParts)):continue;endif;
            $match = true;
            for($i = 0; $i < count($routeUriParts); $i++)
            {
                $routeUriPart = $routeUriParts[$i];
                if(preg_match('/^{(.*)}$/',$routeUriPart,$matches))
                {
                    $params[$matches[1]] = $uriParts[$i];
                }elseif($routeUriPart != $uriParts[$i]){
                    $match = false;
                    break;
                }
            }
            if($match)
            {
                list($controllerName,$methodName) = is_string($callback) ? explode("@",$callback): $callback;
                $controller = new $controllerName;
                call_user_func([$controller,$methodName],$this);
                return;
            }
        }
        $this->render('not-found');
    }

    public function render(string $view, $data = array())
    {
        if(method() === 'GET')
        {
            header("Content-Type: text/html; charset=UTF-8");
            //TWIG
            $loader = new FilesystemLoader(__DIR__ . '\../views');
            $twig = new Environment($loader, array());
            echo $twig->render($view.'.view.php', $data);
            return;
        }
    }
}
