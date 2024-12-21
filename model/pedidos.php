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

    //// GETTERS ////

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

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    //// SETTERS ////

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

    //// CRUD METHODS ////

    public function guardar()
    {
        $result = false;

        $sql = "INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, coste, estado, fecha, hora) 
                VALUES (null, {$this->getUsuario_id()}, '{$this->getPais()}', '{$this->getCiudad()}', '{$this->getDireccion()}', '{$this->getCodigoPostal()}', {$this->getCoste()}, 'Pendiente', CURDATE(), CURTIME());";

        $save = $this->db->query($sql);

        if ($save) {
            $this->id = $this->db->insert_id;
            $result = true;
        }

        return $result;
    }

    public function obtenerTodos()
    {
        $result = [];

        $sql = "SELECT * FROM pedidos";
        $query = $this->db->query($sql);

        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }

        return $result;
    }

    public function obtenerPedidos()
    {
        $result = [];
    
        $sql = "SELECT pedidos.*, usuarios.Usuario AS nombre_usuario 
                FROM pedidos 
                INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id";
        
        $query = $this->db->query($sql);
    
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
    
        return $result;
    }
    

    public function obtenerPorId($id)
    {
        $result = null;

        $sql = "SELECT * FROM pedidos WHERE id = {$id}";
        $query = $this->db->query($sql);

        if ($query && $query->num_rows == 1) {
            $result = $query->fetch_object();
        }

        return $result;
    }

    public function obtenerEstados()
    {
        return ['Pendiente', 'Enviado', 'Entregado', 'Cancelado'];
    }

    public function actualizarEstado($id, $nuevoEstado)
    {
        $result = false;

        $sql = "UPDATE pedidos 
                SET estado = '{$nuevoEstado}' 
                WHERE id = {$id};";

        $update = $this->db->query($sql);

        if ($update) {
            $result = true;
        }

        return $result;
    }

    public function actualizar()
    {
        $result = false;

        $sql = "UPDATE pedidos 
                SET usuario_id = {$this->getUsuario_id()},
                    pais = '{$this->getPais()}',
                    ciudad = '{$this->getCiudad()}',
                    direccion = '{$this->getDireccion()}',
                    codigoPostal = '{$this->getCodigoPostal()}',
                    coste = {$this->getCoste()},
                    estado = '{$this->getEstado()}',
                    fecha = '{$this->getFecha()}',
                    hora = '{$this->getHora()}'
                WHERE id = {$this->getId()};";

        $update = $this->db->query($sql);

        if ($update) {
            $result = true;
        }

        return $result;
    }

    public function eliminar($id)
    {
        $result = false;

        $sql = "DELETE FROM pedidos WHERE id = {$id}";
        $delete = $this->db->query($sql);

        if ($delete) {
            $result = true;
        }

        return $result;
    }

    public function obtenerPedidosConProductos()
    {
        $result = [];
    
        $sql = "SELECT 
                    pedidos.id AS pedido_id,
                    usuarios.Usuario AS nombre_usuario,
                    GROUP_CONCAT(CONCAT(productos.nombre, ' (x', linea_pedidos.cantidad, ')') SEPARATOR ', ') AS productos,
                    pedidos.coste,
                    pedidos.estado,
                    pedidos.fecha,
                    pedidos.hora
                FROM pedidos
                INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id
                LEFT JOIN linea_pedidos ON pedidos.id = linea_pedidos.pedido_id
                LEFT JOIN productos ON linea_pedidos.producto_id = productos.id
                GROUP BY pedidos.id";  
    
        $query = $this->db->query($sql);
    
        // Obtenemos los resultados
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
    
        return $result;
    }
    
    

    
}
