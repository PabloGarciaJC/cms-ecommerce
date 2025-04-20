<?php

namespace controllers;

use model\Productos;
use model\Categorias;
use controllers\ProductoController;
use model\Idiomas;
use controllers\LanguageController;
use helpers\Utils;

class HomeController
{
    private $languageController;

    public function __construct()
    {
        $this->languageController = new LanguageController();
    }

    private function cargarDatosComunes()
    {
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();

        // Obtenemos los idiomas disponibles para el select del header
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();

        // Establecemos el idioma utilizando el LanguageController
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }

        // Cargar los textos según el idioma seleccionado
        $this->languageController->cargarTextos();

        // Establecemos el idioma a utilizar en Categorias
        $categorias->setIdioma($this->languageController->getIdiomaId());

        // Obtenemos las categorías con productos y subcategorías
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

        return compact('usuario', 'categoriasConSubcategoriasYProductos', 'getIdiomas');
    }

    public function index()
    {
        extract($this->cargarDatosComunes());
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
        extract($this->cargarDatosComunes());
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/nosotros.php';
        require_once 'views/layout/footer.php';
    }

    public function help()
    {
        extract($this->cargarDatosComunes());
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/help.php';
        require_once 'views/layout/footer.php';
    }

    public function faqs()
    {
        extract($this->cargarDatosComunes());
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/faqs.php';
        require_once 'views/layout/footer.php';
    }

    public function term()
    {
        extract($this->cargarDatosComunes());
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/term.php';
        require_once 'views/layout/footer.php';
    }

    public function privacy()
    {
        extract($this->cargarDatosComunes());
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/privacy.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        extract($this->cargarDatosComunes());
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contacto.php';
        require_once 'views/layout/footer.php';
    }

    public function guardarFormulario() {
        extract($this->cargarDatosComunes());
        $formulario = isset($_GET['formulario']) ? $_GET['formulario'] : false;
        if ($formulario) {
            echo json_encode([
                'titulo' => TEXT_FORM_DISABLED_TITLE,
                'success' => true,
                'message' => TEXT_FORM_DISABLED_MESSAGE,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
        }
    }
    
}
