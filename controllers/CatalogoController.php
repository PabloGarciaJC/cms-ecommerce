<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'model/pedidos.php';
require_once 'model/lineaPedidos.php';
require_once 'model/paises.php';
require_once 'controllers/LanguageController.php';

class CatalogoController
{
  private $languageController;

  public function __construct()
  {
    $this->languageController = new LanguageController();
  }

  private function cargarDatosComunes()
  {
    // Obtener el usuario actual
    $usuario = Utils::obtenerUsuario();

    // Instanciar los modelos necesarios
    $categorias = new Categorias();
    $producto = new Productos();

    // Obtener todos los idiomas disponibles para el selector de idioma en el header
    $idiomas = new Idiomas();
    $getIdiomas = $idiomas->obtenerTodos();

    // Establecer el idioma si se envió un valor desde el formulario
    if (isset($_POST['lenguaje'])) {
      $this->languageController->setIdioma($_POST['lenguaje']);
    }

    // Cargar los textos del idioma seleccionado
    $this->languageController->cargarTextos();

    // Establecer el idioma en los modelos de Categorías y Productos
    $idiomaId = $this->languageController->getIdiomaId();
    $categorias->setIdioma($idiomaId);
    $producto->setIdioma($idiomaId);

    // Obtener el id del parent de la categoría si está presente en la URL
    $parentId = isset($_GET['parent_id']) ? $_GET['parent_id'] : false;

    // Obtener las categorías y productos del catálogo
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

    // Obtener los breadcrumbs (migas de pan) de la categoría actual
    $categorias->setParentId($parentId);
    $categorias->setId($parentId);
    $breadcrumbs = $categorias->getBreadcrumbs();

    // Obtener los productos filtrados por categoría, búsqueda y rango de precios
    $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;
    $textoBusqueda = isset($_GET['textoBusqueda']) ? $_GET['textoBusqueda'] : false;
    $minPrecio = isset($_GET['minPrecio']) ? $_GET['minPrecio'] : false;
    $maxPrecio = isset($_GET['maxPrecio']) ? $_GET['maxPrecio'] : false;

    // Obtener categorías y productos filtrados
    $getCategorias = $categorias->obtenerCategoriasYProductosFronted($minPrecio, $maxPrecio, $textoBusqueda);

    // Retornar los datos que serán utilizados en la vista
    return compact('usuario', 'categoriasConSubcategoriasYProductos', 'getIdiomas', 'breadcrumbs', 'getCategorias');
  }

  public function index()
  {
    // Extraer los datos comunes para la vista
    extract($this->cargarDatosComunes());

    // Incluir las vistas necesarias para el catálogo
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/search.php';
    require_once 'views/catalogo/index.php';
    require_once 'views/layout/footer.php';
  }
}
