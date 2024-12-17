<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'controllers/HomeController.php';

class ProductoController extends HomeController
{
  public function ficha()
  {
    $this->idiomas();
    $idProducto = isset($_GET['id']) ? $_GET['id'] : false;
    $usuario = Utils::obtenerUsuario();
    $producto = new Productos();
    $producto->setId($idProducto);
    $productoFicha = $producto->obtenerProductosPorId();
    $categorias = new Categorias();
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/producto/ficha.php';
    require_once 'views/layout/footer.php';
  }

  public function moviles()
  {
    $probject = new Productos();
    $productos = $probject->movil();
    require 'views/producto/lista.php';
  }

  public function tvAudios()
  {
    $probject = new Productos();
    $productos = $probject->tvAudios();
    require 'views/producto/lista.php';
  }

  public function accesorios()
  {
    $probject = new Productos();
    $productos = $probject->accesorios();
    require 'views/producto/lista.php';
  }
}
