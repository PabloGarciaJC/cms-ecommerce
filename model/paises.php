<?php

class Paises
{

  private $id;
  private $pais;
  private $db;

  /// CONSTRUCTOR ///
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


  public function obtenerPaisActual()
  {
    $sql = "SELECT * FROM paises where id = '{$this->getPais()}'";
    $paises = $this->db->query($sql);
    return $paises->fetch_object();
  }
}
