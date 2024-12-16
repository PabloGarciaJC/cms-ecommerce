<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';

class HomeController
{

    public function idiomas()
    {
        $lang = isset($_POST['lenguaje']) ? $_POST['lenguaje'] : false;

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
            default:
                require_once 'lenguajes/espanol.php';
        }
    }

    public function index()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();


        $categorias = new Categorias();
        $getCategorias = $categorias->obtenerCategorias();

        var_dump($getCategorias);


        // $categoriaBarraNavegacion = Utils::listaCategorias();
        // $idCategoria = isset($_GET['producto']) ? $_GET['producto'] : false;
        // $mostrarProductoPorCategoria = Utils::obtenerCategoriaPorId($idCategoria);
        // $listado  =  Utils::listarAutocompletado();
        // $jsonMostrar = Utils::mostrarAutocompletado($listado);
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/slider.php';
        require_once 'views/home/body.php';
        require_once 'views/layout/footer.php';
    }

    public function nosotros()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/nosotros.php';
        require_once 'views/layout/footer.php';
    }

    public function help()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/help.php';
        require_once 'views/layout/footer.php';
    }

    public function faqs()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/faqs.php';
        require_once 'views/layout/footer.php';
    }

    public function term()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/term.php';
        require_once 'views/layout/footer.php';
    }

    public function privacy()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/privacy.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/contacto.php';
        require_once 'views/layout/footer.php';
    }
}
