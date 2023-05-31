<?php 

require_once __DIR__ . '/../includes/app.php';

use Router\Router;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;

$router = new Router();

$router->get('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/forgout', [LoginController::class, 'forgout']);
$router->get('/rescue', [LoginController::class, 'rescue']);
$router->get('/signup', [LoginController::class, 'register']);
$router->get('/validate-user', [LoginController::class, 'validateUser']);
$router->get('/index',[CitaController::class, 'index']);
$router->get('/test',[CitaController::class, 'test']);

$router->prefix('/api',function($router)
{
    $router->post('/login', [LoginController::class, 'login']);
    $router->post('/forgout', [LoginController::class, 'forgout']);
    $router->post('/signup', [LoginController::class, 'register']);
    $router->put('/rescue', [LoginController::class, 'rescue']);
    $router->get('/services',[APIController::class, 'index']);
});

// Check and validate the routes, which excite and assign them the functions of the Controller
$router->dispatch();