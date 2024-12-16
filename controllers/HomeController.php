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

    public function nosotros()
    {
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/nosotros.php';
        require_once 'views/layout/footer.php';
    }

    public function help()
    {
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/help.php';
        require_once 'views/layout/footer.php';
    }

    public function faqs()
    {
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/faqs.php';
        require_once 'views/layout/footer.php';
    }

    public function term()
    {
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/term.php';
        require_once 'views/layout/footer.php';
    }

    public function privacy()
    {
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/privacy.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        $usuario = Utils::obtenerUsuario();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/contacto.php';
        require_once 'views/layout/footer.php';
    }
}
