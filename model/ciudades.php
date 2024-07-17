<?php

class Ciudades
{

  private $id;
  private $idPais;
  private $ciudad;
  private $db;

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

  public function getIdPais()
  {
    return $this->idPais;
  }

  public function getCiudad()
  {
    return $this->ciudad;
  }

  //// SETTER //// 
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setIdPais($idPais)
  {
    $this->idPais = $idPais;
  }

  public function setCiudad($ciudad)
  {
    $this->ciudad = $ciudad;
  }

  //// CONSULTA //// 

  public function obtenerTodasCiudades()
  {
    $sql = "SELECT * FROM ciudades WHERE Id_Pais = '{$this->getIdPais()}';";
    $obtenerCiudades = $this->db->query($sql);
    return $obtenerCiudades;
  }
}
