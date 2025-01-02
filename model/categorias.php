<?php

class Categorias
{
  private $id;
  private $nombre;
  private $idioma;
  private $descripcion;
  private $parentId;
  private $imagenesJson;
  private $grupoId;
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

  public function getGrupoId()
  {
    return $this->grupoId;
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

  public function getIdioma()
  {
    return $this->idioma;
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

  public function setIdioma($idioma)
  {
    $this->idioma = $idioma;
  }

  public function setGrupoId($grupoId)
  {
    $this->grupoId = $grupoId;
  }


  //// CONSULTAS //// 

  public function obtenerCategorias()
  {
    $sql = "SELECT * FROM categorias WHERE idioma_id = 1 AND parent_id IS NULL;";
    $listarCategorias = $this->db->query($sql);
    return [
      'categorias' => $listarCategorias,
    ];
  }

  public function obtenerSubcategorias()
  {
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    // Panel Administrativo
    $sqlCategorias = "SELECT * FROM categorias WHERE idioma_id = $idioma";
    $sqlProductos = "SELECT * FROM productos WHERE idioma_id = $idioma";

    if ($this->getId()) {
      $sqlCategorias .= " AND parent_id = {$this->getId()}";
      $sqlProductos .= " AND parent_id = {$this->getId()}";
    }

    if (!empty($minPrecio)) {
      $sqlProductos .= $this->getId() ? " AND" : " WHERE";
      $sqlProductos .= " precio >= {$minPrecio}";
    }

    if (!empty($maxPrecio)) {
      $sqlProductos .= $this->getId() ? " AND" : " WHERE";
      $sqlProductos .= " precio <= {$maxPrecio}";
    }

    $listarCategorias = $this->db->query($sqlCategorias);
    $listarProductos = $this->db->query($sqlProductos);

    return [
      'categorias' => $listarCategorias,
      'productos' => $listarProductos,
    ];
  }

  public function obtenerCategoriasYProductosFronted($minPrecio, $maxPrecio, $textoBusqueda)
  {
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    if ($this->getParentId()) {

      $sqlCategorias = "SELECT * FROM categorias WHERE idioma_id = $idioma";
      $sqlProductos = "SELECT * FROM productos WHERE idioma_id = $idioma";

      if ($this->getParentId()) {
        $sqlCategorias .= " AND parent_id = {$this->getId()}";
        $sqlProductos .= " AND parent_id = {$this->getParentId()}";
      }

      if (!empty($minPrecio)) {
        $sqlProductos .= $this->getParentId() ? " AND" : " WHERE";
        $sqlProductos .= " precio >= {$minPrecio}";
      }

      if (!empty($maxPrecio)) {
        $sqlProductos .= $this->getParentId() ? " AND" : " WHERE";
        $sqlProductos .= " precio <= {$maxPrecio}";
      }

      $listarCategorias = $this->db->query($sqlCategorias);
      $listarProductos = $this->db->query($sqlProductos);

      return [
        'categorias' => $listarCategorias,
        'productos' => $listarProductos,
      ];

    } else {

      // Consulta base para productos y categorías
      $sqlProductos = "SELECT * FROM productos WHERE idioma_id = $idioma";
      $sqlCategorias = "SELECT * FROM categorias WHERE idioma_id = $idioma";

      // Si hay texto de búsqueda, agregar condición a las consultas
      if (!empty($textoBusqueda)) {
        $textoBusquedaEscapado = $this->db->real_escape_string($textoBusqueda);
        $sqlCategorias .= " AND nombre LIKE '%{$textoBusquedaEscapado}%'";
        $sqlProductos .= " AND nombre LIKE '%{$textoBusquedaEscapado}%'";
      }
      if (!empty($minPrecio)) {
        $sqlProductos .= " AND precio >= {$minPrecio}";
      }

      if (!empty($maxPrecio)) {
        $sqlProductos .= " AND precio <= {$maxPrecio}";
      }

      // Ejecutar las consultas
      $listarProductos = $this->db->query($sqlProductos);
      $listarCategorias = $this->db->query($sqlCategorias);

      // Retornar los resultados
      return [
        'productos' => $listarProductos,
        'categorias' => $listarCategorias,
      ];
    }
  }

  public function obtenerCategoriasYProductos()
  {

    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    $sqlCategorias = "SELECT * FROM categorias WHERE idioma_id = $idioma AND parent_id IS NULL;";
    $categorias = $this->db->query($sqlCategorias);

    $categoriasConSubcategoriasYProductos = [];

    while ($categoria = $categorias->fetch_object()) {

      $sqlSubcategorias = "SELECT * FROM categorias WHERE idioma_id = $idioma AND parent_id = {$categoria->grupo_id}";
      $subcategorias = $this->db->query($sqlSubcategorias);

      $sqlProductos = "SELECT * FROM productos WHERE idioma_id = $idioma AND parent_id = {$categoria->grupo_id}";

      $productos = $this->db->query($sqlProductos);

      $categoriasConSubcategoriasYProductos[] = [
        'categoria' => $categoria,
        'subcategorias' => $subcategorias,
        'productos' => $productos
      ];
    }

    return $categoriasConSubcategoriasYProductos;
  }

  public function obtenerCategoriaPorGrupo()
  {
    $sql = "SELECT * FROM categorias WHERE grupo_id = {$this->getGrupoId()}";

    $result = $this->db->query($sql);
    $datos = [];

    while ($row = $result->fetch_object()) {
      $datos[$row->idioma_id] = $row;
    }

    return $datos;
  }

  public function obtenerCategoriaPadre()
  {
    $sql = "SELECT * FROM categorias WHERE parent_id = {$this->getParentId()}";
    $result = $this->db->query($sql);
    return $result;
  }

  public function crearCategoria()
  {
    $nombre = $this->db->real_escape_string($this->getNombre() ?? "");
    $descripcion = $this->db->real_escape_string($this->getDescripcion() ?? "");

    $parent_id_sql = $this->getParentId() == false ? 'NULL' : $this->getParentId();
    $grupo_id = $this->db->real_escape_string($this->getGrupoId());

    $sql = "INSERT INTO categorias (nombre, descripcion, parent_id, idioma_id, grupo_id, imagenes) 
                  VALUES ('$nombre', '$descripcion', $parent_id_sql, {$this->getIdioma()}, '$grupo_id', '{$this->getImagenes()}')";

    return $this->db->query($sql);
  }

  public function actualizarCategoriaPorId()
  {
    $nombre = $this->db->real_escape_string($this->getNombre() ?? "");
    $descripcion = $this->db->real_escape_string($this->getDescripcion() ?? "");
    $parent_id_sql = $this->getParentId() == false ? 'NULL' : $this->getParentId();
    $grupo_id = $this->db->real_escape_string($this->getGrupoId());

    $imagenes = $this->getImagenes();

    if (is_string($imagenes)) {
      $imagenes = json_decode($imagenes, true);
    }

    $imagenesValidas = !empty($imagenes) && is_array($imagenes);

    if ($imagenesValidas) {
      $imagenesJSON = json_encode($imagenes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
      $imagenesJSON = $this->db->real_escape_string($imagenesJSON);
    }

    $sql = "UPDATE categorias SET 
                          nombre = '$nombre', 
                          descripcion = '$descripcion', 
                          parent_id = $parent_id_sql, 
                          grupo_id = '$grupo_id'";

    if ($imagenesValidas) {
      $sql .= ", imagenes = '$imagenesJSON'";
    }

    $sql .= " WHERE grupo_id = '$grupo_id' AND idioma_id = {$this->getIdioma()}";

    return $this->db->query($sql);
  }


  public function eliminarCategoria()
  {
    $grupo_id = $this->db->real_escape_string($this->getGrupoId());
    $idioma_id = $this->db->real_escape_string($this->getIdioma());

    $sql = "DELETE FROM categorias WHERE grupo_id = '$grupo_id' AND idioma_id = $idioma_id";

    return $this->db->query($sql);
  }

  public function getBreadcrumbs()
  {
    $breadcrumbs = [];
    $currentId = $this->getId();

    while ($currentId) {
      $sql = "SELECT id, nombre, parent_id, grupo_id FROM categorias WHERE grupo_id = $currentId";
      $result = $this->db->query($sql);

      if ($result && $row = $result->fetch_object()) {
        array_unshift($breadcrumbs, [
          'id' => $row->id,
          'nombre' => $row->nombre,
          'grupo_id' => $row->grupo_id
        ]);
        $currentId = $row->parent_id;
      } else {
        break;
      }
    }
    return $breadcrumbs;
  }

  public function buscarProductosPorTexto($textoBusqueda, $minPrecio = false, $maxPrecio = false)
  {

    $textoBusqueda = $this->db->real_escape_string($textoBusqueda);
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$textoBusqueda%'";

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
