<?php
require_once 'model/categorias.php';

class CategoriaController
{
  public function gestionarCategorias()
  {
    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();
    //Obtengo Ususario en el Banner
    $usuario = Utils::obtenerUsuario();
    //Imprimo Lista Categoria
    $categorias = new categorias;
    $categoria = $categorias->obtenerCategorias();
    //Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = $categorias->obtenerCategoriasNav();
    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/categoria/listar.php';
    require_once 'views/layout/footer.php';
  }

  public function editar()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
    $categorias = new categorias;
    $categorias->setId($id);
    $categorias->setCategorias($categoria);
    // errores 
    $errores = array();
    if (empty(trim($categoria))) {
      $errores['categoria'] = Utils::erroresValidacion('Error', 'Ingresé Categoria');
    }
    if (count($errores) == 0) {
      //consulta
      $categorias->actualizarCategoriaPorId();
      echo 1;
    }
  }

  public function eliminar()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $categorias = new categorias;
    $categorias->setId($id);
    //consulta
    $eliminar = $categorias->eliminar();
    if ($eliminar) {
      echo 1;
    } else {
      true;
    }
  }

  public function listar()
  {
    $categoria = isset($_POST['listarCategoria']) ? $_POST['listarCategoria'] : false;
    $categorias = new categorias;
    $categorias->setCategorias($categoria);
    $listarCategoria = $categorias->crearLista();
    if ($listarCategoria) {
      echo 1;
    }
  }
}
