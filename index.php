<?php

ob_start();
session_start();

## ---------------------------------------------------------
## Cargar de Idiomas
## ---------------------------------------------------------

$lang = isset($_GET['lenguaje']) ? $_GET['lenguaje'] : false;

if ($lang) {
    $_SESSION['lang'] = $lang;
} elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'es';
}

switch ($_SESSION['lang']) {
    case 'en':
        require_once 'lenguajes/ingles.php';
        break;
    case 'fr':
        require_once 'lenguajes/frances.php';
        break;
    case 'de':
        require_once 'lenguajes/aleman.php';
        break;
    case 'it':
        require_once 'lenguajes/italiano.php';
        break;
    case 'pt':
        require_once 'lenguajes/portugues.php';
        break;
    case 'zh':
        require_once 'lenguajes/chino.php';
        break;
    case 'jp':
        require_once 'lenguajes/japones.php';
        break;
    default:
        require_once 'lenguajes/espanol.php';
}

## ---------------------------------------------------------
## Cargar variables de entorno
## ---------------------------------------------------------

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
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
