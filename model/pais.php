<?php

class Pais
{

  private $id;
  private $pais;

  ///CONSTRUCTOR///
  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTER //// 
  public function getId()
  {
    return $this->id;
  }

  public function getPais()
  {
    return $this->pais;
  }

  //// SETTER //// 
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  //// CONSULTA //// 

  public function obtenerTodosPaises()
  {
    $resultado = false;
    $sql = "SELECT * FROM paises";
    $paises = $this->db->query($sql);
    return $paises;
  }
}
