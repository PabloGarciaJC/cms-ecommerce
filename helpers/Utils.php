<?php

namespace helpers;

use model\Usuario;
use model\Paises;
use model\Comentario;

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
    if (isset($_SESSION['usuarioRegistrado']->Id)) {
      $obtenertodos = new usuario;
      $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
      $usuarioPorId = $obtenertodos->obtenerTodosPorId();
      return $usuarioPorId;
    }
  }

  public static function obtenerPaisActual($paisActual)
  {
    $paisesActual = new Paises();
    $paisesActual->setPais($paisActual);
    $queryPaisActual = $paisesActual->obtenerPaisActual();
    return $queryPaisActual;
  }

  public static function obtenerEstrellas($idGrupo)
  {
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
