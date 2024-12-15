<?php

require_once 'model/productos.php';

class HomeController
{
    public function index()
    {
        $usuario = Utils::obtenerUsuario();
        $categoriaBarraNavegacion = Utils::listaCategorias();
        $idCategoria = isset($_GET['producto']) ? $_GET['producto'] : false;
        $mostrarProductoPorCategoria = Utils::obtenerCategoriaPorId($idCategoria);
        $listado  =  Utils::listarAutocompletado();
        $jsonMostrar = Utils::mostrarAutocompletado($listado);
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/slider.php';
        require_once 'views/home/body.php';
        require_once 'views/layout/footer.php';
    }

    public function lang()
    {

        $usuario = Utils::obtenerUsuario();

        // Capturar el idioma seleccionado desde el formulario
        $lang = isset($_GET['lenguaje']) ? $_GET['lenguaje'] : false;

        // Validar y almacenar el idioma en la sesión
        if ($lang) {
            $_SESSION['lang'] = $lang;
        } elseif (!isset($_SESSION['lang'])) {
            // Si no hay idioma definido en la sesión, asignar 'es' como predeterminado
            $_SESSION['lang'] = 'es';
        }

        // Cargar el archivo de idioma según la selección
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

        // Capturar la URL de redirección (si está definida)
        // $redirect_url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : BASE_URL;

        // require_once 'views/layout/head.php';
        // require_once 'views/layout/header.php';
        // require_once 'views/home' . $redirect_url;
        // require_once 'views/layout/footer.php';

        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/slider.php';
        require_once 'views/home/body.php';
        require_once 'views/layout/footer.php';
    }





    public function nosotros()
    {
        $usuario = Utils::obtenerUsuario();
        // $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/nosotros.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        // $usuario = Utils::obtenerUsuario();
        // $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/contacto.php';
        require_once 'views/layout/footer.php';
    }
}
