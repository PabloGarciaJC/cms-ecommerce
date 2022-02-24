<?php

class Utils
{
  //muestro errores modal
  public static function setearMensajeError($idMensaje, $mensajeError)
  {
    return "<script>document.getElementById('$idMensaje').innerHTML='<strong>Error,</strong> $mensajeError';</script>";
  }

  //compruebo que el usuario Exista !!, para evitar ingresar a los metodos del controlador.
  public static function accesoUsuarioRegistrado()
  {
    if (!isset($_SESSION['usuarioRegistrado'])) {
      header("Location:" . base_url);
    }
  }

  public static function accesoUsuarioAdmin()
  {
    if (isset($_SESSION['Admin'])) {
      return $_SESSION['Admin'];
    }
  }


  //borrar errores del formulario palen administrativo
  public static function borrarSesionErrores()
  {
    $_SESSION['errores'] = null;
    $_SESSION['repoblarInputs'] = null;
    $_SESSION['actualizadoCompleto'] = null;
  }

  //mostrar mensajes de errores formulario 
  public static function erroresValidacion($error, $mensaje)
  {
    return "<strong>$error,</strong> " . $mensaje;
  }


  //El Objeto Usuario Esta  Disponible en toda la Pagina 
  //"Lo Necesito para Mostrar el Nombre en el Banner"
  public static function obtenerUsuario()
  {
    require_once 'model/usuario.php';
    if (isset($_SESSION['usuarioRegistrado']->Id)) {
      $obtenertodos = new usuario;
      $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
      $usuarioPorId = $obtenertodos->obtenerTodosPorId();
      return $usuarioPorId;
    }
  }

  //El Objeto Usuario Esta  Disponible en toda la Pagina 
  //"Lo Necesito para Mostrar el Nombre en el Banner"
  public static function obtenerUsuarioSinModelo()
  {
    if (isset($_SESSION['usuarioRegistrado']->Id)) {
      if (isset($_SESSION['usuarioRegistrado']->Id)) {
        $obtenertodos = new usuario;
        $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
        $usuario = $obtenertodos->obtenerTodosPorId();
        return $usuario;
      }
    }
  }

  public static function listaCategorias()
  {
    require_once 'model/categorias.php';
    $categorias = new categorias;
    $categoria = $categorias->obtenerCategorias();
    return $categoria;
  }

  public static function obtenerCategoriaPorId($idProductoCategoria)
  {
    require_once 'model/categorias.php';
    $categorias = new categorias;
    $categorias->setId($idProductoCategoria);
    $categoria = $categorias->obtenerCategoriasPorId();
    return $categoria;
  }


  public static function obtenerProductos()
  {
    $productos = new productos;
    $mostrar = $productos->obtenerTodos();
    return $mostrar;
  }

  public static function obtenerProductosyBuscadoryPaginador($buscador, $ultimoRegistro, $mostrarRegistros)
  {

    $productos = new productos;
    $productos->setBuscador($buscador);
    $mostrar = $productos->obtenerProductosyBuscadoryPaginador($ultimoRegistro, $mostrarRegistros);
    return $mostrar;
  }

  public static function obtenerProductosPorId($id)
  {
    $productos = new productos;
    $productos->setId($id);
    $mostrar = $productos->productosPorId();
    return $mostrar->fetch_object();
  }

  public static function obtenerImagenProductoPorId()
  {
    require_once 'model/productos.php';
    $productos = new productos;
    $mostrar = $productos->obtenerTodos();
    $obtenerImagen = $mostrar->fetch_object();
    $completado = $obtenerImagen->imagen;
    return $completado;
  }

  public static function obtenerPaises()
  {
    require_once 'model/paises.php';
    $paises = new Paises();
    $paisesTodos = $paises->obtenerTodosPaises();
    return $paisesTodos;
  }

  public static function obtenerRegistrosTotales($buscadorProductos)
  {
    $productos = new productos;
    $mostrarTodos = $productos->obtenerRegistrosTotales($buscadorProductos);
    $obtenerRegistros = $mostrarTodos->registros_totales;
    return $obtenerRegistros;
  }

  public static function mostrarMarcaSinRepetirSidebar($idCategoria)
  {
    $productos = new productos;
    $productos->setIdCategoria($idCategoria);
    $mostrarProductosCategoriaId = $productos->mostrarMarcaSinRepetirSidebar();
    return $mostrarProductosCategoriaId;
  }

  public static function mostrarMemoriaRamSinRepetirSidebar($idCategoria)
  {
    $productos = new productos;
    $productos->setIdCategoria($idCategoria);
    $mostrarProductosCategoriaId = $productos->mostrarMemoriaRamSinRepetirSidebar();
    return $mostrarProductosCategoriaId;
  }


  public static function extraerRegistros($registros)
  {
    return $registros->fetch_object();
  }

  /* Puedo usarla en otro Momento */
  public static function obtenerProductosPorCategoriaId($categoriaId)
  {
    $productos = new productos;
    $productos->setIdCategoria($categoriaId);
    $mostrarProductosCategoriaId = $productos->productosPorCategoriaId();
    return $mostrarProductosCategoriaId;
  }

