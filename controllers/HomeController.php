<?php

require_once 'model/productos.php';

class HomeController
{
    public function index()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        // Obtengo el Id de Producto por Categoria
        $idCategoria = isset($_GET['producto']) ? $_GET['producto'] : false;
        // Obtengo los Productos por Categoria Id
        $mostrarProductoPorCategoria = Utils::obtenerCategoriaPorId($idCategoria);
        // Obtengo Marca, Sin Repetir en el Sidebar
        $mostrarMarcaSinRepetirSidebar = Utils::mostrarMarcaSinRepetirSidebar($idCategoria);
        // Obtengo Memoria Ram o Capacidad, Sin Repetir en el Sidebar
        $mostrarMemoriaRamSinRepetirSidebar = Utils::mostrarMemoriaRamSinRepetirSidebar($idCategoria);
        // Consulta Para Autocompletar
        $listado  =  Utils::listarAutocompletado();
        // Mosrar listar de Autocompletado
        $jsonMostrar = Utils::mostrarAutocompletado($listado);
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/slider.php';
         require_once 'views/home/body.php';
        require_once 'views/layout/footer.php';
    }

    public function sobreNosotros()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';  
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
