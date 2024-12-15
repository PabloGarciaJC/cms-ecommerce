<?php

require_once 'model/productos.php';

class ProductoController
{
  public function descripcion()
  {
    $idProducto = isset($_GET['id']) ? $_GET['id'] : false;
    $usuario = Utils::obtenerUsuario();
    $categoriaBarraNavegacion = Utils::listaCategorias();
    $idProducto = Utils::obtenerProductosPorId($idProducto);
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/producto/descripcion.php';
    require_once 'views/layout/footer.php';
  }
};
