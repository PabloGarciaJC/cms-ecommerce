<?php

class Productos
{
  private $id;
  private $nombre;
  private $descripcion;
  private $especificacion1;
  private $especificacion2;
  private $especificacion3;
  private $especificacion4;
  private $especificacion5;
  private $precio;
  private $stock;
  private $estado;
  private $oferta;
  private $offerStart;
  private $offerExpiration;
  private $imagenes;
  private $parentid;
  private $idioma;
  private $grupoId;
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

  public function getEspecificacion1()
  {
    return $this->especificacion1;
  }

  public function getEspecificacion2()
  {
    return $this->especificacion2;
  }

  public function getEspecificacion3()
  {
    return $this->especificacion3;
  }

  public function getEspecificacion4()
  {
    return $this->especificacion4;
  }

  public function getEspecificacion5()
  {
    return $this->especificacion5;
  }

  public function getPrecio()
  {
    return $this->precio;
  }

  public function getStock()
  {
    return $this->stock;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function getOferta()
  {
    return $this->oferta;
  }

  public function getOfferExpiration()
  {
    return $this->offerExpiration;
  }

  public function getImagenes()
  {
    return $this->imagenes;
  }

  public function getParentId()
  {
    return $this->parentid;
  }

  public function getOfferStart()
  {
    return $this->offerStart;
  }

  public function getIdioma()
  {
    return $this->idioma;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  //// SETTER //// 

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

  public function setEspecificacion1($especificacion1)
  {
    $this->especificacion1 = $especificacion1;
  }

  public function setEspecificacion2($especificacion2)
  {
    $this->especificacion2 = $especificacion2;
  }

  public function setEspecificacion3($especificacion3)
  {
    $this->especificacion3 = $especificacion3;
  }

  public function setEspecificacion4($especificacion4)
  {
    $this->especificacion4 = $especificacion4;
  }

  public function setEspecificacion5($especificacion5)
  {
    $this->especificacion5 = $especificacion5;
  }

  public function setPrecio($precio)
  {
    $this->precio = $precio;
  }

  public function setStock($stock)
  {
    $this->stock = $stock;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function setOferta($oferta)
  {
    $this->oferta = $oferta;
  }

  public function setOfferExpiration($offerExpiration)
  {
    $this->offerExpiration = $offerExpiration;
  }

  public function setImagenes($imagenes)
  {
    $this->imagenes = $imagenes;
  }

  public function setParentId($parentid)
  {
    $this->parentid = $parentid;
  }

  public function setOfferStart($offerStart)
  {
    $this->offerStart = $offerStart;
  }

  public function setIdioma($idioma)
  {
    $this->idioma = $idioma;
  }

  public function setGrupoId($grupoId)
  {
    $this->grupoId = $grupoId;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
  }

  //// CONSULTAS ////
  public function crearProducto()
  {
    $nombre = $this->db->real_escape_string($this->getNombre() ?? "");
    $descripcion = $this->db->real_escape_string($this->getDescripcion() ?? "");
    $especificacion1 = $this->db->real_escape_string($this->getEspecificacion1() ?? "");
    $especificacion2 = $this->db->real_escape_string($this->getEspecificacion2() ?? "");
    $especificacion3 = $this->db->real_escape_string($this->getEspecificacion3() ?? "");
    $especificacion4 = $this->db->real_escape_string($this->getEspecificacion4() ?? "");
    $especificacion5 = $this->db->real_escape_string($this->getEspecificacion5() ?? "");
    $precio = floatval($this->db->real_escape_string($this->getPrecio() ?? 0));
    $stock = intval($this->getStock() ?? 0);
    $estado = $this->db->real_escape_string($this->getEstado() ?? "");
    $oferta = floatval($this->db->real_escape_string($this->getOferta() ?? 0));
    $offer_start = $this->getOfferStart() ? $this->db->real_escape_string($this->getOfferStart()) : null;
    $offer_expiration = $this->getOfferExpiration() ? $this->db->real_escape_string($this->getOfferExpiration()) : null;
    if ($offer_start === '') {
      $offer_start = null;
    }
    if ($offer_expiration === '') {
      $offer_expiration = null;
    }
    $parent_id_sql = $this->getParentId() == false ? 'NULL' : $this->getParentId();
    $grupo_id = $this->db->real_escape_string($this->getGrupoId());
    $imagenes = $this->getImagenes();
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, estado, oferta, offer_start, offer_expiration, parent_id, idioma_id, grupo_id, imagenes, especificacion_1, especificacion_2, especificacion_3, especificacion_4, especificacion_5 ) 
            VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$estado', '$oferta', " . ($offer_start ? "'$offer_start'" : 'NULL') . ", " . ($offer_expiration ? "'$offer_expiration'" : 'NULL') . ", $parent_id_sql, {$this->getIdioma()}, '$grupo_id', '$imagenes', '$especificacion1', '$especificacion2', '$especificacion3', '$especificacion4', '$especificacion5')";

    return $this->db->query($sql);
  }

  public function actualizarProductoPorId()
  {
    $nombre = $this->db->real_escape_string($this->getNombre() ?? "");
    $descripcion = $this->db->real_escape_string($this->getDescripcion() ?? "");
    $especificacion1 = $this->db->real_escape_string($this->getEspecificacion1() ?? "");
    $especificacion2 = $this->db->real_escape_string($this->getEspecificacion2() ?? "");
    $especificacion3 = $this->db->real_escape_string($this->getEspecificacion3() ?? "");
    $especificacion4 = $this->db->real_escape_string($this->getEspecificacion4() ?? "");
    $especificacion5 = $this->db->real_escape_string($this->getEspecificacion5() ?? "");
    $precio = floatval($this->db->real_escape_string($this->getPrecio() ?? 0));
    $stock = intval($this->getStock() ?? 0);
    $estado = $this->db->real_escape_string($this->getEstado() ?? "");
    $oferta = floatval($this->db->real_escape_string($this->getOferta() ?? 0));
    $offer_start = $this->getOfferStart() ? $this->db->real_escape_string($this->getOfferStart()) : null;
    $offer_expiration = $this->getOfferExpiration() ? $this->db->real_escape_string($this->getOfferExpiration()) : null;
    if ($offer_start === '') {
      $offer_start = null;
    }
    if ($offer_expiration === '') {
      $offer_expiration = null;
    }
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

    $sql = "UPDATE productos SET 
              nombre = '$nombre', 
              descripcion = '$descripcion', 
              precio = '$precio', 
              stock = '$stock', 
              estado = '$estado', 
              oferta = '$oferta', 
              offer_start = " . ($offer_start ? "'$offer_start'" : 'NULL') . ", 
              offer_expiration = " . ($offer_expiration ? "'$offer_expiration'" : 'NULL') . ", 
              parent_id = $parent_id_sql, 
              grupo_id = '$grupo_id',
              especificacion_1 = '$especificacion1',
              especificacion_2 = '$especificacion2',
              especificacion_3 = '$especificacion3',
              especificacion_4 = '$especificacion4',
              especificacion_5 = '$especificacion5'";
              
    if ($imagenesValidas) {
      $sql .= ", imagenes = '$imagenesJSON'";
    }

    $sql .= " WHERE grupo_id = '$grupo_id' AND idioma_id = {$this->getIdioma()}";

    return $this->db->query($sql);
  }

  public function eliminarProducto()
  {
    $grupo_id = $this->db->real_escape_string($this->getGrupoId());
    $sql = "DELETE FROM productos WHERE grupo_id = '$grupo_id'";
    return $this->db->query($sql);
  }

  public function obtenerProductosPorId()
  {

    // Obtener el idioma actual
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    // Obtener el ID del usuario autenticado (si existe)
    $usuarioId = $this->getUsuario() ? $this->getUsuario()->Id : null;

    $sql = "SELECT
                  p.id,
                  p.nombre,
                  p.imagenes,
                  p.precio,
                  p.stock,
                  p.estado,
                  p.oferta,
                  p.descripcion,
                  p.offer_expiration,
                  p.parent_id,
                  p.grupo_id,
                  p.especificacion_1,
                  p.especificacion_2,
                  p.especificacion_3,
                  p.especificacion_4,
                  p.especificacion_5";

    if ($usuarioId) {
    $sql .= ", MAX(fv.id) AS favorito_id, MAX(fv.usuario_id) AS usuario_id, 
          CASE WHEN MAX(fv.id) IS NOT NULL THEN 1 ELSE 0 END AS favorito";
    }

    $sql .= " FROM productos p 
      LEFT JOIN categorias ca ON ca.grupo_id = p.parent_id";

    if ($usuarioId) {
    $sql .= " LEFT JOIN favoritos fv ON fv.grupo_id = p.grupo_id";
    }

    // Filtros por idioma y parent_id
    $sql .= " WHERE p.idioma_id = $idioma AND ca.idioma_id = $idioma AND p.grupo_id = {$this->getGrupoId()}";

    // Agregar el GROUP BY para todas las columnas no agregadas
    $sql .= " GROUP BY 
                      p.id, 
                      p.nombre, 
                      p.imagenes, 
                      p.precio, 
                      p.stock, 
                      p.estado, 
                      p.oferta, 
                      p.descripcion, 
                      p.offer_expiration, 
                      p.parent_id, 
                      p.grupo_id,
                      p.especificacion_1,
                      p.especificacion_2,
                      p.especificacion_3,
                      p.especificacion_4,
                      p.especificacion_5";

    $result = $this->db->query($sql);

    if ($result && $result->num_rows > 0) {
      return $result->fetch_object();
    }
  }

  public function actualizarPorIdFrontend()
  {
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
    $sql = "UPDATE productos SET stock = '{$this->getstock()}' where grupo_id = {$this->getGrupoId()} AND idioma_id = $idioma";
    $result = $this->db->query($sql);
    return $result;
  }

  public function obtenerProductosPorGrupo()
  {
    $sql = "SELECT * FROM productos WHERE grupo_id = {$this->getGrupoId()}";
    $result = $this->db->query($sql);
    $datos = [];
    while ($row = $result->fetch_object()) {
      $datos[$row->idioma_id] = $row;
    }
    return $datos;
  }

  public function obtenerProductos($parentId)
  {
    // Obtener el idioma actual
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    // Obtener el ID del usuario autenticado (si existe)
    $usuarioId = $this->getUsuario() ? $this->getUsuario()->Id : null;

    // Base SQL común
    $sql = "SELECT
                  p.id,
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
      $sql .= ", MAX(fv.id) AS favorito_id, MAX(fv.usuario_id) AS usuario_id, 
                    CASE WHEN MAX(fv.id) IS NOT NULL THEN 1 ELSE 0 END AS favorito";
    }

    // Continuar con el SQL
    $sql .= " FROM productos p 
                LEFT JOIN categorias ca ON ca.grupo_id = p.parent_id";

    // Si el usuario está autenticado, también se une a la tabla favoritos
    if ($usuarioId) {
      $sql .= " LEFT JOIN favoritos fv ON fv.grupo_id = p.grupo_id";
    }

    // Filtros por idioma y parent_id
    $sql .= " WHERE p.idioma_id = $idioma AND ca.idioma_id = $idioma AND p.parent_id = $parentId";

    // Agrupación según los campos seleccionados
    $sql .= " GROUP BY p.id, p.nombre, p.imagenes, p.precio, p.stock, p.estado, p.oferta, p.offer_expiration, p.parent_id, p.grupo_id";

    // Limitar a 3 resultados (según tu código original)
    $sql .= " LIMIT 3;";

    // Ejecutar la consulta
    return $this->db->query($sql);
  }

  public function movil()
  {
    return $this->obtenerProductos(1735806505);
  }

  public function tvAudios()
  {
    return $this->obtenerProductos(1735801087);
  }

  public function electrodomesticos()
  {
    return $this->obtenerProductos(1735804773);
  }

  public function obtenerTotalProductos()
  {
    $sql = "SELECT SUM(stock) AS total_productos FROM productos";
    $query = $this->db->query($sql);

    if ($query && $row = $query->fetch_object()) {
      return $row->total_productos;
    }

    return 0;
  }
}
