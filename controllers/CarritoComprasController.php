<?php

require_once 'model/productos.php';

class CarritoComprasController
{
  public function listar()
  {
    // Obtengo Ususario en el Banner
    $usuario = Utils::obtenerUsuario();

    // Obtengo Categorias en la Barra de Navegacion    
    $categoriaBarraNavegacion = Utils::listaCategorias();

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';    
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/carritoCompras/listar.php';
    require_once 'views/layout/footer.php';
  }

  public function mostrar()
  {
    // Capturo el Id del Producto Carrito de Compras 
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $idUp = isset($_POST['idUp']) ? $_POST['idUp'] : false;
    $idDown = isset($_POST['idDown']) ? $_POST['idDown'] : false;
    $idBorrar = isset($_POST['idBorrar']) ? $_POST['idBorrar'] : false;
    
    // Creacion del Carrito
    $carritoCreacion = 0;

    if (isset($_SESSION['carrito'])) {

      // Valido que Solo Exista un Array Por Id Iguales, Para que no se Repitan.
      foreach ($_SESSION['carrito'] as $indice => $elemento) {
        if ($elemento['idProducto'] == $id) {
          $carritoCreacion++;
        }
      }

      // Aumento Productos
      foreach ($_SESSION['carrito'] as $indice => $elemento) {
        if ($elemento['idProducto'] == $idUp) {
          $_SESSION['carrito'][$indice]['stock']++;
        }
      }

      // Resto Productos
      foreach ($_SESSION['carrito'] as $indice => $elemento) {
        if ($elemento['idProducto'] == $idDown) {
          if ($_SESSION['carrito'][$indice]['stock'] > 1) {
            $_SESSION['carrito'][$indice]['stock']--;
          }
        }
      }

      // Borrar Productos
      foreach ($_SESSION['carrito'] as $indice => $elemento) {
        if ($elemento['idProducto'] == $idBorrar) {
          unset($_SESSION['carrito'][$indice]);
        }
      }
    } // Fin del Carrito

    // Valido que No Exista la Session Carrito
    if ($id != false && $carritoCreacion == 0) {
      // Conseguir producto
      $producto = new Productos();
      $producto->setId($id);
      $obtenerProducto = $producto->productosPorId();
      $mostrarProducto = $obtenerProducto->fetch_object();

      // Añadir al carrito
      if (is_object($mostrarProducto)) {
        $_SESSION['carrito'][] = array(
          "idProducto" => $mostrarProducto->id,
          "nombreCategoria" => $mostrarProducto->nombreCategoria,
          "nombre" => $mostrarProducto->nombre,
          "precio" => $mostrarProducto->precio,
          "stock" => 1,
          "oferta" => $mostrarProducto->oferta,
          "marca" => $mostrarProducto->marca,
          "memoria_ram" => $mostrarProducto->memoria_ram,
          "imagen" => $mostrarProducto->imagen,
          "productos" => $producto
        );
      };
    }

    // Estadisticas del Productos
    $stats = Utils::estadisticasCarrito();

    echo '<div class="card-body">';

    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<div class="tab-content" id="myTabContent">';
    echo '<div class="tab-pane fade active show" id="inbox" aria-labelledby="inbox-tab" role="tabpanel">';
    echo '<div class="table table-responsive">';
    echo '<div class="container">';
    echo '<div class="row">';

    echo '<div class="col-sm">';
    echo '<strong>Sub-Total:</strong> ' . $stats['totalPrecio'] . ' $ <br>';
    echo '<strong>Oferta:</strong> ' . $stats['totalOfertas'] . ' % <br>';    
    echo '<strong>Iva 21.00 %: </strong> ' . $stats['aplicandoIva'] . ' $ <br>';
    echo '<strong>Total Pagar: </strong> <u>' . $stats['total'] . '</u> $<br>';
    echo '</div>';

    echo '<div class="col-sm">';
    echo '</br>';


    if (!isset($_SESSION['usuarioRegistrado'])) :

      echo '<a href="#" data-toggle="modal" data-target="#exampleModal">';      
      echo '<button type="button" class="btn btn-success">Hacer Pedido</button></a>';
      echo '</a>';

    else :
      echo '<a href=" ' . BASE_URL . 'Pedidos/crear"> <button type="button" class="btn btn-success">Hacer Pedido</button></a> ';
    endif;

    echo '</div>';

    echo '<div class="col-sm">';
    echo '</br>';
    echo '<a href=" ' . BASE_URL . 'CarritoCompras/borrarTodos"> <button type="button" class="btn btn-info">Vaciar Carrito</button></a> ';
    echo '</div>';

    echo '</div>';
    echo '</div>';

    echo '</br>';

    echo '<table class="table email-table no-wrap table-hover v-middle mb-0 font-14">';

    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col" style=" text-align: center;">Imagen</th>';
    echo '<th scope="col" style=" text-align: center;">Productos</th>';
    echo '<th scope="col" style=" text-align: center;">Unidades</th>';
    echo '<th scope="col" style=" text-align: center;">Borrar</th>';
    echo '</tr>';
    echo '</thead>';

    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) != 0) {
      echo '<tbody>';
      foreach ($_SESSION['carrito'] as $indice => $mostrarProducto) {
        echo '<tr>';
        echo '<td>';
        echo '<img class="img-fluid" src="' . BASE_URL . 'uploads/images/productos/' . $mostrarProducto['imagen'] . '">';
        echo '</td>';
        echo '<td>';
        echo '<a href="' . BASE_URL . 'Producto/descripcion&id=' . $mostrarProducto['idProducto'] . '">';
        echo '<strong>Nombre:</strong> ' . $mostrarProducto['nombre'] . '<br>';
        echo '<strong>Marca:</strong> ' . $mostrarProducto['marca'] . ' <br>';
        echo '<strong>Precio:</strong> ' . $mostrarProducto['precio'] . ' $ <br>';
        echo '<strong>Oferta:</strong> ' . $mostrarProducto['oferta'] . ' % <br>';
        echo '<strong>Categoria:</strong> ' . $mostrarProducto['nombreCategoria'] . ' <br>';
        echo '</a>';
        echo '</td>';
        echo '<td>';
        echo '<ul class="pagination justify-content-center">';
        echo '<li class="page-item">';

        echo '<a class="page-link" onclick="carritoDown(' . $mostrarProducto['idProducto'] . ')" "tabindex="-1"> - </a>';

        echo '</li>';

        echo '<li class="page-item disabled"><a class="page-link" href="#"><strong>' . $mostrarProducto['stock'] . '</strong><br></a></li>';
        echo '<li class="page-item ">';

        echo '<a class="page-link" onclick="carritoUp(' . $mostrarProducto['idProducto'] . ')" "tabindex="-1"> + </a>';

        echo '</li>';
        echo '</ul>';
        echo '</td>';
        echo '<td>';
        echo '<button class="btn btn-circle btn-danger text-white" onclick="eliminarCarritoProducto(' . $mostrarProducto['idProducto'] . ', \'' . $mostrarProducto['nombre'] . '\')" text-white">';
        echo '<i class="fa fa-trash"></i>';
        echo '</button>';
        echo '</td>';
        echo '</tr>';
      }
    } else {
      echo '<td colspan="8">';
      echo '<div class="alert alert-primary" role="alert">';
      echo 'No hay <strong>Productos</strong> en el <strong>Carrito de Compras</strong>';
      echo '</div>';
      echo '</td>';
    };
    echo '</tbody>';

    echo '</table>';

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
  }

  public function borrarTodos()
  {
    unset($_SESSION['carrito']);
    header("location:" . BASE_URL . "CarritoCompras/listar");
  }
}

;