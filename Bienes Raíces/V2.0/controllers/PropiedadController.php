<?php

namespace Controllers;
use MVC\Route;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Route $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;
        $router->render('/propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function create(Route $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $propiedad = new Propiedad($_POST['propiedad']);
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen'])
            {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }

            
    
            $errores = $propiedad->validate();
            if(empty($errores))
            {
                if(!is_dir(CARPETA_IMAGENES))
                {
                    mkdir(CARPETA_IMAGENES);
                }
    
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                $propiedad->save();
            }
        }

        $router->render('/propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function update(Route $router)
    {
        $id = IdOrRedirect('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            $errores = $propiedad->validate();

            //Revisar que el arreglo de errores quede vacío
            if(empty($errores))
            {
                $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";
                if($_FILES['propiedad']['tmp_name']['imagen'])
                {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->save();
            }
        }

        $router->render('/propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
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
                $propiedad = Propiedad::find($id);
                $propiedad->delete();
            }
        }
    }
}