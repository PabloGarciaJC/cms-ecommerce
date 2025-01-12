<?php

class LineaPedidos
{
    private $id;
    private $pedido_id;
    private $producto_id;
    private $cantidad;
    private $precio;
    private $oferta;
    private $subtotal;
    private $stock;
    private $grupoId;
    private $idioma;
    private $nombre;
    private $costo;
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

    public function getCosto()
    {
        return $this->costo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPedido_id()
    {
        return $this->pedido_id;
    }

    public function getGrupoId()
    {
        return $this->grupoId;
    }

    public function getIdioma()
    {
        return $this->idioma;
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

    public function getOferta()
    {
        return $this->oferta;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function getStock()
    {
        return $this->stock;
    }

    //// SETTERS ////


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }

    public function setGrupoId($grupoId)
    {
        $this->grupoId = $grupoId;
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

    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    //// CONSULTAS ////

    public function guardar()
    {
        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $sql = "INSERT INTO linea_pedidos (nombre, precio, oferta, stock, idioma_id, grupo_id, usuario_id, subtotal) 
        VALUES ('{$this->getNombre()}', {$this->getPrecio()}, {$this->getOferta()}, {$this->getStock()}, $idioma, '{$this->getGrupoId()}', {$this->getId()}, {$this->getSubtotal()})";
        $save = $this->db->query($sql);
        return $save;
    }

    public function existeRegistro()
    {
        $sql = "SELECT * FROM linea_pedidos WHERE idioma_id = {$this->getIdioma()} AND grupo_id = '{$this->getGrupoId()}' AND usuario_id = {$this->getId()} LIMIT 1";
        $result = $this->db->query($sql);
        // Si hay resultados, el registro ya existe
        if ($result && $result->num_rows > 0) {
            return true; // Existe
        } else {
            return false; // No existe
        }
    }

    public function obtenerLineaPedidos()
    {
        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $sql = "SELECT 
                lp.id AS linea_pedido_id, 
                lp.pedido_id AS linea_pedido_pedido_id, 
                lp.producto_id AS linea_pedido_producto_id, 
                lp.cantidad AS linea_pedido_cantidad, 
                lp.precio AS linea_pedido_precio, 
                lp.oferta AS linea_pedido_oferta, 
                lp.subtotal AS linea_pedido_subtotal, 
                lp.stock AS linea_pedido_stock, 
                lp.idioma_id AS linea_pedido_idioma_id, 
                lp.grupo_id AS linea_pedido_grupo_id, 
                lp.usuario_id AS linea_pedido_usuario_id, 
                lp.nombre AS linea_pedido_nombre, 
                lp.estado AS linea_pedido_estado,
                p.id AS producto_id, 
                p.nombre AS producto_nombre, 
                p.descripcion AS producto_descripcion, 
                p.precio AS producto_precio, 
                p.stock AS producto_stock, 
                p.estado AS producto_estado, 
                p.oferta AS producto_oferta, 
                p.offer_expiration AS producto_offer_expiration, 
                p.imagenes AS producto_imagenes, 
                p.parent_id AS producto_parent_id, 
                p.idioma_id AS producto_idioma_id, 
                p.grupo_id AS producto_grupo_id, 
                p.offer_start AS producto_offer_start
                FROM linea_pedidos lp
                LEFT JOIN productos p ON p.grupo_id = lp.grupo_id
                WHERE lp.usuario_id = {$this->getId()} 
                AND lp.idioma_id = $idioma 
                AND p.idioma_id = $idioma";

        $result = $this->db->query($sql);

        // Inicializamos un array para almacenar los resultados
        $datos = [];
        while ($row = $result->fetch_object()) {
            $datos[] = $row; // Agregamos cada fila al array
        }

        // Convertimos el array a formato JSON
        return json_encode($datos);
    }

    public function actualizar()
    {
        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $sql = "UPDATE linea_pedidos SET cantidad = {$this->getCantidad()}, subtotal = {$this->getSubtotal()} WHERE usuario_id = {$this->getId()} AND idioma_id = $idioma AND grupo_id = '{$this->getGrupoId()}'";
        $result = $this->db->query($sql);
        return $result;
    }

    public function eliminar()
    {
        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $sql = "DELETE FROM linea_pedidos WHERE usuario_id = {$this->getId()} AND idioma_id = $idioma AND grupo_id = '{$this->getGrupoId()}'";
        $result = $this->db->query($sql);
        return $result;
    }

}
