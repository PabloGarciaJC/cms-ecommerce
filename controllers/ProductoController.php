<?php

require_once 'model/productos.php';

class ProductoController
{
  public function crear()
  {
    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

    //Obtengo Ususario en el Banner
    $usuario = Utils::obtenerUsuario();

    //Imprimo Lista Categoria   
    $categoria = Utils::listaCategorias();

    //Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = Utils::listaCategorias();

    //Capturo el Id para Editar
    isset($_GET['id']) ? $obtenerProductosPorId = Utils::obtenerProductosPorId($_GET['id']) : false;

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/producto/crear.php';
    require_once 'views/layout/footer.php';
  }

  public function guardar()
  {
    //POST
    $nombreProducto = isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : false;
    $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : false;
    $idCategoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
    $precioProducto = isset($_POST['precioProducto']) ? $_POST['precioProducto'] : false;
    $stockProducto = isset($_POST['stockProducto']) ? $_POST['stockProducto'] : false;
    $ofertaProducto = isset($_POST['ofertaProducto']) ? $_POST['ofertaProducto'] : false;
    $marcaProducto = isset($_POST['marcaProducto']) ? $_POST['marcaProducto'] : false;
    $memoriaRamProducto = isset($_POST['memoriaRamProducto']) ? $_POST['memoriaRamProducto'] : false;
    $descripcionProducto = isset($_POST['descripcionProducto']) ? $_POST['descripcionProducto'] : false;

    //FILES
    $nombreArchivo = isset($_FILES['guardarImagenProducto']['name']) ? $_FILES['guardarImagenProducto']['name'] : false;
    $tipoArchivo = isset($_FILES['guardarImagenProducto']['type']) ? $_FILES['guardarImagenProducto']['type'] : false;
    $rutaTemporal = isset($_FILES['guardarImagenProducto']['tmp_name']) ? $_FILES['guardarImagenProducto']['tmp_name'] : false;
    $pesoArchivo = isset($_FILES['guardarImagenProducto']['size']) ? $_FILES['guardarImagenProducto']['size'] : false;
    $sizeArchivoMax = "1048576"; // 1 MB expresado en bytes //1048576

    //validacion
    $errores = array();

    if (empty($nombreProducto)) {
      $errores["nombreProducto"] = "Debe completar Producto";
    }

    if (empty($precioProducto)) {
      $errores["precioProducto"] = "Debe completar Precio";
    } elseif (!is_numeric($precioProducto)) {
      $errores["precioProducto"] = "Precio No es Válido";
    }

    if (empty($stockProducto)) {
      $errores["stockProducto"] = "Debe completar Stock";
    } elseif (!is_numeric($stockProducto)) {
      $errores["stockProducto"] = "Stock No es Válido";
    }

    if (empty($marcaProducto)) {
      $errores["marcaProducto"] = "Debe completar Marca";
    }

    if (empty($memoriaRamProducto)) {
      $errores["memoriaRamProducto"] = "Debe completar Memoria Ram";
    } elseif (!is_numeric($memoriaRamProducto)) {
      $errores["memoriaRamProducto"] = "Memoria Ram No es Válido";
    }

    if ($tipoArchivo == "image/gif") {
      $errores["tipoArchivo"] = "Tipo de Archivo No Valido";
    }

    // Crear Fichero donde guardo la imagenes en el Proyecto.
    if (!is_dir('uploads/images/productos/')) {
      mkdir('uploads/images/productos/', 0777, true);
    }
    // Muevo la imagen en el fichero que se creo anteriormente.
    move_uploaded_file($rutaTemporal, 'uploads/images/productos/' . $nombreArchivo);

    //Instancio y Seteo indiferentemene de la Condicion
    $producto = new Productos();
    $producto->setNombre($nombreProducto);
    $producto->setId($idProducto);
    $producto->setIdCategoria($idCategoria);
    $producto->setPrecio($precioProducto);
    $producto->setStock($stockProducto);
    $producto->setOferta($ofertaProducto);
    $producto->setMarca($marcaProducto);
    $producto->setMemoriaRam($memoriaRamProducto);
    $producto->setDescripcion($descripcionProducto);
    $producto->setImagen($nombreArchivo);

    if ($rutaTemporal) {
      if ($idProducto) { //'Existe' . $idProducto, Si Existe Ruta Temporal, Actualizar PRODUCTO';  
        // Obtengo URL Guardada en la Base de Datos y en URL Fichero Actual
        $mostrarImagen = Utils::obtenerProductosPorId($idProducto);
        $ruta = 'uploads/images/productos/' . $mostrarImagen->imagen;
        if ($mostrarImagen->imagen != $nombreArchivo && is_file($ruta)) {
          //Borra la imagen anterior para que no quede Guardada en el Fichero
          unlink($ruta);
        }
        $producto->setId($idProducto);
        if (count($errores) == 0) {
          $producto->actualizar();
          echo '1';
        }
      } else { // 'NO Existe' . $idProducto, Si Existe Ruta Temporal, CREAR PRODUCTO'; 
        if (count($errores) == 0) {
          $producto->crear();
          echo '1';
        }
      }
    } else {
      if ($idProducto) { //'Existe' . $idProducto, NO Existe Ruta Temporal, Actualizar PRODUCTO';          
        $producto->setId($idProducto);
        $mostrarImagen = Utils::obtenerProductosPorId($idProducto);
        $producto->setImagen($mostrarImagen->imagen);
        if (count($errores) == 0) {
          $producto->actualizar();
          echo '1';
        }
      } else { // 'NO Existe' . $idProducto, NO Existe Ruta Temporal, CREAR PRODUCTO';        
        if (count($errores) == 0) {
          $producto->crear();
          echo '1';
        }
      }
    }
  }

