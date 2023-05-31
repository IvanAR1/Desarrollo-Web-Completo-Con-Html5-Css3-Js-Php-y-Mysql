<?php

use Automovil as GlobalAutomovil;
use Transporte as GlobalTransporte;
use TransporteInterface as GlobalTransporteInterface;

include 'includes/header.php';
interface TransporteInterface
{
    public function getInfo() : string;
    public function getRuedas() : int;
}

class Transporte implements TransporteInterface
{
    public function __construct(protected int $capacidad){}
    
    public function getInfo() : string
    {
        return ' con una capacidad de '.$this->capacidad.' personas';
    }

    public function getRuedas() : int
    {
        return $this->ruedas;
    }
}

class Automovil extends Transporte implements TransporteInterface
{
    public function __construct(protected int $capacidad, protected int $ruedas, protected string $color){}

    public function getInfo() : string
    {
        return "El automóvil tiene ". $this->ruedas. ' ruedas'. parent::getInfo(). ' y tiene el color '.$this->color;
    }

}

$automovil = new Automovil(5,4, 'rojo');
ECHO $automovil->getInfo();


include 'includes/footer.php';