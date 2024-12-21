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
    $usuario = Utils::obtenerUsuario();
    $categorias = new Categorias();
    $categorias->setId($categoriaId);
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();


    $getCategorias = $categorias->otenerSubcategorias();

    $breadcrumbs = $categorias->getBreadcrumbs();
    
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/search.php';
    require_once 'views/catalogo/index.php';
    require_once 'views/layout/footer.php';
  }


}
