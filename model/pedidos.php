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
    private $idioma;
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

    public function getIdioma()
    {
        return $this->idioma;
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

    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
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
        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
    
        // Verificar si el usuario tiene pedidos en el mismo idioma con estado distinto de 'Pagado'
        $sqlCheck = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} AND idioma_id = $idioma AND estado != 'Pagado' LIMIT 1;";
        $check = $this->db->query($sqlCheck);
    
        // Si existe un pedido con estado distinto de 'Pagado' en el mismo idioma, no permitir crear un nuevo pedido
        if ($check && $check->num_rows > 0) {
            $result = false;
            return;
        }
    
        // Si no hay pedidos pendientes en el mismo idioma, permitir la creación de un nuevo pedido
        $sql = "INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, estado, fecha, hora, idioma_id) 
                VALUES (null, {$this->getUsuario_id()}, '{$this->getPais()}', '{$this->getCiudad()}', '{$this->getDireccion()}', '{$this->getCodigoPostal()}', 'Pendiente', CURDATE(), CURTIME(), $idioma);";
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

        $sql = "SELECT pedidos.id AS pedido_id, 
                       pedidos.usuario_id, 
                       pedidos.direccion, 
                       pedidos.codigoPostal, 
                       pedidos.pais, 
                       pedidos.ciudad, 
                       usuarios.Usuario AS nombre_usuario, 
                       GROUP_CONCAT(CONCAT(productos.nombre, ' <strong>(x', linea_pedidos.cantidad, ')</strong>') SEPARATOR ', ') AS productos, 
                       pedidos.coste, 
                       pedidos.estado, 
                       pedidos.fecha, 
                       pedidos.hora 
                FROM pedidos
                INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id
                LEFT JOIN linea_pedidos ON pedidos.id = linea_pedidos.pedido_id
                LEFT JOIN productos ON linea_pedidos.producto_id = productos.id
                WHERE pedidos.id = {$id}
                GROUP BY pedidos.id";

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

        $sql = "SELECT pedidos.id AS pedido_id, 
                usuarios.Usuario AS nombre_usuario, 
                GROUP_CONCAT(CONCAT(productos.nombre, ' <strong>(x', linea_pedidos.cantidad, ')</strong>') SEPARATOR ', ') AS productos, 
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

        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }

        return $result;
    }

    public function contarPedidosPendientes()
    {
        $sql = "SELECT COUNT(*) AS total_pendientes FROM pedidos WHERE estado = 'Pendiente'";
        $query = $this->db->query($sql);

        if ($query && $row = $query->fetch_object()) {
            return $row->total_pendientes;
        }

        return 0;
    }

    public function obtenerIngresosMensuales()
    {
        $sql = "SELECT SUM(linea_pedidos.precio * linea_pedidos.cantidad) AS total_ingresos
            FROM linea_pedidos
            INNER JOIN pedidos ON linea_pedidos.pedido_id = pedidos.id
            WHERE MONTH(pedidos.fecha) = MONTH(CURDATE()) AND YEAR(pedidos.fecha) = YEAR(CURDATE())";

        $query = $this->db->query($sql);

        if ($query && $row = $query->fetch_object()) {
            return $row->total_ingresos;
        }

        return 0;
    }

    public function obtenerVentasMensuales()
    {
        $result = [];
        $sql = "SELECT MONTH(fecha) AS mes, SUM(coste) AS ingresos
            FROM pedidos
            WHERE YEAR(fecha) = YEAR(CURDATE())
            GROUP BY MONTH(fecha)
            ORDER BY MONTH(fecha)";

        $query = $this->db->query($sql);

        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }

        return $result;
    }

    public function obtenerPedidosPendientes()
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE estado = 'Pendiente'";
        $query = $this->db->query($sql);
        $row = $query->fetch_object();
        return $row->total;
    }

    public function obtenerPedidosCompletados()
    {
        $sql = "SELECT COUNT(*) AS total_completados FROM pedidos WHERE estado = 'Entregado'";
        $query = $this->db->query($sql);
        $row = $query->fetch_object();
        return $row->total_completados;
    }

    public function obtenerHistorialPedidos()
    {
        $sql = "SELECT p.id, u.Usuario AS cliente, p.estado, p.fecha FROM pedidos p JOIN usuarios u ON p.usuario_id = u.id ORDER BY p.fecha DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function obtenerVentasTotales()
    {
        $query = "SELECT SUM(coste) AS ventas_totales FROM pedidos";
        $resultado = $this->db->query($query);
        $ventasTotales = $resultado->fetch_object();
        return $ventasTotales->ventas_totales;
    }
}
