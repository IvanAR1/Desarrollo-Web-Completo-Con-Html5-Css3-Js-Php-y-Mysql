<?php

function obtenerDatos() : array
{
    try {
        //Importar una conexión
        require 'database.php';
        //Escribir el código SQL
        $sql = 'SELECT * FROM servicios';

        $consulta = mysqli_query($db, $sql);
        
        //arreglos
        $servicios = [];

        $i = 0;
        //Obtener los resultados
       while ($row = mysqli_fetch_assoc($consulta))
       {    
           $servicios[$i]['ID'] = $row['ID'];
           $servicios[$i]['Nombre'] = $row['Nombre'];
           $servicios[$i]['Precio'] = $row['Precio'];

           $i++;
       }
       /* echo "<pre>";
       var_dump(json_encode($servicios));
       echo "</pre>"; */

       return $servicios;

    } catch (\Throwable $th) {
        //throw $th;

        var_dump($th);
    }
}

obtenerDatos();
