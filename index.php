<?php

ob_start();
session_start();

## ---------------------------------------------------------
## Cargar dependencias y configuraciones
## ---------------------------------------------------------

require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
use controllers\ErrorController;

## ---------------------------------------------------------
## Cargar variables de entorno
## ---------------------------------------------------------

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

## ---------------------------------------------------------
## Controlador Frontal
## ---------------------------------------------------------

define("ACTION_DEFAULT", "index"); 
define("BASE_URL", $_ENV['BASE_URL_PROJECT']); 
define("CONTROLLER_DEFAULT", "HomeController");

## ---------------------------------------------------------
## Verificar el controlador y la acción a ejecutar (Dinamico)
## ---------------------------------------------------------

if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = CONTROLLER_DEFAULT;
} else {
    $error = new ErrorController();
    $error->index();
    exit();
}

## ---------------------------------------------------------
## Verificar si la clase del controlador existe (Por Defecto)
## ---------------------------------------------------------

$nombre_controlador_completo = "controllers\\" . $nombre_controlador;

if (class_exists($nombre_controlador_completo)) {
    $controlador = new $nombre_controlador_completo;    
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $ACTION_DEFAULT = ACTION_DEFAULT;
        $controlador->$ACTION_DEFAULT();
    } else {
        $error = new ErrorController();
        $error->index();
    }
} else {
    $error = new ErrorController();
    $error->index();
}
ob_end_flush();
