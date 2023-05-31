<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function includeTemplate( string $nombre, bool $inicio = false )
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function esAutenticado(){
    session_start();
    if(!$_SESSION['login'])
    {
        header('Location: /');
    }
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html):string
{
    $s = htmlspecialchars($html);
    return $s;
}

function validarTipoContenido($tipo)
{
    $tipos = ['vendedores','propiedades'];
    return in_array($tipo,$tipos);
}

function Notification($code)
{
    $title = '';
    $mensaje = '';
    switch($code)
    {
        case 1:
            $title = 'Creado';
            $mensaje = 'Se ha creado correctamente';
            break;
        case 2:
            $title = 'Actualizado';
            $mensaje = 'Se ha actualizado correctamente';
            break;
        case 3:
            $title = 'Eliminado';
            $mensaje = 'Se ha eliminado correctamente';
            break;
        default:
            $title = false;
            $mensaje = false;
            break;
    }
    return array(
        'title'=>$title,
        'message'=>$mensaje
    );
}