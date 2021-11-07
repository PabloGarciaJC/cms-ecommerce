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

    if (isset($_GET['id'])) {
      $obtenerProductosPorId = Utils::obtenerProductosPorId($_GET['id']);
    }

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/search.php';
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/Producto/crear.php';
    require_once 'views/layout/footer.php';
  }

  public function guardar()
  {
    //POST
    $nombreProducto = isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : false;
    $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : false;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
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
    }

    if (empty($stockProducto)) {
      $errores["stockProducto"] = "Debe completar Stock";
    }

    if (empty($ofertaProducto)) {
      $errores["ofertaProducto"] = "Debe completar Oferta";
    }

    if (empty($marcaProducto)) {
      $errores["marcaProducto"] = "Debe completar Marca";
    }

    if (empty($descripcionProducto)) {
      $errores["descripcionProducto"] = "Debe completar Descripcion";
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
    $producto->setIdCategoria($categoria);
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

    // Paginador 1: Extraer el Total d Registros y Cantidad de Registro a Mostrar
    $obtenerRegistros = Utils::obtenerRegistrosTotales();
    $totalRegistrosBd = $obtenerRegistros->registros_totales;
    $mostrarRegistros = 5;

    // Paginador 2: Valido Si PAG Existe en GET 
    empty($_GET['pag']) ? $pagina = 1 : $pagina = $_GET['pag'];

    // Paginador 3: Obtener Ultimo Registro de la Pagina y mostrarNumerosdePaginas
    $ultimoRegistro = ($pagina - 1) * $mostrarRegistros;
    $mostrarNumerosdePaginas = ceil($totalRegistrosBd / $mostrarRegistros);

    // Imprimo Lista y Capturo el Buscador de Productos 
    isset($_GET['buscador']) ? $productos = Utils::obtenerProductosyBuscador($_GET['buscador']) : $productos = Utils::obtenerProductosYPaginador($ultimoRegistro, $mostrarRegistros);

    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/search.php';
    require_once 'views/layout/sidebarAdministrativo.php';
    require_once 'views/Producto/listar.php';
    require_once 'views/layout/footer.php';
  }

  public function buscardor()
  {
    $buscando = $_POST['buscar'];
    header("location: " . base_url . "Producto/listar&buscador=" . $buscando);
  }

  public function eliminar()
  {
    $id = $_POST['id'];
    $producto = new Productos();
    $producto->setId($id);
    $eliminado = $producto->eliminar();
    if ($eliminado) {
      echo 1;
    }
  }
}
