<?php

class Categorias
{
  private $id;
  private $nombre;
  private $descripcion;
  private $parentId;
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

  public function getParentId()
  {
    return $this->parentId;
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

  public function setParentId($parentId)
  {
    $this->parentId = $parentId;
  }

  // Obtener todas las categorías
  public function obtenerCategorias()
  {
    // Consulta base
    $sql = "SELECT * FROM categorias WHERE parent_id IS NULL OR parent_id = ''";
    // Ejecutar la consulta
    $listarCategorias = $this->db->query($sql);

    // Devolver ambos resultados como un arreglo asociativo
    return [
      'categorias' => $listarCategorias,
    ];
  }

  // Obtener todas las Subcategorías
  // public function otenerSubcategorias()
  // {
  //   // Consulta base
  //   $sql = "SELECT * FROM categorias WHERE parent_id = {$this->getParentId()}";
  //   $listarCategorias = $this->db->query($sql);
  //   return $listarCategorias;
  // }

  // Obtener todas las Subcategorías relacionadas con Productos
  public function otenerSubcategorias()
  {
    // Consulta para obtener todas las subcategorías
    $sqlCategorias = "SELECT * FROM categorias WHERE parent_id = {$this->getParentId()}";
    $listarCategorias = $this->db->query($sqlCategorias);

    // Consulta para obtener todos los productos
    $sqlProductos = "SELECT * FROM productos WHERE parent_id = {$this->getParentId()}";
    $listarProductos = $this->db->query($sqlProductos);

    // Devolver ambos resultados como un arreglo asociativo
    return [
      'categorias' => $listarCategorias,
      'productos' => $listarProductos,
    ];
  }

  // Obtener una categoría por su ID
  public function obtenerCategoriaPorId()
  {
    $sql = "SELECT * FROM categorias WHERE id = {$this->getId()}";
    $categoria = $this->db->query($sql);
    return $categoria->fetch_object();
  }

  public function obtenerCategoriaPadre()
  {
    $sql = "SELECT * FROM categorias WHERE parent_id = {$this->getParentId()}";
    $result = $this->db->query($sql);
    return $result;
  }


  // Crear una nueva categoría
  // public function crearCategoria()
  // {
  //   $sql = "INSERT INTO categorias (nombre, descripcion) 
  //           VALUES ('{$this->getNombre()}', '{$this->getDescripcion()}')";
  //   $crearCategoria = $this->db->query($sql);
  //   return $crearCategoria;
  // }

  public function crearCategoria()
  {
    $parentId = $this->getParentId() ? $this->getParentId() : 'NULL';
    $sql = "INSERT INTO categorias (nombre, descripcion, parent_id) 
              VALUES ('{$this->getNombre()}', '{$this->getDescripcion()}', $parentId)";
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

  public function getBreadcrumbs()
  {
    $breadcrumbs = [];
    $currentId = $this->getParentId();

    // Iterar hacia atrás en la jerarquía hasta llegar a la raíz
    while ($currentId) {
      $sql = "SELECT id, nombre, parent_id FROM categorias WHERE id = $currentId";
      $result = $this->db->query($sql);

      if ($result && $row = $result->fetch_object()) {
        // Añadir al principio del array de breadcrumbs
        array_unshift($breadcrumbs, [
          'id' => $row->id,
          'nombre' => $row->nombre
        ]);

        // Seguir al siguiente padre
        $currentId = $row->parent_id;
      } else {
        break; // Si no se encuentra, detener el bucle
      }
    }

    return $breadcrumbs;
  }
}
