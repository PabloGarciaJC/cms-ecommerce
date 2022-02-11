<?php

class Categorias
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

  public function obtenerCategorias()
  {
    $sql = "SELECT * FROM categorias";
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias;
  }

  
  public function obtenerCategoriasPorId()
  {

    $sql = "SELECT * FROM categorias";

    if($this->getId() != '') {
      $sql .= " WHERE id = {$this->getId()}";
    }
    
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias->fetch_object();
  }


  public function obtenerCategoriasNav()
  {
    $sql = "SELECT * FROM categorias";
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias;
  }

  
  public function actualizarCategoriaPorId()
  {
    $sql = "UPDATE Categorias SET categorias = '{$this->getCategorias()}' WHERE Id = {$this->getId()};";
    $categoria = $this->db->query($sql);
   
    return $categoria;
  }

  public function eliminar()
  {
    $result = false;
    $sql = "DELETE FROM categorias WHERE id= {$this->id}";
    $delete = $this->db->query($sql);
    if ($delete) {
      $result = true;
    }
    return $result;
  }

  public function crearLista()
  {
    $sql = "INSERT INTO categorias(categorias) VALUES ('{$this->getCategorias()}') ";
    $crearLista = $this->db->query($sql);  
    return $crearLista;
  }

}
