<?php

namespace Controllers;

use MVC\Route;
use Model\Propiedad;
use Model\Vendedor;

class VendedorController
{
    public static function create(Route $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $vendedor = new Vendedor($_POST['vendedor']);
            $errores = $vendedor->validate();

            if(empty($errores))
            {
                $vendedor->save();
            }
        }

        $router->render('vendedores/crear', 
        [
            'vendedor' => $vendedor,
            'errores' => $errores,
        ]);
    }

    public static function update(Route $router)
    {
        $id = IdOrRedirect('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);
            $errores = $vendedor->validate();
            if(empty($errores))
            {
                $vendedor->save();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores,
        ]);
    }

    public static function delete()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id)
            {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo))
                {
                    $vendedor = Vendedor::find($id);
                    $vendedor->delete();
                }
            }
        }
    }
}