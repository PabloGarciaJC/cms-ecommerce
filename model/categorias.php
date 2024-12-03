<?php

class Categorias
{
  private $id;
  private $nombre;  // Cambié 'categorias' a 'nombre' para mayor claridad
  private $descripcion;
  private $fechaIngreso;  // Este campo no está en la base de datos, ¿es necesario?
  private $db;

  /// CONSTRUCTOR ///
  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTERS ////
  public function getId()
  {
    return $this->id;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function getFechaIngreso()
  {
    return $this->fechaIngreso;
  }

  //// SETTERS ////
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
  }

  public function setFechaIngreso($fechaIngreso)
  {
    $this->fechaIngreso = $fechaIngreso;
  }

  //// CONSULTAS ////

  // Obtener todas las categorías
  public function obtenerCategorias()
  {
    $sql = "SELECT * FROM categorias";
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias;
  }

  // Obtener una categoría por su ID
  public function obtenerCategoriasPorId()
  {
    $sql = "SELECT * FROM categorias";
    if ($this->getId() != '') {
      $sql .= " WHERE id = {$this->getId()}";
    }
    
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias->fetch_object();
  }

  // Obtener categorías para el menú de navegación
  public function obtenerCategoriasNav()
  {
    $sql = "SELECT * FROM categorias";
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias;
  }

  // Actualizar una categoría por su ID
  public function actualizarCategoriaPorId()
  {
    $sql = "UPDATE categorias 
            SET categorias = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}' 
            WHERE id = {$this->getId()}";
    $categoria = $this->db->query($sql);
    return $categoria;
  }

  // Eliminar una categoría
  public function eliminar()
  {
    $result = false;
    $sql = "DELETE FROM categorias WHERE id = {$this->id}";
    $delete = $this->db->query($sql);
    if ($delete) {
      $result = true;
    }
    return $result;
  }

  // Crear una nueva categoría
  public function crearLista()
  {
    $sql = "INSERT INTO categorias (categorias, descripcion) 
            VALUES ('{$this->getNombre()}', '{$this->getDescripcion()}')";
    $crearLista = $this->db->query($sql);  
    return $crearLista;
  }

}
