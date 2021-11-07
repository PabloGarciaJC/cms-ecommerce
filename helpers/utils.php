<?php

class Utils
{
  //muestro errores modal
  public static function setearMensajeError($idMensaje, $mensajeError)
  {
    return "<script>document.getElementById('$idMensaje').innerHTML='<strong>Error,</strong> $mensajeError';</script>";
  }

  //compruebo que el usuario Exista !!, para evitar ingresar a los metodos del controlador.
  public static function accesoUsuarioRegistrado()
  {
    if (!isset($_SESSION['usuarioRegistrado'])) {
      header("Location:" . base_url);
    }
  }

  //borrar errores del formulario palen administrativo
  public static function borrarSesionErrores()
  {
    $_SESSION['errores'] = null;
    $_SESSION['repoblarInputs'] = null;
    $_SESSION['actualizadoCompleto'] = null;
  }

  //mostrar mensajes de errores formulario 
  public static function erroresValidacion($error, $mensaje)
  {
    return "<strong>$error,</strong> " . $mensaje;
  }


  //El Objeto Usuario Esta  Disponible en toda la Pagina 
  //"Lo Necesito para Mostrar el Nombre en el Banner"
  public static function obtenerUsuario()
  {
    require_once 'model/usuario.php';
    if (isset($_SESSION['usuarioRegistrado']->Id)) {
      $obtenertodos = new usuario;
      $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
      $usuarioPorId = $obtenertodos->obtenerTodosPorId();
      return $usuarioPorId;
    }
  }

  //El Objeto Usuario Esta  Disponible en toda la Pagina 
  //"Lo Necesito para Mostrar el Nombre en el Banner"
  public static function obtenerUsuarioSinModelo()
  {
    if (isset($_SESSION['usuarioRegistrado']->Id)) {
      if (isset($_SESSION['usuarioRegistrado']->Id)) {
        $obtenertodos = new usuario;
        $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
        $usuario = $obtenertodos->obtenerTodosPorId();
        return $usuario;
      }
    }
  }

  public static function listaCategorias()
  {
    require_once 'model/categorias.php';
    $categorias = new categorias;
    $categoria = $categorias->obtenerCategorias();
    return $categoria;
  }

  public static function obtenerProductos()
  {
    $productos = new productos;
    $mostrar = $productos->obtenerTodos();
    return $mostrar;
  }

  public static function obtenerProductosyBuscador($buscador)
  {
    $productos = new productos;
    $productos->setBuscador($buscador);
    $mostrar = $productos->obtenerProductosyBuscador();
    return $mostrar;
  }

  public static function obtenerProductosYPaginador($ultimoRegistro,$mostrarRegistros)
  {
    $productos = new productos;
    $mostrar = $productos->obtenerTodosYPaginacion($ultimoRegistro, $mostrarRegistros);
    return $mostrar;
  }

  public static function obtenerProductosPorId($id)
  {
    $productos = new productos;
    $productos->setId($id);
    $mostrar = $productos->productosPorId();
    return $mostrar->fetch_object();
  }

  public static function obtenerImagenProductoPorId()
  {
    require_once 'model/productos.php';
    $productos = new productos;
    $mostrar = $productos->obtenerTodos();
    $obtenerImagen = $mostrar->fetch_object();
    $completado = $obtenerImagen->imagen;
    return $completado;
  }

  public static function obtenerPaises()
  {
    require_once 'model/paises.php';
    $paises = new Paises();
    $paisesTodos = $paises->obtenerTodosPaises();
    return $paisesTodos;
  }

  public static function obtenerRegistrosTotales()
  {
    require_once 'model/productos.php';
    $productos = new productos;
    $mostrarTodos = $productos->obtenerRegistrosTotales();
    return $mostrarTodos;
  }
  
}
