<?php

class Pedidos
{

  private $id;
  private $usuario_id;
  private $pais;
  private $ciudad;
  private $direccion;
  private $codigoPostal;
  private $coste;
  private $estado;
  private $fecha;
  private $hora;
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTER //// 

  public function getId()
  {
    return $this->id;
  }

  public function getUsuario_id()
  {
    return $this->usuario_id;
  }

  public function getPais()
  {
    return $this->pais;
  }

  public function getCiudad()
  {
    return $this->ciudad;
  }

  public function getDireccion()
  {
    return $this->direccion;
  }

  public function getCodigoPostal()
  {
    return $this->codigoPostal;
  }

  public function getCoste()
  {
    return $this->coste;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function getfecha()
  {
    return $this->fecha;
  }

  public function getHora()
  {
    return $this->hora;
  }

  //// SETTER //// 

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setUsuario_id($usuario_id)
  {
    $this->usuario_id = $usuario_id;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function setCiudad($ciudad)
  {
    $this->ciudad = $ciudad;
  }

  public function setDireccion($direccion)
  {
    $this->direccion = $direccion;
  }

  public function setCodigoPostal($codigoPostal)
  {
    $this->codigoPostal = $codigoPostal;
  }

  public function setCoste($coste)
  {
    $this->coste = $coste;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }

  public function setHora($hora)
  {
    $this->hora = $hora;
  }

  //// CONSULTAS //// 

  public function guardar()
  {
    $result = false;

    $sql = "INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, coste, estado, fecha, hora) VALUES (null, {$this->getUsuario_id()}, '{$this->getPais()}', '{$this->getCiudad()}', '{$this->getDireccion()}', '{$this->getCodigoPostal()}', {$this->getCoste()}, 'Pendiente', CURDATE(), CURTIME());";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }

    return $result;
  }

  public function guardarLinea()
  {
    $result = false;

    $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
    $query = $this->db->query($sql);
    $pedido_id = $query->fetch_object()->pedido;

    if (isset($_SESSION['carrito'])) {
      foreach ($_SESSION['carrito'] as $producto) {
        // Guardo en Linea Pedidos
        $insert = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES({$pedido_id}, {$producto['idProducto']}, {$producto['stock']})";
        $save = $this->db->query($insert);
      }
      if ($save) {
        $result = true;
      }
      return $result;
    }
  }

  public function obtenerTodosPorUsuarios()
  {
    $sql = "SELECT * FROM pedidos p WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
    $pedido = $this->db->query($sql);
    return $pedido;
  }

  public function obtenerTodos()
  {
    $sql = "SELECT * FROM pedidos p ORDER BY id DESC ";
    $pedido = $this->db->query($sql);
    return $pedido;
  }

  public function actualizarEstado()
  {
    $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' WHERE id={$this->getId()}";
    $save = $this->db->query($sql);

    $result = false;
    if ($save) {
      $result = true;
    }
    return $result;
  }

  public function obtenerProductosbyPedido()
  {

    $sql = "SELECT pr.*, lp.unidades, c.categorias as nombreCategoria FROM productos pr";

    $sql .= " INNER JOIN lineas_pedidos lp";
    $sql .= " ON pr.id = lp.producto_id ";

    $sql .= " INNER JOIN categorias c";
    $sql .= " ON pr.categoria_id = c.id";

    $sql .= " WHERE lp.pedido_id = {$this->getId()}";
 
    $productos = $this->db->query($sql);
    return $productos;
  }

  public function obtenerUsuariobyPedido()
  {
    $sql = "SELECT u.* FROM usuarios u INNER JOIN pedidos p ON u.Id = p.usuario_id WHERE p.id = {$this->getId()}";
    $productos = $this->db->query($sql);
    $idUsuario = $productos->fetch_object();
    return $idUsuario;
  }


}
