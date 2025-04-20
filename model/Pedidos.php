<?php

namespace model;
use config\Database;

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

        // Si no hay pedidos pendientes en el mismo idioma, permitir la creación de un nuevo pedido
        $sql = "INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, coste, estado, fecha, hora, idioma_id) 
                VALUES (null, {$this->getUsuario_id()}, '{$this->getPais()}', '{$this->getCiudad()}', '{$this->getDireccion()}', '{$this->getCodigoPostal()}', {$this->getCoste()}, '{$this->getEstado()}', CURDATE(), CURTIME(), $idioma);";
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

        $sql = "SELECT pd.id AS pedido_id, 
                       pd.usuario_id, 
                       pd.direccion, 
                       pd.codigoPostal, 
                       pd.pais, 
                       pd.ciudad, 
                       u.Usuario AS nombre_usuario, 
                       GROUP_CONCAT(CONCAT(p.nombre, ' <strong>(x', lp.cantidad, ')</strong>') SEPARATOR ', ') AS productos, 
                       pd.coste, 
                       pd.estado, 
                       pd.fecha, 
                       pd.hora 
                FROM pedidos pd
                INNER JOIN usuarios u ON pd.usuario_id = u.id
                INNER JOIN linea_pedidos lp ON lp.pedido_id = pd.id
                INNER JOIN productos p ON p.grupo_id = lp.grupo_id
                WHERE pedido_id = {$id}
                GROUP BY pedido_id";

        $query = $this->db->query($sql);

        if ($query && $query->num_rows == 1) {
            $result = $query->fetch_object();
        }

        return $result;
    }


    public function obtenerEstados()
    {
        return ['Pagado', 'Enviado', 'Entregado'];
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

        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $result = [];

        $sql = "SELECT
                pd.id AS pedido_id, 
                u.Usuario AS nombre_usuario,
                pd.coste, 
                pd.estado, 
                pd.fecha, 
                pd.hora,
                GROUP_CONCAT(CONCAT(p.nombre, ' <strong>(x', lp.cantidad, ')</strong>') SEPARATOR ', ') AS productos 
                FROM pedidos pd
                INNER JOIN usuarios u ON pd.usuario_id = u.id
                INNER JOIN linea_pedidos lp ON lp.pedido_id = pd.id
                INNER JOIN productos p ON p.grupo_id = lp.grupo_id
                WHERE p.idioma_id = $idioma GROUP BY pd.id ORDER BY pedido_id DESC;";

        $query = $this->db->query($sql);

        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }

        return $result;
    }

    public function obtenerPedidosConProductosCliente()
    {

        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $result = [];

        $sql = "SELECT
                pd.id AS pedido_id, 
                u.Usuario AS nombre_usuario,
                pd.coste, 
                pd.estado, 
                pd.fecha, 
                pd.hora,
                GROUP_CONCAT(CONCAT(p.nombre, ' <strong>(x', lp.cantidad, ')</strong>') SEPARATOR ', ') AS productos 
                FROM pedidos pd
                INNER JOIN usuarios u ON pd.usuario_id = u.id
                INNER JOIN linea_pedidos lp ON lp.pedido_id = pd.id
                INNER JOIN productos p ON p.grupo_id = lp.grupo_id WHERE p.idioma_id = $idioma AND lp.usuario_id = {$this->getId()} GROUP BY pd.id ORDER BY pedido_id DESC;";

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
