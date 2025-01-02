<?php

class Productos
{
  private $id;
  private $nombre;
  private $descripcion;
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

  //// CONSULTAS ////
  public function crearProducto()
  {
    $nombre = $this->db->real_escape_string($this->getNombre() ?? "");
    $descripcion = $this->db->real_escape_string($this->getDescripcion() ?? "");
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
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, estado, oferta, offer_start, offer_expiration, parent_id, idioma_id, grupo_id, imagenes) 
                VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$estado', '$oferta', " . ($offer_start ? "'$offer_start'" : 'NULL') . ", " . ($offer_expiration ? "'$offer_expiration'" : 'NULL') . ", $parent_id_sql, {$this->getIdioma()}, '$grupo_id', '$imagenes')";
    return $this->db->query($sql);
  }

  public function actualizarProductoPorId()
  {
    $nombre = $this->db->real_escape_string($this->getNombre() ?? "");
    $descripcion = $this->db->real_escape_string($this->getDescripcion() ?? "");
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
              grupo_id = '$grupo_id'";

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
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();

    $id = $this->getId();
    $parentId = $this->getParentId();

      $sql = "SELECT * FROM productos WHERE id = $id AND idioma_id = $idioma AND parent_id = $parentId";
      $result = $this->db->query($sql);

      if ($result && $result->num_rows > 0) {
        return $result->fetch_object();

      } else {

        $sqlFallback = "SELECT * FROM productos WHERE idioma_id = $idioma AND parent_id = $parentId";
        $resultFallback = $this->db->query($sqlFallback);

        if ($resultFallback && $resultFallback->num_rows > 0) {
          return $resultFallback->fetch_object();
        }
      }

      return null;
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

  public function movil()
  {
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
    $sql = "SELECT p.*, (SELECT AVG(calificacion) FROM comentarios WHERE producto_id = p.id) AS promedio_calificacion FROM productos p WHERE idioma_id = $idioma AND parent_id = 1735806505 LIMIT 3";
    return $this->db->query($sql);
  }

  public function tvAudios()
  {
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
    $sql = "SELECT p.*, (SELECT AVG(calificacion) FROM comentarios WHERE producto_id = p.id) AS promedio_calificacion FROM productos p WHERE idioma_id = $idioma AND parent_id = 1735801087 LIMIT 3";
    return $this->db->query($sql);
  }

  public function electrodomesticos()
  {
    $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
    $sql = "SELECT p.*,(SELECT AVG(calificacion) FROM comentarios WHERE producto_id = p.id) AS promedio_calificacion FROM productos p WHERE idioma_id = $idioma AND parent_id = 1735804773 LIMIT 3";
    return $this->db->query($sql);
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
