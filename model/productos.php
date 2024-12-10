<?php

class Productos
{
  private $id;
  private $idCategoria;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $estado;
  private $oferta;
  private $offerExpiration;
  private $imagenes;
  private $parentid;
  private $db;

  /// CONSTRUCTOR ///
  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTERS Y SETTERS ////

  public function getId()
  {
    return $this->id;
  }

  public function getIdCategoria()
  {
    return $this->idCategoria;
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

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setIdCategoria($idCategoria)
  {
    $this->idCategoria = $idCategoria;
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

  // Guardar producto en la base de datos
  public function save()
  {

    // Convertir imágenes a JSON para almacenarlas
    $imagenesJson = json_encode($this->imagenes);

    $sql = "INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, estado, oferta, offer_expiration, imagenes, parent_id) 
              VALUES (
                  {$this->getIdCategoria()}, 
                  '{$this->getNombre()}', 
                  '{$this->getDescripcion()}', 
                  '{$this->getPrecio()}', 
                  '{$this->getStock()}', 
                  '{$this->getEstado()}', 
                  '{$this->getOferta()}', 
                  '{$this->getOfferExpiration()}', 
                  '$imagenesJson',
                  '{$this->getParentId()}'
              )";

    return $this->db->query($sql);
  }


  // Obtener todos los productos
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

  // Obtener un producto por ID
  // public function obtenerProductosPorId()
  // {
  //   $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
  //   $result = $this->db->query($sql);
  //   return $result->fetch_object();
  // }

  public function obtenerProductosPorId()
  {
    // Verificar que se haya establecido un ID válido
    if (!$this->getId()) {
      return null;
    }

    // Consulta SQL para obtener el producto por ID
    $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";

    // Ejecutar la consulta
    $result = $this->db->query($sql);

    // Verificar si se encontró el producto
    if ($result && $result->num_rows > 0) {
      return $result->fetch_object();
    }

    // Si no se encontró el producto, devolver null
    return null;
  }

  // Actualizar un producto
  public function actualizarProductosPorId()
  {
    // Inicializa una lista para los campos que se actualizarán
    $campos = [
      "id_categoria = {$this->getIdCategoria()}",
      "nombre = '{$this->getNombre()}'",
      "descripcion = '{$this->getDescripcion()}'",
      "precio = '{$this->getPrecio()}'",
      "stock = '{$this->getStock()}'",
      "estado = '{$this->getEstado()}'",
      "oferta = '{$this->getOferta()}'",
      "offer_expiration = '{$this->getOfferExpiration()}'"
    ];

    // Verifica si hay una imagen y agrégala si existe
    if ($this->getImagenes()) {
      $campos[] = "imagenes = '{$this->getImagenes()}'";
    }

    // Convierte el array de campos en una cadena para la consulta SQL
    $campos_sql = implode(", ", $campos);

    // Crea la consulta
    $sql = "UPDATE productos SET $campos_sql WHERE id = {$this->getId()}";

    // Ejecuta la consulta
    return $this->db->query($sql);
  }


  // Eliminar un producto
  public function eliminarProductos()
  {
    $sql = "DELETE FROM productos WHERE id = {$this->getId()}";

    return $this->db->query($sql);
  }

  // Método para agregar una imagen a la propiedad imagenes
  public function addImagen($imagen)
  {
    if (!$this->imagenes) {
      $this->imagenes = [];
    }

    $this->imagenes[] = $imagen;
  }
}
