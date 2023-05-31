<?php

namespace Model;

class Admin extends Database
{
    protected static $tabla = 'login';
    protected static $columnasDB = array(
        'id',
        'email',
        'password',
    );
    public $id;
    public $email;
    public $password;

    public function __construct($args = array())
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $password = $args['password'] ?? '';
        $this->password = md5($password);
    }

    public function validate()
    {
        if(!$this->email or !$this->password)
        {
            self::$errores[] = 'Email y password requeridos';
        }

        return self::$errores;
    }

    public function IdExists()
    {
        $query = "SELECT * FROM " . self::$tabla;
        $query .= " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows)
        {
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;
    }

    public function PasswordExists($resultado)
    {
        $usuario = $resultado->fetch_object();
        if($this->password != $usuario->password)
        {
            self::$errores[] = 'Contraseña incorrecta';
            return;
        }
        return true;
    }

    public function autenticado()
    {
        session_start();
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        header('Location: /admin');
    }
}