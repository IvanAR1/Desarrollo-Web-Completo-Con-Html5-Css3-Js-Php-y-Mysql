<?php 

require_once __DIR__ .  '/../includes/app.php';

use MVC\Route;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PagesController;
use Controllers\LoginController;

$router = new Route();

//Rutas GET
$router->get('/', [PagesController::class, 'index']);
$router->get('/nosotros', [PagesController::class, 'nosotros']);
$router->get('/anuncios', [PagesController::class, 'anuncios']);
$router->get('/anuncio', [PagesController::class, 'anuncio']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/entrada', [PagesController::class, 'entrada']);
$router->get('/contacto', [PagesController::class, 'contacto']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/admin', [PropiedadController::class, 'index']);

$router->get('/propiedades/crear', [PropiedadController::class, 'create']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'update']);

$router->get('/vendedores/crear', [VendedorController::class, 'create']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'update']);

//Rutas POST
$router->post('/contacto', [PagesController::class, 'contacto']);

$router->post('/propiedades/crear', [PropiedadController::class, 'create']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'update']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'delete']);

$router->post('/vendedores/crear', [VendedorController::class, 'create']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'update']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'delete']);


$router->validate();