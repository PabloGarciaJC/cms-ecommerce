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


  public static function obtenerCategoriasTodasNav()
  {
    require_once 'model/categorias.php';
    $categorias = new categorias;
    $listarCategoria = $categorias->obtenerCategorias();
    return $listarCategoria;
  }
}
