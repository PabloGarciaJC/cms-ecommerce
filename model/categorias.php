<?php

class Categorias
{
  private $id;
  private $nombre;
  private $descripcion;
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

  // Obtener todas las categorías
  public function obtenerCategorias()
  {
    $sql = "SELECT * FROM categorias";
    $listarCategorias = $this->db->query($sql);
    return $listarCategorias;
  }

  // Obtener una categoría por su ID
  public function obtenerCategoriaPorId()
  {
    $sql = "SELECT * FROM categorias WHERE id = {$this->getId()}";
    $categoria = $this->db->query($sql);
    return $categoria->fetch_object();
  }

  // Crear una nueva categoría
  public function crearCategoria()
  {
    $sql = "INSERT INTO categorias (nombre, descripcion) 
            VALUES ('{$this->getNombre()}', '{$this->getDescripcion()}')";
    $crearCategoria = $this->db->query($sql);
    return $crearCategoria;
  }

  // Actualizar una categoría por su ID
  public function actualizarCategoriaPorId()
  {
    $sql = "UPDATE categorias 
            SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}' 
            WHERE id = {$this->getId()}";
    $categoria = $this->db->query($sql);
    return $categoria;
  }

  // Eliminar una categoría por su ID
  public function eliminarCategoria()
  {
    $result = false;

    // Primero, eliminar los productos que están relacionados con esta categoría
    $sqlProductos = "DELETE FROM productos WHERE id_categoria = {$this->getId()}";
    $deleteProductos = $this->db->query($sqlProductos);

    if ($deleteProductos) {
      // Luego, eliminar la categoría
      $sqlCategoria = "DELETE FROM categorias WHERE id = {$this->getId()}";
      $deleteCategoria = $this->db->query($sqlCategoria);

      if ($deleteCategoria) {
        $result = true;
      }
    }

    return $result;
  }
}
