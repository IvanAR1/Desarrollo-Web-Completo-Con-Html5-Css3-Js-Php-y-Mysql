<?php

namespace Model;

class UserModel extends ActiveRecord
{
    protected static $table = "users";
    protected static $columns = ['id','users_name','users_lname','users_email','users_cellphone','users_admin','users_email_verified','users_token','users_password'];
    public $id;
    public $users_name;
    public $users_lname;
    public $users_email;
    public $users_cellphone;
    public $users_admin;
    public $users_email_verified;
    public $users_token;
    public $users_password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->users_name = $args['users_name'] ?? '';
        $this->users_lname = $args['users_lname'] ?? '';
        $this->users_email = $args['users_email'] ?? '';
        $this->users_cellphone = $args['users_cellphone'] ?? '';
        $this->users_admin = $args['users_admin'] ?? 0;
        $this->users_email_verified = $args['users_email_verified'] ?? 0;
        $this->users_token = $args['users_token'] ?? '';
        $this->users_password = $args['users_password'] ?? '';
    }

    public function NewAccountValidate()
    {
        if(!$this->users_name)
        {
            self::$alerts['errors'][] = 'El nombre del cliente es requerido';
        }
        if(!$this->users_lname)
        {
            self::$alerts['errors'][] = 'Los apellidos del cliente son requeridos';
        }
        if(!$this->users_email)
        {
            self::$alerts['errors'][] = 'El correo es requerido';
        }
        if(!$this->users_cellphone)
        {
            self::$alerts['errors'][] = 'El número telefónico es requerido';
        }
        if(!$this->users_password)
        {
            self::$alerts['errors'][] = 'La contraseña es requerida';
        }
        if(strlen($this->users_password) < 8)
        {
            self::$alerts['errors'][] = 'El password debe contener al menos 8 caracteres';
        }
        return self::$alerts;
    }

    public function UserExists()
    {
        $table = self::$table;
        $email = $this->users_email;
        $query = "SELECT * FROM $table WHERE users_email = '$email' LIMIT 1";
        $result = self::$db->query($query);
        if($result->num_rows)
        {
            self::$alerts['errors'][] = 'El usuario ya está registrado';
        }
        return $result;
    }

    public function UserAuth()
    {
        if(!$this->users_email)
        {
            self::$alerts['errors'][] = 'El correo es requerido';
        }
        if(!$this->users_password)
        {
            self::$alerts['errors'][] = 'La contraseña es requerida';
        }
        if(strlen($this->users_password) < 8)
        {
            self::$alerts['errors'][] = 'El password debe contener al menos 8 caracteres';
        }
        return self::$alerts;
    }

    public function Hash()
    {
        $this->users_password = password_hash($this->users_password, PASSWORD_BCRYPT);
    }

    public function HashVerify($password)
    {
        return password_verify($password, $this->users_password);
    }

    public function ValidateEmail()
    {
        if(!$this->users_email)
        {
            self::$alerts['errors'][] = 'El correo es requerido';
        }
        return self::$alerts;
    }

    public function PasswordConfirm($password)
    {
        if(!$this->users_password || $this->users_password != $password)
        {
            self::$alerts['errors'][] = 'Las contraseñas no coinciden';
        }elseif(strlen($this->users_password) < 8)
        {
            self::$alerts['errors'][] = 'El password debe contener al menos 8 caracteres';
        }
        return self::$alerts;
    }

    public function CreateToken()
    {
        $this->users_token = uniqid();
    }
}