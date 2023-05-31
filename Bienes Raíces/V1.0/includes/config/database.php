<?php

function conectarDB() : mysqli
{
    $db = new mysqli('localhost', 'root', 'admin', 'bienes_raices');
    mysqli_set_charset($db, 'utf8');

    if($db === FALSE)
    {
        echo("Error fatal al conectarse a la base de datos");
        exit;
    }

    return $db;
}