  public function listar()
  {
    //Acceso Usuario Registrado a esta Pagina
    Utils::accesoUsuarioRegistrado();

    //Obtengo Ususario en el Banner
    $usuario = Utils::obtenerUsuario();

    //Obtengo Categorias en la Barra de Navegacion    
    $categoriaBarraNavegacion = Utils::listaCategorias();

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/producto/listar.php';
    require_once 'views/layout/footer.php';
  }

  public function buscador()
  {
    // Capturo el buscador 
    $buscadorProductos = isset($_POST['buscadorProductos']) ? $_POST['buscadorProductos'] : false;

    // Capturo el Ultimo Registro para Limitar => Iniciando en 1
    $paginaActual = isset($_POST['paginaActualBuscadorProductos']) ? $_POST['paginaActualBuscadorProductos'] : false;

    // Paginador 1: Extraer el Conteo de Registros de la Base de Datos
    $totalRegistrosBd = Utils::obtenerRegistrosTotales($buscadorProductos);

    // Paginador 2: Muestro el total de Registros que se van a Mostrar
    $mostrarRegistros = 3;

    // Paginador 3: Capturo la Pagina Actual => Para Limitar Los Registros, Primer Parametro
    $ultimoRegistro = ($paginaActual - 1) * $mostrarRegistros;

    // Paginador 4: Total de Registros que voy a Mostrar
    $mostrarNumerosdePaginas = ceil($totalRegistrosBd / $mostrarRegistros);

    // Pagina Anterior
    $paginaAnterior = $paginaActual - 1;

    // Pagina Siguiente
    $paginaSiguiente = $paginaActual + 1;

    // Paginador => Inicio
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-end">';
    // Anterior
    if ($paginaActual != 1) {
      echo '<li class="page-item">';
      echo '<a class="page-link" href="#" onclick = "ajaxBuscadorProductos(' . $paginaAnterior . ',\'' . $buscadorProductos . '\')"> Anterior </a>';
      echo '</li>';
    } else {
      echo '<li class="page-item disabled">';
      echo '<a class="page-link" href="#">Anterior</a>';
      echo '</li>';
    }

    // Cuerpo 
    for ($i = 1; $i <= $mostrarNumerosdePaginas; $i++) {
      if ($i == $paginaActual) {
        echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
      } else {
        echo '<li class="page-item"><a class="page-link" href="#" onclick = "ajaxBuscadorProductos(' . $i . ',\'' . $buscadorProductos . '\')">' . $i . '</a></li>';
      }
    }

    // Siguiente 
    if ($paginaActual != $mostrarNumerosdePaginas) {
      echo '<li class="page-item">';
      echo '<a class="page-link" href="#" onclick = "ajaxBuscadorProductos(' . $paginaSiguiente . ',\'' . $buscadorProductos . '\')" >Siguente</a>';
      echo '</li>';
    } else {
      echo '<li class="page-item disabled">';
      echo '<a class="page-link" href="#">Siguente</a>';
      echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
    echo '</br>';
    // Paginador => Fin


    // Obtengo Los Productor y el Buscador y Paginador 5: Consulta
    $productos = Utils::obtenerProductosyBuscadoryPaginador($buscadorProductos, $ultimoRegistro, $mostrarRegistros);

    echo '<div class="table table-responsive">';
    echo '<table class="table email-table no-wrap table-hover v-middle mb-0 font-14">';

    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col" style=" text-align: center;">Imagen</th>';
    echo '<th scope="col" style=" text-align: center;">Productos</th>';
    echo '<th scope="col" style=" text-align: center;">Editar</th>';
    echo '<th scope="col">Borrar</th>';
    echo '</tr>';
    echo '</thead>';

    echo '<tbody>';
    if ($productos->num_rows > 0) {
      while ($mostrarProductos = $productos->fetch_object()) {

        echo '<tr>';
        echo '<td><img class="img-fluid" src="' . base_url . 'uploads/images/productos/' . $mostrarProductos->imagen . '">';
        echo '</td>';

        echo '<td>';
        echo '<strong>Nombre:</strong> ' . $mostrarProductos->nombre . '<br>';
        echo '<strong>Marca:</strong> ' . $mostrarProductos->marca . '<br>';
        echo '<strong>Precio:</strong> ' . $mostrarProductos->precio . " $" . '<br>';
        echo '<strong>Oferta:</strong> ' . $mostrarProductos->oferta . " %" . '<br>';
        echo '<strong>Stock:</strong> ' . $mostrarProductos->stock . " Unidades" . '<br>';
        echo '<strong>Categoria:</strong> ' . $mostrarProductos->nombreCategoria  . '<br>';
        echo '<strong>Descripción: <a href=" ' . base_url . 'Producto/crear&id=' . $mostrarProductos->id . '">ver más</a></strong>';
        echo '</td>';

        echo '<td>';
        echo '<a href="' . base_url . 'Producto/crear&id=' . $mostrarProductos->id . '">';
        echo '<button class="btn btn-circle btn-info text-white" class="text-white">';
        echo '<i class="fa fa-pencil"></i>';
        echo '</button>';
        echo '</a>';
        echo '</td>';

        echo '<td> ';
        echo '<button class="btn btn-circle btn-danger text-white" onclick="eliminarDatosProducto(' . $mostrarProductos->id . ' ,\'' . $mostrarProductos->nombre . '\')">';
        echo '<i class="fa fa-trash"></i>';
        echo '</button>';
        echo '</td>';
        echo '</tr>';
      } // Fin While Php
    } else {
      echo '<td colspan="8">';
      echo '<div class="alert alert-primary" role="alert">';
      echo 'No hay <strong>Productos</strong> con estas Característica';
      echo '</div>';
      echo '</td>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  }

  public function eliminar()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $producto = new Productos();
    $producto->setId($id);
    $eliminado = $producto->eliminar();
    if ($eliminado) {
      echo 1;
    } else {
      true;
    }
  }

  public function mostrar()
  {
    // Obtengo el Id de Producto por Categoria
    $idCategoria = isset($_GET['producto']) ? $_GET['producto'] : false;

    // Obtengo Usuario en el Banner
    $usuario = Utils::obtenerUsuario();

    // Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = Utils::listaCategorias();

    // Obtengo los Productos por Categoria Id
    $mostrarProductoPorCategoria = Utils::obtenerCategoriaPorId($idCategoria);

    // Obtengo Marca, Sin Repetir en el Sidebar
    $mostrarMarcaSinRepetirSidebar = Utils::mostrarMarcaSinRepetirSidebar($idCategoria);

    // Obtengo Memoria Ram o Capacidad, Sin Repetir en el Sidebar
    $mostrarMemoriaRamSinRepetirSidebar = Utils::mostrarMemoriaRamSinRepetirSidebar($idCategoria);

    // Consulta Para Autocompletar
    $listado  =  Utils::listarAutocompletado();

    // Mosrar listar de Autocompletado
    $jsonMostrar = Utils::mostrarAutocompletado($listado);

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/search.php';
    require_once 'views/producto/mostrar.php';
    require_once 'views/layout/footer.php';
  }


  public function autocompletarBuscador()
  {
    $accionaBuscador = isset($_POST['accionaBuscador']) ? $_POST['accionaBuscador'] : false;

    $listado  =  Utils::listarAutocompletado($accionaBuscador);

    $arrayListados = array();

    while ($filas = $listado->fetch_assoc()) {
      // array_push($arrayListados, $filas['categorias']);
      array_push($arrayListados, $filas['nombre']);
    }
    echo json_encode($arrayListados);
  }

  public function mostrarTodos()
  {
    // Obtengo los Valores Checkbox
    $productoByIdCategoria = isset($_POST['productoByIdCategoria']) ? $_POST['productoByIdCategoria'] : false;
    $arrayMarcaCheckbox = isset($_POST["arrayMarca"]) ? json_decode($_POST["arrayMarca"]) : false;
    $arrayMemoriaRamCheckbox = isset($_POST["arrayMemoriaRam"]) ? json_decode($_POST["arrayMemoriaRam"]) : false;
    $arrayPrecioCheckbox = isset($_POST["arrayPrecio"]) ? json_decode($_POST["arrayPrecio"]) : false;
    $arrayOfertasCheckbox = isset($_POST["arrayOfertas"]) ? json_decode($_POST["arrayOfertas"]) : false;

    // Obtengo los Valores Buscador 
    $buscadorProducto = isset($_POST['buscadorProducto']) ? $_POST['buscadorProducto'] : false;

    // Numero de Registro que voy a mostrar en un Div
    $mostrarRegistros = 3;

    // Extraer el Conteo Total de Registros Bd =>  Checkbox , buscador 
    $conteoRegistroProductos  =  Utils::conteoRegistrosPorBuscadoryCheckbox($productoByIdCategoria, $arrayMarcaCheckbox, $arrayMemoriaRamCheckbox, $arrayPrecioCheckbox, $arrayOfertasCheckbox, $buscadorProducto);

    // Total de Div que se van a Crear
    $crearRegistroPorDiv = ceil($conteoRegistroProductos / $mostrarRegistros);

    if ($conteoRegistroProductos > 0) {

      // Creo los Div y dentro de cada Uno de ellos, Muestro los Registros de la Base de Datos Limitados a 3
      for ($conteoIdProducto = 0; $conteoIdProducto < $crearRegistroPorDiv; $conteoIdProducto++) {

        echo '<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">';

        $ultimoRegistro = $mostrarRegistros * $conteoIdProducto;

        // Mostrar Producto Todos O Por el Buscador Creando Div y Registros
        $mostrarProductos = Utils::obtenerProductosPorBuscadoryCheckbox($productoByIdCategoria, $arrayMarcaCheckbox, $arrayMemoriaRamCheckbox, $arrayPrecioCheckbox, $arrayOfertasCheckbox, $ultimoRegistro, $mostrarRegistros, $buscadorProducto);

        echo '<div class="row">';
        while ($mostrarProducto = $mostrarProductos->fetch_object()) {
          echo '<div class="col-md-4 product-men mt-md-0 mt-5">';
          echo '<div class="men-pro-item simpleCart_shelfItem">';
          echo '<div class="men-thumb-item text-center">';
          echo '<img class="img-fluid" src="' . base_url . 'uploads/images/productos/' . $mostrarProducto->imagen . '" alt="">';
          echo '<div class="men-cart-pro">';
          echo '</div>';
          echo '</div>';
          echo '<div class="item-info-product text-center border-top mt-4">';
          echo '<h4 class="pt-1">';
          echo '<a href="single.html">' . $mostrarProducto->nombre . '</a>' . '</br>';
          echo '<a href="single.html">' . $mostrarProducto->marca . '</a>' . '</br>';
          echo '<a href="single.html">' . $mostrarProducto->memoria_ram . ' Gb</a>';
          echo '</h4>';
          echo '<div class="info-product-price my-2">';
          echo '<span class="item_price"> $ ' . $mostrarProducto->precio . '</span> <del> ' . $mostrarProducto->oferta . ' %</del>';
          echo '</div>';
          echo '<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">';
          echo '<form action="' . base_url . 'Producto/descripcion&id=' . $mostrarProducto->id . '" method="POST">';
          echo '<fieldset>';
          echo '<input type="hidden" name="cmd" value="_cart" />';
          echo '<input type="hidden" name="add" value="1" />';
          echo '<input type="hidden" name="business" value=" " />';
          echo '<input type="hidden" name="item_name" value="Apple iPhone X" />';
          echo '<input type="hidden" name="amount" value="280.00" />';
          echo '<input type="hidden" name="discount_amount" value="1.00" />';
          echo '<input type="hidden" name="currency_code" value="USD" />';
          echo '<input type="hidden" name="return" value=" " />';
          echo '<input type="hidden" name="cancel_return" value=" " />';
          echo '<input type="submit" name="submit" value="ver Producto" class="button btn" />';
          echo '</fieldset>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        };
        echo '</div>';
        echo '</div>';
        echo '</div>';
      };
    } else {
      echo '<div class="alert alert-primary" role="alert">';
      echo 'No hay <strong>Productos</strong> con estas Característica';
      echo '</div>';
    };
  }

  public function descripcion()
  {
    // Capturo el Valor de Id  por GET
    $idProducto = isset($_GET['id']) ? $_GET['id'] : false;

    // Obtengo Ususario en el Banner
    $usuario = Utils::obtenerUsuario();

    // Obtengo Categorias en la Barra de Navegacion
    $categoriaBarraNavegacion = Utils::listaCategorias();

    // Obtengo Registro de Productos Por Id
    $idProducto = Utils::obtenerProductosPorId($idProducto);

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/producto/descripcion.php';
    require_once 'views/layout/footer.php';
  }
};
