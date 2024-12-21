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
    $usuario = Utils::obtenerUsuario();
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/search.php';


    require_once 'views/layout/footer.php';
  }


}
