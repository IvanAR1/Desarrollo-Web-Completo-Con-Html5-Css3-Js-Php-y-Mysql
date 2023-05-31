<?php 
declare(strict_types = 1);
include 'includes/header.php';

//Encapsulación

class Producto
{
    //Public: Se puede acceder y modificar en cualquier lugar
    //Protected: Se puede acceder solo en la clase
    //Private: Solo miembros de la misma clase pueden acceder a el
    public function __construct(protected string $nombre, public int $precio, public bool $disponible)
    {
    }

    public function mostrarProducto() : void
    {
        echo "El producto es: ". $this->nombre. " y su precio es de: ". $this->precio;
    }

    public function Disponibilidad() : void
    {
        if($this->disponible): echo 'Está disponible';else: echo "No está disponible"; endif;
    }

    public function getNombre() : string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

}

echo "<pre>";
$producto = new Producto('Televisión', 15000, true);
echo $producto->getNombre();
$producto->setNombre('Tablet');
var_dump($producto);

include 'includes/footer.php';