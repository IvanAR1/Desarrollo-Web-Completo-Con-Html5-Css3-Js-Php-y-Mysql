<?php

namespace Model;

class Propiedad extends Database
{
    protected static $table = 'propiedades';
    protected static $columnsDB = array(
        'id',
        'titulo',
        'precio',
        'imagen',
        'descripcion',
        'habitaciones',
        'wc',
        'estacionamiento',
        'creado',
        'vendedorId',
    );

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = array())
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('d/m/Y');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validate()
    {
        if(!$this->titulo or !$this->precio or !$this->descripcion or !$this->habitaciones or !$this->wc or !$this->estacionamiento or !$this->imagen)
        {
            self::$errores[] = "Ningún campo debe quedar vacío";
        }

        if(strlen($this->descripcion) < 50)
        {
            self::$errores[] = "La descripción no debe de tener menos de 50 carácteres";
        }
        
        if(!$this->vendedorId)
        {
            self::$errores[] = "Falta seleccionar a un vendedor";
        }

        if(!$this->imagen)
        {
            self::$errores[] = "La imágen es obligatoria";
        }

        return self::$errores;
    }
}