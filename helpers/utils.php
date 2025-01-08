<?php

class Utils
{

  public static function accesoUsuarioRegistrado()
  {
    if (!isset($_SESSION['usuarioRegistrado'])) {
      header("Location:" . BASE_URL);
    }
  }

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

  public static function obtenerPaisActual($paisActual)
  {
    require_once 'model/paises.php';
    $paisesActual = new Paises();
    $paisesActual->setPais($paisActual);
    $queryPaisActual = $paisesActual->obtenerPaisActual();
    return $queryPaisActual;
  }

  public static function obtenerEstrellas($idGrupo)
    {
        require_once 'model/comentario.php';
        $comentario = new Comentario();
        $promedio = $comentario->obtenerPromedioCalificacion($idGrupo);
        $calificacion = round($promedio);
        $html = '';
        for ($i = 1; $i <= 5; $i++) {
            $html .= $i <= $calificacion ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
        }
        return $html;
    }
};
