<?php

require 'includes/funciones.php';


$servicios = obtenerDatos();

echo json_encode($servicios);