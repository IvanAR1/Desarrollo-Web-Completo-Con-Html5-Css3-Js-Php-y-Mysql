<?php

namespace Controllers;
use MVC\Route;
use Model\Admin;

class LoginController
{
    public static function Login(Route $router)
    {   $errores = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $auth = new Admin($_POST);
            $errores = $auth->validate();

            if(empty($errores))
            {
                $resultado = $auth->IdExists();
                if(!$resultado)
                {
                    $errores = Admin::getErrores();
                }else
                {
                    $autenticado = $auth->PasswordExists($resultado);
                    if(!$autenticado)
                    {
                        $errores = Admin::getErrores();
                    }else
                    {
                        $auth->autenticado();
                    }
                }
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function Logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /');
    }
}