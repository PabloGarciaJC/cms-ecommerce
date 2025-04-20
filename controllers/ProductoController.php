<?php

namespace controllers;

use model\Productos;
use model\Categorias;
use model\Comentario;
use model\Idiomas;
use helpers\Utils;
use controllers\LanguageController;

class ProductoController
{
    private $languageController;
    private $idiomas;

    public function __construct(?LanguageController $languageController = null, ?Idiomas $idiomas = null)
    {
        $this->languageController = $languageController ?? new LanguageController();
        $this->idiomas = $idiomas ?? new Idiomas();
    }

    private function cargarDatosComunes()
    {
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();

        // Obtener todos los idiomas disponibles
        $idiomas = $this->idiomas;
        $getIdiomas = $idiomas->obtenerTodos();

        // Establecer el idioma
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }

        // Cargar los textos según el idioma seleccionado
        $this->languageController->cargarTextos();

        // Establecer el idioma a utilizar en Categorias
        $categorias->setIdioma($this->languageController->getIdiomaId());

        // Obtener las categorías y productos
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

        return compact('usuario', 'categoriasConSubcategoriasYProductos', 'getIdiomas');
    }

    public function ficha(?Productos $productos = null, ?Comentario $Comentario = null)
    {
        extract($this->cargarDatosComunes());

        $producto = $productos ?? new Productos();
        $producto->setIdioma($this->languageController->getIdiomaId());
        $producto->setUsuario(Utils::obtenerUsuario());
        $producto->setGrupoId(isset($_GET['grupo_id']) ? $_GET['grupo_id'] : false);
        $productoFicha = $producto->obtenerProductosPorId();

        // Comentarios del producto
        $comentarios = $Comentario ?? new Comentario();

        $comentariosValorados = $comentarios->obtenerComentariosValorados($productoFicha->grupo_id);
        $obtenerComentariosMenorCalificacion = $comentarios->obtenerComentariosMenosValorados($productoFicha->grupo_id);
        $promedioCalificacion = $comentarios->obtenerPromedioCalificacion($productoFicha->grupo_id);

        if (!defined('PHPUNIT_RUNNING')) {
            require_once 'views/layout/head.php';
            require_once 'views/layout/header.php';
            require_once 'views/layout/search.php';
            require_once 'views/producto/ficha.php';
            require_once 'views/layout/footer.php';
        }
    }

    public function moviles()
    {
        $producto = new Productos();
        $usuario = Utils::obtenerUsuario();
        $producto->setUsuario($usuario);
        $producto->setIdioma($this->languageController->getIdiomaId());
        $productos = $producto->movil();
        require 'views/producto/lista.php';
    }

    public function tvAudios()
    {
        $producto = new Productos();
        $usuario = Utils::obtenerUsuario();
        $producto->setUsuario($usuario);
        $producto->setIdioma($this->languageController->getIdiomaId());
        $productos = $producto->tvAudios();
        require 'views/producto/lista.php';
    }

    public function electrodomesticos()
    {
        $producto = new Productos();
        $usuario = Utils::obtenerUsuario();
        $producto->setUsuario($usuario);
        $producto->setIdioma($this->languageController->getIdiomaId());
        $productos = $producto->electrodomesticos();
        require 'views/producto/lista.php';
    }
}
