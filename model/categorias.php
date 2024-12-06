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
    $sql = "DELETE FROM categorias WHERE id = {$this->getId()}";
    $delete = $this->db->query($sql);
    if ($delete) {
      $result = true;
    }
    return $result;
  }

  public function obtenerCategoriasConSubcategorias()
  {
    $sql = "
        SELECT 
            c.id AS categoria_id, 
            c.nombre AS categoria_nombre, 
            s.id AS subcategoria_id, 
            s.nombre AS subcategoria_nombre
        FROM 
            categorias c
        LEFT JOIN 
            subcategorias s ON c.id = s.categoria_id
        ORDER BY 
            c.nombre, s.nombre";

    $db = Database::connect();
    $result = $db->query($sql);

    // Organizar datos en un array asociativo
    $categorias = [];
    while ($row = $result->fetch_assoc()) {
      $categorias[$row['categoria_id']]['nombre'] = $row['categoria_nombre'];
      $categorias[$row['categoria_id']]['subcategorias'][] = [
        'id' => $row['subcategoria_id'],
        'nombre' => $row['subcategoria_nombre']
      ];
    }

    return $categorias;
  }



  
}
