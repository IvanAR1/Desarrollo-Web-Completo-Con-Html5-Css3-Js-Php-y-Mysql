<?php include 'includes/header.php';
//Incluir otras clases
use app\clientes;
use app\detalles;


function mi_autoload($clase)
{
    $partes = explode('\\', $clase);
   require __DIR__.'/clases/'.$partes[1].'.class.php';
}

spl_autoload_register('mi_autoload');

$detalles = new detalles();
$clientes = new clientes();

include 'includes/footer.php';