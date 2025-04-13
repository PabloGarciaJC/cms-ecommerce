<?php

namespace controllers;

use model\Productos;
use model\Categorias;
use model\Pedidos;
use model\Paises;
use model\Comentario;
use model\Idiomas;
use helpers\Utils;
use controllers\LanguageController;

class ProductoController
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

        // Obtener todos los idiomas disponibles
        $idiomas = new Idiomas();
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

    public function ficha()
    {
        extract($this->cargarDatosComunes());

        $usuario = Utils::obtenerUsuario();

        $producto = new Productos();
        $grupoId = isset($_GET['grupo_id']) ? $_GET['grupo_id'] : false;

        // Establecer el idioma para el producto
        $producto->setIdioma($this->languageController->getIdiomaId());

        // Ficha de producto
        $producto->setUsuario($usuario);
        $producto->setGrupoId($grupoId);
        $productoFicha = $producto->obtenerProductosPorId();

        // Comentarios del producto
        $comentarios = new Comentario();

        $comentariosValorados = $comentarios->obtenerComentariosValorados($productoFicha->grupo_id);
        $obtenerComentariosMenorCalificacion = $comentarios->obtenerComentariosMenosValorados($productoFicha->grupo_id);
        $promedioCalificacion = $comentarios->obtenerPromedioCalificacion($productoFicha->grupo_id);

        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/producto/ficha.php';
        require_once 'views/layout/footer.php';
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
