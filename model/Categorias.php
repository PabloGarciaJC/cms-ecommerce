<?php

namespace model;
use config\Database;

class Categorias
{
  private $id;
  private $nombre;
  private $idioma;
  private $descripcion;
  private $parentId;
  private $imagenesJson;
  private $grupoId;
  private $minPrecio;
  private $maxPrecio;
  private $textoBusqueda;
  private $usuario;
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

  public function getMinPrecio()
  {
    return $this->minPrecio;
  }

  public function getMaxPrecio()
  {
    return $this->maxPrecio;
  }

  public function getTextoBusqueda()
  {
    return $this->textoBusqueda;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }


  //// SETTERS ////

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setGrupoId($grupoId)
  {
    $this->grupoId = $grupoId;
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

  public function setMinPrecio($minPrecio)
  {
    $this->minPrecio = $minPrecio;
  }

  public function setMaxPrecio($maxPrecio)
  {
    $this->maxPrecio = $maxPrecio;
  }

  public function setTextoBusqueda($textoBusqueda)
  {
    $this->textoBusqueda = $textoBusqueda;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
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

  public function obtenerProductos()
  {
    // Obtener el idioma actual
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    // Obtener el ID del usuario autenticado (si existe)
    $usuarioId = $this->getUsuario() ? $this->getUsuario()->Id : null;

    // Consulta base para categorías
    $sqlCategorias = "SELECT * FROM categorias WHERE idioma_id = $idioma";

    // Consulta base para productos
    $sqlProductos = "SELECT p.id,
                              p.nombre,
                              p.imagenes,
                              p.precio,
                              p.stock,
                              p.estado,
                              p.oferta,
                              p.offer_expiration,
                              p.parent_id,
                              p.grupo_id";

    // Si el usuario está autenticado, se agrega la columna 'favorito'
    if ($usuarioId) {
      $sqlProductos .= ", MAX(fv.id) AS favorito_id, MAX(fv.usuario_id) AS usuario_id, 
                            CASE WHEN MAX(fv.id) IS NOT NULL THEN 1 ELSE 0 END AS favorito";
    }

    // Continuar con la SQL para productos
    $sqlProductos .= " FROM productos p 
                         LEFT JOIN categorias ca ON ca.grupo_id = p.parent_id";

    // Si el usuario está autenticado, también se une a la tabla favoritos
    if ($usuarioId) {
      $sqlProductos .= " LEFT JOIN favoritos fv ON fv.grupo_id = p.grupo_id";
    }

    // Filtros comunes de idioma
    $sqlProductos .= " WHERE p.idioma_id = $idioma AND ca.idioma_id = $idioma";

    // Si se recibe un parentId, se agrega al filtro
    if (!empty($this->getParentId())) {
      $sqlCategorias .= " AND parent_id = {$this->getParentId()}";
      $sqlProductos .= " AND p.parent_id = {$this->getParentId()}";
    }

    // Si hay texto de búsqueda, agregar condición LIKE
    if (!empty($this->getTextoBusqueda())) {
      $textoBusquedaEscapado = $this->db->real_escape_string($this->getTextoBusqueda());
      $sqlProductos .= " AND p.nombre LIKE '%{$textoBusquedaEscapado}%'";
    }

    // Si hay un precio mínimo, agregar filtro
    if (!empty($this->getMinPrecio())) {
      $sqlProductos .= " AND p.precio >= {$this->getMinPrecio()}";
    }

    // Si hay un precio máximo, agregar filtro
    if (!empty($this->getMaxPrecio())) {
      $sqlProductos .= " AND p.precio <= {$this->getMaxPrecio()}";
    }

    // Agrupación para productos (para evitar duplicados y usar MAX con favoritos)
    $sqlProductos .= " GROUP BY p.id, p.nombre, p.imagenes, p.precio, p.stock, p.estado, p.oferta, p.offer_expiration, p.parent_id, p.grupo_id";

    // Ejecutar las consultas
    $listarCategorias = $this->db->query($sqlCategorias);
    $listarProductos = $this->db->query($sqlProductos);

    // Retornar los resultados
    return [
      'categorias' => $listarCategorias,
      'productos' => $listarProductos,
    ];
  }

  public function obtenerCategoriasYProductosFronted()
  {
    if ($this->getParentId()) { //Existe Busqueda desde el Menu del Header
      $resultados = $this->obtenerProductos();
      return [
        'categorias' => $resultados['categorias'],
        'productos' => $resultados['productos'],
      ];
    } else { // Existe Busqueda desde search
      $resultados = $this->obtenerProductos();
      return [
        'productos' => $resultados['productos'],
        'categorias' => $resultados['categorias'],
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
    $sql = "INSERT INTO categorias (nombre, descripcion, parent_id, idioma_id, grupo_id, imagenes) VALUES ('$nombre', '$descripcion', $parent_id_sql, {$this->getIdioma()}, '$grupo_id', '{$this->getImagenes()}')";
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

    $sql = "UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion', parent_id = $parent_id_sql, grupo_id = '$grupo_id'";

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
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
    $breadcrumbs = [];
    $currentId = $this->getId();

    while ($currentId) {
      $sql = "SELECT id, nombre, parent_id, grupo_id FROM categorias WHERE grupo_id = $currentId  AND idioma_id = $idioma";
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
}
