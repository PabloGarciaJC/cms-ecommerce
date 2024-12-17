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

  //// CONSULTAS ////

  public function save()
  {
    // Manejo de fechas de inicio y expiración de la oferta
    $offerStart = $this->getOfferStart() ? "'{$this->getOfferStart()}'" : "NULL";
    $offerExpiration = $this->getOfferExpiration() ? "'{$this->getOfferExpiration()}'" : "NULL";

    $imagenesJson = json_encode($this->imagenes);
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, estado, oferta, offer_expiration, imagenes, parent_id, offer_start) 
              VALUES (
                  '{$this->getNombre()}', 
                  '{$this->getDescripcion()}', 
                  '{$this->getPrecio()}', 
                  '{$this->getStock()}', 
                  '{$this->getEstado()}', 
                  '{$this->getOferta()}', 
                  $offerExpiration, 
                  '$imagenesJson',
                  {$this->getParentId()},
                  $offerStart
              )";

    return $this->db->query($sql);
  }

  public function getAll()
  {
    $sql = "SELECT * FROM productos";
    $result = $this->db->query($sql);
    $productos = [];
    while ($row = $result->fetch_object()) {
      $productos[] = $row;
    }
    return $productos;
  }

  public function obtenerProductosPorId()
  {
    if (!$this->getId()) {
      return null;
    }
    $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
    $result = $this->db->query($sql);
    if ($result && $result->num_rows > 0) {
      return $result->fetch_object();
    }
    return null;
  }

  public function actualizarProductosPorId()
  {
    // Manejo de fechas de inicio y expiración de la oferta
    $offerStart = $this->getOfferStart() ? "'{$this->getOfferStart()}'" : "NULL";
    $offerExpiration = $this->getOfferExpiration() ? "'{$this->getOfferExpiration()}'" : "NULL";

    $campos = [
      "nombre = '{$this->getNombre()}'",
      "descripcion = '{$this->getDescripcion()}'",
      "precio = '{$this->getPrecio()}'",
      "stock = '{$this->getStock()}'",
      "estado = '{$this->getEstado()}'",
      "oferta = '{$this->getOferta()}'",
      "offer_start = $offerStart",
      "offer_expiration = $offerExpiration",
      "parent_id = {$this->getParentId()}"
    ];

    if ($this->getImagenes()) {
      $campos[] = "imagenes = '{$this->getImagenes()}'";
    }

    $campos_sql = implode(", ", $campos);
    $sql = "UPDATE productos SET $campos_sql WHERE id = {$this->getId()}";

    return $this->db->query($sql);
  }


  public function eliminarProductos()
  {
    $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
    return $this->db->query($sql);
  }

  public function addImagen($imagen)
  {
    if (!$this->imagenes) {
      $this->imagenes = [];
    }
    $this->imagenes[] = $imagen;
  }


  public function movil()
  {
    $sql = "SELECT * FROM productos WHERE parent_id = 192 LIMIT 3";
    return $this->db->query($sql);
  }

  public function tvAudios()
  {
    $sql = "SELECT * FROM productos WHERE parent_id = 194 LIMIT 3";
    return $this->db->query($sql);
  }

  public function accesorios()
  {
    $sql = "SELECT * FROM productos WHERE parent_id = 190 LIMIT 3";
    return $this->db->query($sql);
  }
}
