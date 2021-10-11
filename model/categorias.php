<?php

class Ciudades
{

  private $id;
  private $categorias;
  private $fechaIngreso;
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

  public function getCategorias()
  {
    return $this->categorias;
  }

  public function getFecha_Ingreso()
  {
    return $this->fechaIngreso;
  }

  //// SETTER //// 

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setCategorias($categorias)
  {
    $this->categorias = $categorias;
  }

  public function setFecha_Ingreso($fechaIngreso)
  {
    $this->fechaIngreso = $fechaIngreso;
  }

  //// CONSULTAS //// 

  

}
