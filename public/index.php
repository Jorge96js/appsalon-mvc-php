<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\ServicioController;
use MVC\Router;
use Controllers\LoginController;

$router = new Router();

//Iniciar sesion
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);



//Recuperar password
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar-cuenta',[LoginController::class, 'recuperar']);
$router->post('/recuperar-cuenta',[LoginController::class, 'recuperar']);

//Crear cuenta
$router->get('/crear-cuenta',[LoginController::class, 'crear']);
$router->post('/crear-cuenta',[LoginController::class, 'crear']);


//Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class,'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//Api de citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/cita', [APIController::class, 'guardar']);

//Area privada
$router->get('/cita', [CitaController::class,'index']);
$router->get('/admin', [AdminController::class,'index']);

$router->post('/api/eliminar',[APIController::class, 'eliminar']);

//crud servicios
$router->get('/servicios',[ServicioController::class, 'index']);

$router->get('/crear',[ServicioController::class, 'crear']);
$router->post('/crear',[ServicioController::class, 'crear']);

$router->get('/servicios/actualizar',[ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar',[ServicioController::class, 'actualizar']);

$router->post('/servicios/eliminar',[ServicioController::class, 'eliminar']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();