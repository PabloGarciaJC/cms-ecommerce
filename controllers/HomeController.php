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

        // // Obtengo los Productos por Categoria Id
        $mostrarProductoPorCategoria = Utils::obtenerCategoriaPorId($idCategoria);

        // Obtengo Marca, Sin Repetir en el Sidebar
        $mostrarMarcaSinRepetirSidebar = Utils::mostrarMarcaSinRepetirSidebar($idCategoria);

        // Obtengo Memoria Ram o Capacidad, Sin Repetir en el Sidebar
        $mostrarMemoriaRamSinRepetirSidebar = Utils::mostrarMemoriaRamSinRepetirSidebar($idCategoria);

        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/slider.php';
        require_once 'views/home/contentIndex.php';
        require_once 'views/layout/footer.php';
        
    }

    // public function electronica()
    // {
    //     //Obtengo Ususario en el Banner
    //     $usuario = Utils::obtenerUsuario();
    //     //Obtengo Categorias en la Barra de Navegacion
    //     $categoriaBarraNavegacion = Utils::listaCategorias();
    //     require_once 'views/layout/header.php';
    //     require_once 'views/layout/banner.php';
    //     require_once 'views/layout/nav.php';
    //     require_once 'views/layout/search.php';
    //     require_once 'views/home/contentElectronics.php';
    //     require_once 'views/layout/footer.php';
    // }

    // public function accesorios()
    // {
    //     //Obtengo Ususario en el Banner
    //     $usuario = Utils::obtenerUsuario();
    //     //Obtengo Categorias en la Barra de Navegacion
    //     $categoriaBarraNavegacion = Utils::listaCategorias();
    //     require_once 'views/layout/header.php';
    //     require_once 'views/layout/banner.php';
    //     require_once 'views/layout/nav.php';
    //     require_once 'views/layout/search.php';
    //     require_once 'views/home/contentAppliances.php';
    //     require_once 'views/layout/footer.php';
    // }

    public function sobreNosotros()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
