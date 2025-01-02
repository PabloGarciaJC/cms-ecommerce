<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'model/categorias.php';
require_once 'model/pedidos.php';
require_once 'model/lineaPedidos.php';
require_once 'model/paises.php';

class CatalogoController extends HomeController
{

  private function cargarDatosComunes()
  {
    $usuario = Utils::obtenerUsuario();

    $idiomas = new Idiomas();
    $getIdiomas = $idiomas->obtenerTodos();
    $lang = isset($_POST['lenguaje']) ? $_POST['lenguaje'] : false;

    $producto = new Productos();
    $parentId = isset($_GET['parent_id']) ? $_GET['parent_id'] : false;

    $categorias = new Categorias();

    if ($lang) {
      $_SESSION['lang'] = $lang;
    } elseif (!isset($_SESSION['lang'])) {
      $_SESSION['lang'] = 'es';
    }

    // Carga el archivo del idioma según la selección
    switch ($_SESSION['lang']) {
      case 'en':
        require_once 'lenguajes/ingles.php';
        $categorias->setIdioma(2);
        $producto->setIdioma(2);
        break;
      case 'fr':
        require_once 'lenguajes/frances.php';
        $categorias->setIdioma(3);
        $producto->setIdioma(3);
        break;
      default:
        require_once 'lenguajes/espanol.php';
    }

    // Menu de categorias
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

    // Mostrar breadcrumbsFonted
    $categorias->setParentId($parentId);
    $categorias->setId($parentId);
    $breadcrumbs = $categorias->getBreadcrumbs();

    // Obetener Productos por categorias
    $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;
    $textoBusqueda = isset($_GET['textoBusqueda']) ? $_GET['textoBusqueda'] : false;
    $minPrecio = isset($_GET['minPrecio']) ? $_GET['minPrecio'] : false;
    $maxPrecio = isset($_GET['maxPrecio']) ? $_GET['maxPrecio'] : false;
    $getCategorias = $categorias->obtenerCategoriasYProductosFronted($minPrecio, $maxPrecio, $textoBusqueda);
    return compact('usuario', 'categoriasConSubcategoriasYProductos', 'getIdiomas', 'breadcrumbs', 'getCategorias');
  }

  public function index()
  {
    extract($this->cargarDatosComunes());
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/search.php';
    require_once 'views/catalogo/index.php';
    require_once 'views/layout/footer.php';
  }
}
