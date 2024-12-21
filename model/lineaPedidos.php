<?php

class LineaPedidos
{
    private $id;
    private $pedido_id;
    private $producto_id;
    private $cantidad;
    private $precio;
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

    public function getPedido_id()
    {
        return $this->pedido_id;
    }

    public function getProducto_id()
    {
        return $this->producto_id;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    //// SETTERS ////
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPedido_id($pedido_id)
    {
        $this->pedido_id = $pedido_id;
    }

    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    //// CONSULTAS ////
    public function guardar()
    {
        $sql = "INSERT INTO linea_pedidos (pedido_id, producto_id, cantidad, precio) 
                VALUES ({$this->getPedido_id()}, {$this->getProducto_id()}, {$this->getCantidad()}, {$this->getPrecio()})";
        $save = $this->db->query($sql);
        return $save;
    }
}
