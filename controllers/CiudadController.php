<?php
require_once 'model/ciudad.php';

class CiudadController
{
  public function obtenerTodos()
  {
    $codigoPais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $ciudad = new Ciudad();
    $ciudad->setIdPais($codigoPais);

    $filas = $ciudad->obtenerTodasCiudades();

    while ($fila = mysqli_fetch_array($filas)) {
      echo "<option value=" . $fila['Ciudad'] . ">" . $fila['Ciudad'] . "</option>";
    }
  }
}
