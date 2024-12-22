<?php

class Categorias
{
  private $id;
  private $nombre;
  private $descripcion;
  private $parentId;
  private $imagenesJson;
  private $db;

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

  public function getImagenes()
  {
    return $this->imagenesJson;
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

  public function setImagenes($imagenesJson)
  {
    $this->imagenesJson = $imagenesJson;
  }

  //// CONSULTAS //// 

  public function obtenerCategorias()
  {
    $sql = "SELECT * FROM categorias WHERE parent_id IS NULL OR parent_id = ''";
    $listarCategorias = $this->db->query($sql);
    return [
      'categorias' => $listarCategorias,
    ];
  }

  public function obtenerSubcategorias($minPrecio, $maxPrecio)
  {

    // Construir la consulta SQL para categoria con filtro de precio
    $sqlCategorias = "SELECT * FROM categorias WHERE parent_id = {$this->getId()}";
    $listarCategorias = $this->db->query($sqlCategorias);

    // Construir la consulta SQL para productos con filtro de precio
    $sqlProductos = "SELECT * FROM productos WHERE parent_id = {$this->getId()}";

    if (!empty($minPrecio)) {
      $sqlProductos .= " AND precio >= {$minPrecio}";
    }

    if (!empty($maxPrecio)) {
      $sqlProductos .= " AND precio <= {$maxPrecio}";
    }

    $listarProductos = $this->db->query($sqlProductos);

    return [
      'categorias' => $listarCategorias,
      'productos' => $listarProductos,
    ];
  }


  public function obtenerCategoriasYProductos()
  {
    // Obtener todas las categorías principales
    $sqlCategorias = "SELECT * FROM categorias WHERE parent_id IS NULL OR parent_id = ''";
    $categorias = $this->db->query($sqlCategorias);

    // Para cada categoría, obtener sus subcategorías y productos
    $categoriasConSubcategoriasYProductos = [];

    while ($categoria = $categorias->fetch_object()) {
      // Obtener subcategorías para cada categoría principal
      $sqlSubcategorias = "SELECT * FROM categorias WHERE parent_id = {$categoria->id}";
      $subcategorias = $this->db->query($sqlSubcategorias);

      // Obtener productos para cada categoría principal
      $sqlProductos = "SELECT * FROM productos WHERE parent_id = {$categoria->id}";
      $productos = $this->db->query($sqlProductos);

      // Asociar las subcategorías y productos con la categoría
      $categoriasConSubcategoriasYProductos[] = [
        'categoria' => $categoria,
        'subcategorias' => $subcategorias,
        'productos' => $productos
      ];
    }

    return $categoriasConSubcategoriasYProductos;
  }


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

  public function crearCategoria()
  {
    $nombre = $this->db->real_escape_string($this->getNombre());
    $descripcion = $this->db->real_escape_string($this->getDescripcion());
    $parent_id_sql = $this->getParentId() == false ? 'NULL' : $this->getParentId();
    $sql = "INSERT INTO categorias (nombre, descripcion, parent_id, imagenes) VALUES ('$nombre', '$descripcion', $parent_id_sql, '{$this->getImagenes()}')";
    return $this->db->query($sql);
  }

  public function actualizarCategoriaPorId()
  {
    $nombre = $this->db->real_escape_string($this->getNombre());
    $descripcion = $this->db->real_escape_string($this->getDescripcion());
    $imagenes = $this->getImagenes();
    $imagenesValidas = !empty($imagenes) && $imagenes != '[]' && $imagenes != 'null';
    $sql = "UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion'";

    if ($imagenesValidas) {
      $sql .= ", imagenes = '$imagenes'";
    }

    $sql .= " WHERE id = {$this->getId()}";
    $categoria = $this->db->query($sql);
    return $categoria;
  }

  public function eliminarCategoria()
  {
    $result = false;
    $sqlCategoria = "DELETE FROM categorias WHERE id = {$this->getId()}";
    $deleteCategoria = $this->db->query($sqlCategoria);
    if ($deleteCategoria) {
      $result = true;
    }
    return $result;
  }

  public function getBreadcrumbs()
  {
    $breadcrumbs = [];
    $currentId = $this->getId();
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
        break;
      }
    }
    return $breadcrumbs;
  }

  public function buscarProductosPorTexto($textoBusqueda, $minPrecio = false, $maxPrecio = false)
  {
    // Escapar texto para prevenir inyección SQL
    $textoBusqueda = $this->db->real_escape_string($textoBusqueda);

    // Base de la consulta
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$textoBusqueda%'";

    // Agregar filtros de precio si están definidos
    if ($minPrecio !== false) {
      $sql .= " AND precio >= $minPrecio";
    }
    if ($maxPrecio !== false) {
      $sql .= " AND precio <= $maxPrecio";
    }

    $resultados = $this->db->query($sql);

    return [
      'productos' => $resultados,
    ];
  }
}
