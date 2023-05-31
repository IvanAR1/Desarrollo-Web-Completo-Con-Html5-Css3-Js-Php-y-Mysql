<?php 

$db = mysqli_connect('localhost', 'example', 'password', 'database');

if(!$db)
{
    echo "Error";
}/* else
{
    echo "Bienvenido";
} */