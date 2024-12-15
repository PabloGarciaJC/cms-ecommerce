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

    public function sobreNosotros()
    {
        $usuario = Utils::obtenerUsuario();
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        $usuario = Utils::obtenerUsuario();
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';  
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
