<?php 
declare(strict_types = 1);

use Producto as GlobalProducto;

include 'includes/header.php';


//Métodos estáticos
class Producto
{
    public $imagen;
    public static $ImagenPlaceholder = 'Imagen.jpg'; 
    //Public: Se puede acceder y modificar en cualquier lugar
    //Protected: Se puede acceder solo en la clase
    //Private: Solo miembros de la misma clase pueden acceder a el
    public function __construct(protected string $nombre, public int $precio, public bool $disponible, string $imagen)
    {
        if($imagen)
        {
            self::$ImagenPlaceholder = $imagen;
        }
    }

    public static function obtenerImagenProducto()
    {
        echo 'Obteniendo datos del Producto... ';
        return self::$ImagenPlaceholder;
    }

    public function mostrarProducto() : void
    {
        echo "El producto es: ". $this->nombre. " y su precio es de: $". $this->precio;
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
$producto2 = new Producto('Televisión', 15000, true, 'Televisión');
echo $producto2->obtenerImagenProducto();

echo "</pre> <pre>";
echo $producto2->mostrarProducto();

echo "</pre> <pre>";
echo $producto2->Disponibilidad();

echo "</pre> <pre>";
echo $producto2->getNombre();

echo "</pre> <pre>";
$producto2->setNombre('Laptop');
var_dump($producto2);

include 'includes/footer.php';