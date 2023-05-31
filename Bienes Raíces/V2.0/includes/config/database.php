<?php

    use Dotenv\Dotenv;

    function conectarDB() : mysqli
    {
        $dotenv = Dotenv::createImmutable('..');
        $dotenv->load();
        $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
        mysqli_set_charset($db, 'utf8');
        if($db === FALSE)
        {
            echo("Error fatal al conectarse a la base de datos");
            exit;
        }

        return $db;
    }