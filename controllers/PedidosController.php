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
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/pedidos/crear.php';
    require_once 'views/layout/footer.php';
  }


  public function guardar()
  {

    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

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

    // Guardar Pedidos
    $guardar = $pedido->guardar();

    // Guardar Linea Pedidos
    $guardarLinea = $pedido->guardarLinea();

    if ($guardar && $guardarLinea) {
      $_SESSION['carrito'] = null;
      echo 1;
    }
  }

  public function listar()
  {
    //Obtengo Usuario en el Banner
    $usuario = Utils::obtenerUsuario();
    //Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = Utils::listaCategorias();

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';    
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/pedidos/listar.php';
    require_once 'views/layout/footer.php';
  }

  public function mostrar()
  {
    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

    //Obtengo Usuario en el Banner
    $usuario = Utils::obtenerUsuario();

    // Obtengo los Pedidos
    $mostrarPedido =  Utils::obtenerPedidos($usuario);

    echo '<table class="table email-table no-wrap table-hover v-middle mb-0 font-14">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col" style="text-align: center;">Nro.Pedido</th>';
    echo '<th scope="col" style="text-align: center;">Coste</th>';
    echo '<th scope="col" style="text-align: center;">Fecha</th>';
    echo '<th scope="col" style="text-align: center;">Estado</th>';
    echo '<th scope="col" style="text-align: center;">Detalles</th>';
    if (Utils::accesoUsuarioAdmin()) :
      echo '<th scope="col" style="text-align: center;">Cambiar Estado</th>';
    endif;
    echo '</tr>';
    echo '</thead>';

    echo '<tbody>';

    while ($mostraPedidos = $mostrarPedido->fetch_object()) :
      echo '<tr>';
      echo '<td style="text-align: center;">' . $mostraPedidos->id . '</td>';
      echo '<td style="text-align: center;">' . $mostraPedidos->coste . '</td>';
      echo '<td style="text-align: center;">' . $mostraPedidos->fecha . '</td>';
      echo '<td style="text-align: center;">' . $mostraPedidos->estado . '</td>';
      echo '<td style="text-align: center;"><a href="' . base_url . 'Pedidos/detalles&idPedido=' . $mostraPedidos->id . '">ver</a> </td>';
      if (Utils::accesoUsuarioAdmin()) :
        echo '<td style="text-align: center;">';
        echo '<a href="#" data-toggle="modal" data-target="#gestionarPedido">';
        echo '<button type="button" class="btn btn-success" onclick="editarPedidos(' . $mostraPedidos->id . ')"><i class="fa fa-pencil"></i></button></a>';
        echo '</a>';
        echo '</td>';
      endif;
      echo '</tr>';
    endwhile;
    echo '</tbody>';
    echo '</table>';
  }

  public function editar()
  {
    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

    $idPedido = isset($_POST['idPedido']) ? $_POST['idPedido'] : false;
    $estadoPedido = isset($_POST['estadoPedido']) ? $_POST['estadoPedido'] : false;

    if ($idPedido && $estadoPedido) {
      // Editar el Estado
      Utils::cambiarEstado($idPedido, $estadoPedido);
      echo 1;
    }
  }

  public function detalles()
  {
    // Capturo el id por Get
    $idPedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : false;

    // Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

    // Obtengo Usuario en el Banner
    $usuario = Utils::obtenerUsuario();

    // Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = Utils::listaCategorias();

    // Obtener los Productos por id Pedido
    $mostrarProductos = Utils::obtenerProductosbyPedidos($idPedido);

    // Obtener Usuario del Pedido
    $usuarioPorPedido = Utils::obtenerUsuarioDelPedido($idPedido);

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';    
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/pedidos/detalles.php';
    require_once 'views/layout/footer.php';
  }
}
