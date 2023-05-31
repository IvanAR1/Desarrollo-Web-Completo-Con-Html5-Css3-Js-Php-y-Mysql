<?php 
declare(strict_types = 1);
include 'includes/header.php';

class Producto
{
    public function __construct(public string $nombre, public int $precio, public bool $disponible)
    {
    }

    public function mostrarProducto()
    {
        echo "El producto es: ". $this->nombre. " y su precio es de: ". $this->precio;
    }

    public function Disponibilidad()
    {
        if($this->disponible): echo 'Está disponible';else: echo "No está disponible"; endif;
    }

}

echo "<pre>";
$producto = new Producto('Televisión', 15000, true);
$producto -> mostrarProducto();
$producto -> Disponibilidad();
echo "</pre>";

echo "<pre>";
$producto2 = new Producto("Laptop de 15'", 10000, false);
$producto2 -> mostrarProducto();
$producto2 -> Disponibilidad();
echo "</pre>";

include 'includes/footer.php';