  public static function obtenerProductosPorBuscadoryCheckbox($productoByIdCategoria, $arrayMarcaCheckbox, $arrayMemoriaRamCheckbox, $arrayPrecioCheckbox, $arrayOfertasCheckbox, $ultimoRegistro, $mostrarRegistros, $buscadorProducto)
  {

    // Counteo de checkbox selecionados
    $conteoArrayMarca = count($arrayMarcaCheckbox);
    $conteoArrayMemoriaRam = count($arrayMemoriaRamCheckbox);
    $conteoArrayPrecio = count($arrayPrecioCheckbox);
    $conteoArrayOfertas = count($arrayOfertasCheckbox);

    //Instancio Objeto y Consulta
    $productos = new productos;
    $productos->setIdCategoria($productoByIdCategoria);
    $productos->setBuscador($buscadorProducto);

    $mostrar = $productos->productosPorBuscadoryCheckbox($arrayMarcaCheckbox, $conteoArrayMarca, $arrayMemoriaRamCheckbox, $conteoArrayMemoriaRam, $arrayPrecioCheckbox, $conteoArrayPrecio, $arrayOfertasCheckbox, $conteoArrayOfertas, $ultimoRegistro, $mostrarRegistros);

    return $mostrar;
  }

  public static function conteoRegistrosPorBuscadoryCheckbox($productoByIdCategoria, $arrayMarcaCheckbox, $arrayMemoriaRamCheckbox, $arrayPrecioCheckbox, $arrayOfertasCheckbox, $buscadorProducto)
  {
    // Counteo de checkbox selecionados
    $conteoArrayMarca = count($arrayMarcaCheckbox);
    $conteoArrayMemoriaRam = count($arrayMemoriaRamCheckbox);
    $conteoArrayPrecio = count($arrayPrecioCheckbox);
    $conteoArrayOfertas = count($arrayOfertasCheckbox);

    //Instancio Objeto y Consulta
    $productos = new productos;
    $productos->setIdCategoria($productoByIdCategoria);
    $productos->setBuscador($buscadorProducto);
    $resultado = $productos->conteoPorBuscadoryCheckbox($arrayMarcaCheckbox, $conteoArrayMarca, $arrayMemoriaRamCheckbox, $conteoArrayMemoriaRam, $arrayPrecioCheckbox, $conteoArrayPrecio, $arrayOfertasCheckbox, $conteoArrayOfertas);
    return $resultado->registros_totales;
  }

  public static function estadisticasCarrito()
  {
    $stats = array(
      'stockTotales' => 0,
      'totalPrecio' => 0,
      'totalOfertas' => 0,
      'aplicarDescuento' => 0,
      'totalBase' => 0,
      'aplicandoIva' => 0,
      'total' => 0
    );

    if (isset($_SESSION['carrito'])) {

      foreach ($_SESSION['carrito'] as $producto) {
        // Concateno Todos Los Array de la Session
        $stats['stockTotales'] += $producto['stock'];
        $stats['totalPrecio'] += $producto['precio'] * $producto['stock'];
        $stats['totalOfertas'] += $producto['oferta'];
      }
      $stats['aplicarDescuento'] = $stats['totalPrecio'] * $stats['totalOfertas'] / 100;
      $stats['totalBase'] = $stats['totalPrecio'] - $stats['aplicarDescuento'];
      $stats['aplicandoIva'] = $stats['totalBase'] * 21 / 100;
      $stats['total'] = $stats['totalBase'] - $stats['aplicandoIva'];
    }

    return $stats;
  }

  public static function obtenerPedidos($usuario)
  {
    $pedido = new Pedidos;
    if ($usuario->Rol != 'Admin') {
      $pedido->setUsuario_id($usuario->Id);
      $resultado = $pedido->obtenerTodosPorUsuarios();
    } else {
      $resultado = $pedido->obtenerTodos();
    }
    return $resultado;
  }

  public static function cambiarEstado($idPedido, $estadoPedido)
  {
    $pedido = new Pedidos;
    $pedido->setId($idPedido);
    $pedido->setEstado($estadoPedido);
    $pedido->actualizarEstado();
  }

  public static function obtenerProductosbyPedidos($idPedido)
  {
    $pedido = new Pedidos;
    $pedido->setId($idPedido);
    $productos = $pedido->obtenerProductosbyPedido();
    return $productos;
  }

  public static function obtenerUsuarioDelPedido($idPedido)
  {
    $pedido = new Pedidos;
    $pedido->setId($idPedido);
    $idUsuario = $pedido->obtenerUsuariobyPedido();
    return $idUsuario;
  }

  public static function listarAutocompletado()
  {
    $productos = new productos;
    // $productos->setBuscador($buscadorProducto);
    $listado = $productos->ejecutarBuscador();
    return $listado;
  }

  public static function mostrarAutocompletado($listado)
  {
    $arrayListados = array();

    while ($filas = mysqli_fetch_array($listado)) {
      $nombre = utf8_decode($filas['nombre']);
      $marca = utf8_decode($filas['marca']);
      array_push($arrayListados, $nombre);
      array_push($arrayListados, $marca);
    }
    
    return $jsonListado = json_encode($arrayListados);
  }
};
