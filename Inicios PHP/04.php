<?php include 'includes/header.php';

//Herencia

//Clase padre
class Transporte
{
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $transmision){}
    
    public function getInfo() : string
    {
        return 'El transporte tiene ' .$this->ruedas.' ruedas, con una capacidad de '.$this->capacidad.' personas';
    }
}

//Primera Clase hija
class Bicicleta extends Transporte
{
    public function getInfo(): string
    {
        return parent::getInfo()." y no gasta gasolina"; 
    }
}

//Segunda clase hija
class Automovil extends Transporte
{
    public function getInfo() : string
    {
        return parent::getInfo().' y tiene una transmisión '.$this->transmision;
    }
}

$bicicleta = new Bicicleta(2,1,'');
echo $bicicleta->getInfo();
echo "<hr>";

$Automovil = new Automovil(4,5, 'Manual');
echo $Automovil->getInfo();
echo "<hr>";




include 'includes/footer.php';