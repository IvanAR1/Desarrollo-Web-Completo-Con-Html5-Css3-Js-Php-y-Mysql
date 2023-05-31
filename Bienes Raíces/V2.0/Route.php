<?php
namespace MVC;

class Route
{
    public $get = array();
    public $post = array();

    public function get($url, $fn)
    {
        $this->get[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->post[$url] = $fn;
    }

    public function validate()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        $protected_routes = ['/admin', 
        '/propiedades/crear', 
        '/propiedades/actualizar',
        '/vendedores/crear',
        '/vendedores/actualizar',
        '/propiedades/eliminar',
        '/vendedores/eliminar',

    ];

        $url = ltrim($_SERVER['REQUEST_URI'] ?? '/');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method === 'GET')
        {
            $url = explode('?', $url)[0];
            $fn = $this->get[$url] ?? null;
        }else
        {
            $url = explode('?', $url)[0];
            $fn = $this->post[$url] ?? null;
        }

        if(in_array($url, $protected_routes) && !$auth)
        {
            header('Location: /');
        }

        if($fn)
        {
            call_user_func($fn, $this);
        }
        else
        {
            echo "Pagina no encontrada";
        }
    }

    public function render($views, $datos = array())
    {
        foreach($datos as $key => $value)
        {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . './views/'.$views.'.php';
        $contenido = ob_get_clean();
        include_once __DIR__ . '/views/layout.php';
    }
}