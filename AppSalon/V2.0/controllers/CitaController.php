<?php

namespace Controllers;

use Router\Router;

class CitaController
{
    public function __construct()
    {
        session_start();
    }
    
    public static function index(Router $router)
    {
        $username = $_SESSION['user_name'] ?? "";
        $router->render('quotes/index',[
            'username' => $username,
            'min_date' => date("Y-m-d", strtotime('+1 day'))
        ]);
    }
}