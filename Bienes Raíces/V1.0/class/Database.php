<?php

namespace App;

class Database
{
    protected static $db;
    protected static $columnsDB = array();
    protected static $errores = array();
    protected static $table = '';

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$table;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$table .' LIMIT ' . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function save()
    {
        if(!is_null($this->id))
        {
            $this->update();
        }else
        {
            $this->create();
        }
    }

    public function create()
    {
        $atributos = $this->disinfect();

        $columns_string = join(", ", array_keys($atributos));
        $values_string = join("', '",array_values($atributos));
        $query = "INSERT INTO " . static::$table . "($columns_string) ";
        $query .= "VALUES ('$values_string')";
        self::$db->query($query);
        header('Location: /admin?resultado=1');
    }

    public function update()
    {
        $atributos = $this->disinfect();
        $valores = array();
        foreach($atributos as $key => $value)
        {
            $valores[] = "{$key}='{$value}'";
        }

        /* Insertar en base de datos */
        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ',$valores);
        $query .= " Where id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";
        self::$db->query($query);
        header('Location: /admin?resultado=2');
    }

    public function delete()
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $this->deleteImage();
        self::$db->query($query);
        header('Location: /admin?resultado=3');
    }

    public function deleteImage()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo)
        {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = array();

        while($registro = $resultado->fetch_assoc())
        {   
            $array[] = static::crearObjeto($registro);

        }
        $resultado->free();

        return $array;
    }

    public function attributes()
    {
        $atributos = array();
        foreach(static::$columnsDB as $columna)
        {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function disinfect()
    {
        $atributos = $this->attributes();
        $disinfect = array();

        foreach($atributos as $key => $value)
        {
            $disinfect[$key] = self::$db->escape_string($value);
        }

        return $disinfect;
    }

    public static function getErrores()
    {
        return static::$errores;
    }

    public function setImagen($imagen)
    {

        if(!is_null($this->id)):
            $this->deleteImage();
        endif;
        if($imagen):$this->imagen = $imagen;endif;
    }

    public function validate()
    {
        static::$errores = array();
        return static::$errores;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach($registro as $key => $value)
        {
            if(property_exists($objeto, $key))
            {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public function sincronizar($args = array())
    {
        foreach($args as $key => $value)
        {
            if(property_exists($this, $key) && !is_null($value))
            {
                $this->$key = $value;
            }
        }
    }
}