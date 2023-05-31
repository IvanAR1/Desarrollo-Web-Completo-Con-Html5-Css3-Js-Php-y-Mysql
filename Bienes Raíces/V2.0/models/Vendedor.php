<?php

namespace Model;

class Vendedor Extends Database
{
    protected static $table = 'vendedores';
    protected static $columnsDB = array(
        'id',
        'nombre',
        'apellido',
        'telefono'
    );
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = array())
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validate()
    {
        if(!$this->nombre or !$this->apellido or !$this->telefono)
        {
            self::$errores[] = "Ningún campo debe quedar vacío";
        }

        if(!preg_match('/[0-9]{10}/',$this->telefono))
        {
            self::$errores[] = "El teléfono debe de ser de tipo numerico";
        }

        return self::$errores;
    }

}