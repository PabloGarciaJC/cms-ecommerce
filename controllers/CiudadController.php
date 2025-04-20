<?php

namespace controllers;

use model\Ciudades;

class CiudadController
{
  public function obtenerTodos()
  {
    $codigoPais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $ciudad = new Ciudades();
  
    $ciudad->setIdPais($codigoPais);
    $filas = $ciudad->obtenerTodasCiudades();
    
    while ($fila = mysqli_fetch_array($filas)) {
      echo "<option value=" . $fila['Ciudad'] . ">" . $fila['Ciudad'] . "</option>";
    }
  }
}
