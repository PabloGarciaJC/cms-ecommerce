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
  private $imagenes; // Esto puede ser una cadena JSON o array
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


  // Guardar producto en la base de datos
  public function save()
  {
      // Verificar si la categoria existe
      $sql = "SELECT COUNT(*) FROM categorias WHERE id = '{$this->idCategoria}'";
      $result = $this->db->query($sql);
      $row = $result->fetch_row();
      
      if ($row[0] == 0) {
          // Si la categoría no existe, lanzamos un error o retornamos false
          return false; // O puedes lanzar una excepción con un mensaje de error
      }
  
      // Convertir imágenes a JSON para almacenarlas
      $imagenesJson = json_encode($this->imagenes); 
      
      $sql = "INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, estado, oferta, offer_expiration, imagenes) 
              VALUES (
                  '{$this->idCategoria}', 
                  '{$this->nombre}', 
                  '{$this->descripcion}', 
                  '{$this->precio}', 
                  '{$this->stock}', 
                  '{$this->estado}', 
                  '{$this->oferta}', 
                  '{$this->offerExpiration}', 
                  '$imagenesJson'
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
  public function getById($id)
  {
    $sql = "SELECT * FROM productos WHERE id = {$id}";
    $result = $this->db->query($sql);

    return $result->fetch_object();
  }

  // Actualizar un producto
  public function update()
  {
    $imagenesJson = json_encode($this->imagenes); // Convertir imágenes a JSON para almacenarlas
    $sql = "UPDATE productos SET 
                id_categoria = '{$this->idCategoria}', 
                nombre = '{$this->nombre}', 
                descripcion = '{$this->descripcion}', 
                precio = '{$this->precio}', 
                stock = '{$this->stock}', 
                estado = '{$this->estado}', 
                oferta = '{$this->oferta}', 
                offer_expiration = '{$this->offerExpiration}', 
                imagenes = '$imagenesJson' 
                WHERE id = '{$this->id}'";

    return $this->db->query($sql);
  }

  // Eliminar un producto
  public function delete()
  {
    $sql = "DELETE FROM productos WHERE id = '{$this->id}'";

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
