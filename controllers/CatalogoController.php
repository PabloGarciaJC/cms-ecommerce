<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'model/categorias.php';
require_once 'model/pedidos.php';
require_once 'model/lineaPedidos.php';
require_once 'model/paises.php';

class CatalogoController extends HomeController
{
  public function index()
  {
    $this->idiomas();
    $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;
    $searchCategoriaId = isset($_GET['searchCategoriaId']) ? $_GET['searchCategoriaId'] : false;
    $minPrecio = isset($_GET['minPrecio']) ? $_GET['minPrecio'] : false;
    $maxPrecio = isset($_GET['maxPrecio']) ? $_GET['maxPrecio'] : false;
    $textoBusqueda = isset($_GET['textoBusqueda']) ? $_GET['textoBusqueda'] : false;

    $usuario = Utils::obtenerUsuario();
    $categorias = new Categorias();

    // Menu de Navegacion
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

    // Realizar busqueda por Filtro en Subategorias
    if ($searchCategoriaId) {
      $categorias->setId($searchCategoriaId);
    } else {
      $categorias->setId($categoriaId);
    }

    // Realizar búsqueda por texto si se ha ingresado
    if ($textoBusqueda) {
      echo 'existe texto';
      $getCategorias = $categorias->buscarProductosPorTexto($textoBusqueda, $minPrecio, $maxPrecio);
    } else {
      echo 'no existe texto';
      $getCategorias = $categorias->obtenerSubcategorias($minPrecio, $maxPrecio);
    }

    // Mostrar breadcrumbs
    $breadcrumbs = $categorias->getBreadcrumbs();

    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/search.php';
    require_once 'views/catalogo/index.php';
    require_once 'views/layout/footer.php';
  }
}
