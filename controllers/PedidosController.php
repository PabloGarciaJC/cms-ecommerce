<?php
require_once 'model/usuario.php';
require_once 'model/pedidos.php';

class PedidosController
{

  public function crear()
  {
    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

    //Obtengo Usuario en el Banner
    $usuario = Utils::obtenerUsuario();

    //Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = Utils::listaCategorias();

    //Obtengo Todos Los Paises
    $paisesTodos = Utils::obtenerPaises();

    // Estadisticas del Productos
    $stats = Utils::estadisticasCarrito();

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/search.php';
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/pedidos/crear.php';
    require_once 'views/layout/footer.php';
  }


  public function guardar()
  {
    // Capturo lo que me llega por Post
    $usuarioId = isset($_POST['usuarioId']) ? $_POST['usuarioId'] : false;
    $alias = isset($_POST['alias']) ? $_POST['alias'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
    $codigoPostal = isset($_POST['CodigoPostal']) ? $_POST['CodigoPostal'] : false;
    $totalPagar = isset($_POST['totalPagar']) ? $_POST['totalPagar'] : false;
    $stockTotales = isset($_POST['stockTotales']) ? $_POST['stockTotales'] : false;

    // Guardo
    $pedido = new Pedidos();
    $pedido->setUsuario_id($usuarioId);
    $pedido->setPais($pais);
    $pedido->setCiudad($ciudad);
    $pedido->setDireccion($direccion);
    $pedido->setCodigoPostal($codigoPostal);
    $pedido->setCoste($totalPagar);
    $guardar = $pedido->guardar();

    if ($guardar) {
      echo 1;
    }

  }
}
