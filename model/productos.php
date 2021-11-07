<?php

class Productos
{

  private $id;
  private $idCategoria;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $oferta;
  private $marca;
  private $memoriaRam;
  private $imagen;
  private $buscador;
  private $db;

  ///CONSTRUCTOR///
  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTER ////   
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

  public function getOferta()
  {
    return $this->oferta;
  }

  public function getMarca()
  {
    return $this->marca;
  }

  public function getMemoriaRam()
  {
    return $this->memoriaRam;
  }

  public function getImagen()
  {
    return $this->imagen;
  }

  public function getBuscador()
  {
    return $this->buscador;
  }

  //// SETTER //// 
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

  public function setOferta($oferta)
  {
    $this->oferta = $oferta;
  }

  public function setMarca($marca)
  {
    $this->marca = $marca;
  }

  public function setMemoriaRam($memoriaRam)
  {
    $this->memoriaRam = $memoriaRam;
  }

  public function setImagen($imagen)
  {
    $this->imagen = $imagen;
  }

  public function setBuscador($buscador)
  {
    $this->buscador = $buscador;
  }


  //// CONSULTA //// 

  public function crear()
  {
    $sql = "INSERT INTO productos (nombre, categoria_id, precio, stock, oferta, marca, memoria_ram,descripcion, imagen ) VALUES ('{$this->getNombre()}' , {$this->getIdCategoria()}, {$this->getPrecio()}, {$this->getStock()}, '{$this->getOferta()}', '{$this->getMarca()}', '{$this->getMemoriaRam()}', '{$this->getDescripcion()}', '{$this->getImagen()}') ";
    $crear = $this->db->query($sql);
    return $crear;
  }


  public function subirImagen()
  {
    $sql = "INSERT INTO productos (imagen) VALUES ('{$this->getImagen()}')";
    $subirImagen = $this->db->query($sql);
    return $subirImagen;
  }

  public function obtenerTodos()
  {
    $sql = "SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, c.categorias as nombreCategoria from productos p INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC;";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }

  public function obtenerProductosyBuscador()
  {
    $sql = "SELECT p.id, p.nombre, p.marca, p.stock, p.precio, p.oferta, c.categorias as nombreCategoria from productos p
    INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '%{$this->getBuscador()}%' OR p.marca LIKE '%{$this->getBuscador()}%' OR p.stock LIKE '%{$this->getBuscador()}%' OR p.precio LIKE '%{$this->getBuscador()}%' OR p.oferta LIKE '%{$this->getBuscador()}%' OR c.categorias LIKE '%{$this->getBuscador()}%');";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }

  public function productosPorId()
  {
    $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }


  public function actualizar()
  {
    $resultado = false;
    $sql = "UPDATE productos SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock = {$this->getStock()}, oferta = '{$this->getOferta()}', marca = '{$this->getMarca()}', memoria_ram = '{$this->getMemoriaRam()}', imagen = '{$this->getImagen()}' WHERE id = {$this->getId()};";
    $actualizar = $this->db->query($sql);
    if ($actualizar) {
      $resultado = true;
    }
    return $actualizar;
  }

  public function eliminar()
  {
    $resultado = false;
    $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
    $borrar = $this->db->query($sql);
    if ($borrar) {
      $resultado = true;
    }
    return $borrar;
  }

  public function obtenerRegistrosTotales()
  {
    $sql = "SELECT count(id) as 'registros_totales' FROM productos";
    $registros_totales = $this->db->query($sql);
    return $registros_totales->fetch_object();
  }

  public function obtenerTodosYPaginacion($ultimoRegistro, $mostrarRegistros)
  {
    $sql = "SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, c.categorias as nombreCategoria from productos p INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC LIMIT $ultimoRegistro, $mostrarRegistros;";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }

}
