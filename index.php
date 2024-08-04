<?php

ob_start(); 
session_start();

## ---------------------------------------------------------
## Cargar variables de entorno
## ---------------------------------------------------------

require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();

## ---------------------------------------------------------
## Incluir archivos de configuración y librerías
## ---------------------------------------------------------

require_once 'autoload.php';
require_once 'config/includes.php';
require_once 'helpers/utils.php';

## ---------------------------------------------------------
## Controlador Frontal
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
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador; 
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
?>