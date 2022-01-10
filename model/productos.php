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

  public function mostrarProductosBuscadorLimitar($ultimoRegistro, $mostrarRegistros, $productoIdCategoria)
  {
    $sql = "SELECT p.id, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.imagen, c.categorias as nombreCategoria from productos p
    INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '%{$this->getBuscador()}%' OR p.marca LIKE '%{$this->getBuscador()}%' OR p.stock LIKE '%{$this->getBuscador()}%' OR p.precio LIKE '%{$this->getBuscador()}%' OR p.oferta LIKE '%{$this->getBuscador()}%' OR c.categorias LIKE '%{$this->getBuscador()}%' && p.categoria_id  = $productoIdCategoria) LIMIT $ultimoRegistro, $mostrarRegistros;";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }


  public function productosPorId()
  {
    $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }

  public function productosPorCategoriaId()
  {
    $sql = "SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.categoria_id, c.categorias as nombreCategoria from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id = {$this->getIdCategoria()};";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }

  public function mostrarMarcaSinRepetirSidebar()
  {
    $sql = "SELECT DISTINCT p.marca from productos p INNER JOIN categorias c ON p.categoria_id = c.id and c.id = {$this->getIdCategoria()};";
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

  public function obtenerProductosPorCategoriaId($ultimoRegistro, $mostrarRegistros, $productoIdCategoria)
  {
    $sql = "SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.categoria_id, c.categorias as nombreCategoria from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id  = $productoIdCategoria ORDER BY p.id DESC LIMIT $ultimoRegistro, $mostrarRegistros;";
    $obtenerProductos = $this->db->query($sql);
    return $obtenerProductos;
  }

  public function conteoRegistrosPorCategoriaId()
  {
    $sql = "SELECT count(id) as 'registros_totales' FROM productos WHERE categoria_id = {$this->getIdCategoria()}";
    $registros_totales = $this->db->query($sql);
    return $registros_totales->fetch_object();
  }

  public function conteoBuscadorRegistrosCategoriaId()
  {
    $sql = "SELECT count(p.categoria_id) as 'registros_totales' from productos p
    INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '%{$this->getBuscador()}%' OR p.marca LIKE '%{$this->getBuscador()}%' OR p.stock LIKE '%{$this->getBuscador()}%' OR p.precio LIKE '%{$this->getBuscador()}%' OR p.oferta LIKE '%{$this->getBuscador()}%' OR c.categorias LIKE '%{$this->getBuscador()}%' && p.categoria_id  = {$this->getIdCategoria()})";

    $registros_totales = $this->db->query($sql);
    return $registros_totales->fetch_object();
  }

  public function conteoBuscadorRegistrosCategoriaIdFiltro()
  {

    $sql = "SELECT count(p.categoria_id) as 'registros_totaless' from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '{$this->getBuscador()}' OR p.marca LIKE '{$this->getBuscador()}' OR p.stock LIKE '{$this->getBuscador()}' OR p.precio LIKE '{$this->getBuscador()}' OR p.oferta LIKE '{$this->getBuscador()}' OR c.categorias LIKE '{$this->getBuscador()}') AND p.categoria_id = {$this->getIdCategoria()};";

    // $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '{$this->getBuscador()}' OR p.marca LIKE '{$this->getBuscador()}' OR p.stock LIKE '{$this->getBuscador()}' OR p.precio LIKE '{$this->getBuscador()}' OR p.oferta LIKE '{$this->getBuscador()}' OR c.categorias LIKE '{$this->getBuscador()}') AND p.categoria_id = {$this->getIdCategoria()};";

    $registros_totales = $this->db->query($sql);
    return $registros_totales->fetch_object();
  }

  public function conteoFiltro($arrayMarcaCheckbox, $conteoArrayMarca, $arrayMemoriaRamCheckbox, $conteoArrayMemoriaRam, $arrayPrecioCheckbox, $conteoPrecio)
  {

    // Muestar el Ultimo checkbox que se ha selecionado del Lado del Cliente
    foreach ($arrayMarcaCheckbox as $todosCheckboxMarca) {
      $todosCheckboxMarca;
    }

    // Muestar el Ultimo checkbox que se ha selecionado del Lado del Cliente
    foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
      $todosCheckboxMemoriaRam;
    }

    // Muestar el Ultimo checkbox que se ha selecionado del Lado del Cliente
    foreach ($arrayPrecioCheckbox as $todosCheckboxPrecio) {
      $indicesPrecio = explode("-", $todosCheckboxPrecio);
      $indicesPrecio[0];
      $indicesPrecio[1];
    }

    // CONTEO de todos los Arrays de los Checkbox que se ha selecionado
    $todosconteoCheckbox = $conteoArrayMarca + $conteoArrayMemoriaRam + $conteoPrecio;

    // Obtengo TODOS Los Registros con los checkbox SIN SELECCIONAR
    if ($todosconteoCheckbox === 0) {
      $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id where c.id = {$this->getIdCategoria()}";
    };

    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

    // PRIMER BLOQUE - MARCA - PARTE I - 1:1 y 1:M
    if ($conteoArrayMarca === 1) {
      // Consulta los Registros deL Checkbox Selecionado
      $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.marca = '$todosCheckboxMarca') and c.id = {$this->getIdCategoria()}";

      // Registros de UN checkbox de => Memoria RAM // 1:1 
      if ($conteoArrayMemoriaRam === 1) {
        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id  WHERE (p.marca = '$todosCheckboxMarca') and c.id = {$this->getIdCategoria()} and (p.memoria_ram = '$todosCheckboxMemoriaRam')";
      }

      // Registros de Multiples Checkbox de => Memoria RAM // 1:M
      if ($conteoArrayMemoriaRam >= 2) {
        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.marca = '$todosCheckboxMarca') and c.id = {$this->getIdCategoria()} and (p.memoria_ram = '$todosCheckboxMemoriaRam'";
        foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
          $sql .= " or p.memoria_ram = '$todosCheckboxMemoriaRam' ";
        }
        $sql .= ")";
      }
    };

    // PRIMER BLOQUE - MARCA - PARTE II - M:1 - M:M
    if ($conteoArrayMarca >= 2) {
      // Consulta los Registros de Checkbox Selecionado Marca
      $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.marca = '$todosCheckboxMarca'";
      foreach ($arrayMarcaCheckbox as $todosCheckboxMarca) {
        $sql .= " or p.marca = '$todosCheckboxMarca' ";
      }
      $sql .= ") and c.id = {$this->getIdCategoria()} ";

      // Registros de UN checkbox de => Memoria RAM // M:1 
      if ($conteoArrayMemoriaRam === 1) {

        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.marca = '$todosCheckboxMarca'";
        foreach ($arrayMarcaCheckbox as $todosCheckboxMarca) {
          $sql .= " or p.marca = '$todosCheckboxMarca' ";
        }
        $sql .= ") and (p.memoria_ram = '$todosCheckboxMemoriaRam') and c.id = {$this->getIdCategoria()}";
      };

      // Registros de Multiples Checkbox de => Memoria RAM // M:M 
      if ($conteoArrayMemoriaRam >= 2) {

        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE";

        $sql .= "(p.marca = '$todosCheckboxMarca'";
        foreach ($arrayMarcaCheckbox as $todosCheckboxMarca) {
          $sql .= " or p.marca = '$todosCheckboxMarca'";
        }

        $sql .= ") and (p.memoria_ram = '$todosCheckboxMemoriaRam'";
        foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
          $sql .= " or p.memoria_ram = '$todosCheckboxMemoriaRam' ";
        }

        $sql .= ") and c.id = {$this->getIdCategoria()}";
      }
    };

    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

    // PRIMER BLOQUE - MEMORIA RAM - PARTE I - 1:1 y 1:M
    if ($conteoArrayMemoriaRam === 1) {
      // Consulta los Registros deL Checkbox Selecionado
      $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.memoria_ram = '$todosCheckboxMemoriaRam') and c.id = {$this->getIdCategoria()}";

      // Registros de UN checkbox de => Marca // 1:1 
      if ($conteoArrayMarca === 1) {
        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id  WHERE (memoria_ram = '$todosCheckboxMemoriaRam') and c.id = {$this->getIdCategoria()} and (p.marca = '$todosCheckboxMarca')";
      }

      // Registros de Multiples Checkbox de => Marca // 1:M
      if ($conteoArrayMarca >= 2) {
        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (memoria_ram = '$todosCheckboxMemoriaRam') and c.id = {$this->getIdCategoria()} and (p.marca = '$todosCheckboxMarca'";
        foreach ($arrayMarcaCheckbox as $todosCheckboxMarca) {
          $sql .= " or p.marca = '$todosCheckboxMarca' ";
        }
        $sql .= ")";
      }
    };

    // PRIMER BLOQUE - MEMORIA RAM - PARTE II - M:1 y M:M
    if ($conteoArrayMemoriaRam >= 2) {
      // Consulta los Registros de Checkbox Selecionado Memoria Ram
      $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id and c.id = {$this->getIdCategoria()} WHERE (p.memoria_ram = '$todosCheckboxMemoriaRam'";
      foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
        $sql .= " or p.memoria_ram = '$todosCheckboxMemoriaRam' ";
      }
      $sql .= ")";


      // Registros de UN checkbox de => MARCA // M:1 
      if ($conteoArrayMarca === 1) {

        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.memoria_ram  = '$todosCheckboxMemoriaRam'";
        foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
          $sql .= " or p.memoria_ram = '$todosCheckboxMemoriaRam' ";
        }
        $sql .= ") and (p.marca = '$todosCheckboxMarca') and c.id = {$this->getIdCategoria()}";
      };

      // Registros de Multiples Checkbox de => Memoria RAM // M:M 
      if ($conteoArrayMarca >= 2) {

        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE";

        $sql .= "(p.memoria_ram = '$todosCheckboxMemoriaRam'";
        foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
          $sql .= " or p.memoria_ram = '$todosCheckboxMemoriaRam' ";
        }

        $sql .= ") and (p.marca = '$todosCheckboxMarca'";
        foreach ($arrayMarcaCheckbox as $todosCheckboxMarca) {
          $sql .= " or p.marca = '$todosCheckboxMarca'";
        }
        $sql .= ") and c.id = {$this->getIdCategoria()}";
      }
    }

    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

    // PRIMER BLOQUE - PRECIO - PARTE I - 1:1 y 1:M
    if ($conteoPrecio === 1) {
      // Consulta los Registros deL Checkbox Selecionado
      $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.precio >= $indicesPrecio[0] and p.precio <= $indicesPrecio[1]) and c.id = 13";


      // Registros de UN checkbox de => Memoria RAM // 1:1 
      if ($conteoArrayMemoriaRam === 1) {
        $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id  WHERE (p.marca = '$todosCheckboxMarca') and c.id = {$this->getIdCategoria()} and (p.memoria_ram = '$todosCheckboxMemoriaRam')";
      }

      // Registros de Multiples Checkbox de => Memoria RAM // 1:M
      // if ($conteoArrayMemoriaRam >= 2) {
      //   $sql = "SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.memoria_ram, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.marca = '$todosCheckboxMarca') and c.id = {$this->getIdCategoria()} and (p.memoria_ram = '$todosCheckboxMemoriaRam'";
      //   foreach ($arrayMemoriaRamCheckbox as $todosCheckboxMemoriaRam) {
      //     $sql .= " or p.memoria_ram = '$todosCheckboxMemoriaRam' ";
      //   }
      //   $sql .= ")";
      // }
    };

    $registros_totales = $this->db->query($sql);
    return $registros_totales;
  }
}
