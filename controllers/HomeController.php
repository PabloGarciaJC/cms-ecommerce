<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'controllers/ProductoController.php';

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
        // $datos = $this->cargarDatosComunes();
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        $producto = new ProductoController();
        require_once 'views/home/slider.php';
        require_once 'views/home/body.php';
        require_once 'views/layout/footer.php';
    }

    public function nosotros()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/nosotros.php';
        require_once 'views/layout/footer.php';
    }

    public function help()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/help.php';
        require_once 'views/layout/footer.php';
    }

    public function faqs()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/faqs.php';
        require_once 'views/layout/footer.php';
    }

    public function term()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/term.php';
        require_once 'views/layout/footer.php';
    }

    public function privacy()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/privacy.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        $this->idiomas();
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/contacto.php';
        require_once 'views/layout/footer.php';
    }
}
