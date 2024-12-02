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

    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    
    require_once 'views/admin/sidebar.php';
    require_once 'views/Producto/crear.php';
    require_once 'views/layout/footer.php';
  }

  public function guardar()
  {
      // Acceso Usuario Registrado a esta Página
      Utils::accesoUsuarioRegistrado();
  
      // POST
      $nombreProducto = isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : false;
      $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : false;
      $idCategoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
      $precioProducto = isset($_POST['precioProducto']) ? $_POST['precioProducto'] : false;
      $stockProducto = isset($_POST['stockProducto']) ? $_POST['stockProducto'] : false;
      $ofertaProducto = isset($_POST['ofertaProducto']) ? $_POST['ofertaProducto'] : false;
      $marcaProducto = isset($_POST['marcaProducto']) ? $_POST['marcaProducto'] : false;
      $memoriaRamProducto = isset($_POST['memoriaRamProducto']) ? $_POST['memoriaRamProducto'] : false;
      $descripcionProducto = isset($_POST['descripcionProducto']) ? $_POST['descripcionProducto'] : false;
  
      // Instancio y Seteo indiferentemente de la Condición
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
  
      // Array para almacenar los errores
      $errores = [];
  
      if (empty($nombreProducto)) {
          $errores['nombreProducto'] = "El nombre del producto es obligatorio.";
      }
  
      if (empty($precioProducto)) {
          $errores['precioProducto'] = "El precio es obligatorio.";
      }
  
      if (empty($stockProducto)) {
          $errores['stockProducto'] = "El stock es obligatorio.";
      }
  
      if (empty($marcaProducto)) {
          $errores['marcaProducto'] = "La marca es obligatoria.";
      }
  
      if (empty($descripcionProducto)) {
          $errores['descripcionProducto'] = "La descripción es obligatoria.";
      }
  
      if (empty($idCategoria)) {
          $errores['categoria'] = "La categoria es obligatoria.";
      }
  
      // Validación de la imagen
      $nombreArchivoFinal = null;
  
      if (isset($_FILES['avatarSelecionado']) && $_FILES['avatarSelecionado']['error'] == 0) {
          // Si se carga una nueva imagen
          $nombreArchivo = $_FILES['avatarSelecionado']['name'];
          $rutaTemporal = $_FILES['avatarSelecionado']['tmp_name'];
          $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
          $nombreArchivoFinal = time() . '.' . $extension;
          $rutaFinal = 'uploads/images/productos/' . $nombreArchivoFinal;
  
          if (move_uploaded_file($rutaTemporal, $rutaFinal)) {
              $producto->setImagen($nombreArchivoFinal);
          }
      } elseif ($idProducto) {
          // Si no se carga una nueva imagen y es una actualización, obtener la imagen actual
          $productoActual = Utils::obtenerProductosPorId($idProducto);
          if ($productoActual && $productoActual->imagen) {
              $producto->setImagen($productoActual->imagen);
          }
      }
  
      // Si no hay imagen nueva ni imagen previa, asignar la imagen por defecto
      if (empty($producto->getImagen())) {
          $producto->setImagen('producto_thumbnail.png'); // Ruta de la imagen por defecto
      }
  
      // Si hay errores, mostrar y no guardar el producto
      if (count($errores) > 0) {
          $_SESSION['erroresProductos'] = $errores;
          header("Location: " . BASE_URL . "Producto/crear");
          exit();
      }
  
      // Limpiar los errores y los datos del formulario después de procesar
      unset($_SESSION['erroresProductos']);
      unset($_SESSION['exitoProductos']);
  
      // Guardar el producto
      if ($idProducto) {
          $producto->actualizar();
          $_SESSION['exitoProductos'] = "La información se actualizó correctamente.";
      } else {
          $producto->crear();
          $_SESSION['exitoProductos'] = "La información se creó correctamente.";
      }
  
      // Redirigir después de guardar el producto
      header("Location: " . BASE_URL . "Producto/listar");
      exit();
  }
  


  public function listar()
  {
    // Acceso Usuario Registrado a esta Página
    Utils::accesoUsuarioRegistrado();

    // Obtengo Usuario en el Banner
    $usuario = Utils::obtenerUsuario();

    // Obtengo Categorias en la Barra de Navegación
    $categoriaBarraNavegacion = Utils::listaCategorias();

    // Capturo el buscador 
    $buscadorProductos = isset($_GET['buscadorProductos']) ? $_GET['buscadorProductos'] : false;

    // Paginador 1: Extraer el Conteo de Registros de la Base de Datos
    $totalRegistrosBd = Utils::obtenerRegistrosTotales($buscadorProductos);

    // Obtengo los productos para la página actual
    $productos = Utils::obtenerProductosyBuscadoryPaginador($buscadorProductos, 0, $totalRegistrosBd);

    // Cargar las vistas
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    
    require_once 'views/Producto/listar.php';
    require_once 'views/layout/footer.php';
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
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    
     
    require_once 'views/Producto/mostrar.php';
    require_once 'views/layout/footer.php';
  }

  public function eliminar()
  {
    // Acceso Usuario Registrado a esta Página
    Utils::accesoUsuarioRegistrado();
    $idProducto = isset($_GET['idProducto']) ? $_GET['idProducto'] : false;
    $producto = new Productos();
    $producto->setId($idProducto);
    $producto->eliminar();
   
    // Redirigir después de guardar el producto
    header("Location: " . BASE_URL . "Producto/listar");
    exit();
  }

  public function autocompletarBuscador()
  {
    $accionaBuscador = isset($_POST['accionaBuscador']) ? $_POST['accionaBuscador'] : false;
    $listado  =  Utils::listarAutocompletado($accionaBuscador);
    $arrayListados = array();
    while ($filas = $listado->fetch_assoc()) {
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
          echo '<a href="' . BASE_URL . 'Producto/descripcion&id=' . $mostrarProducto->id . '"><img class="img-fluid" src="' . BASE_URL . 'uploads/images/productos/' . $mostrarProducto->imagen . '" alt="' . $mostrarProducto->imagen . '"></a>';
          echo '<div><span>Oferta:</span> <del>' . $mostrarProducto->oferta . ' % </del></div>';

          echo '<div class="item-info-product text-center border-top mt-4">';
          echo '<a href="' . BASE_URL . 'Producto/descripcion&id=' . $mostrarProducto->id . '" class="pt-1">';
          echo '<div class="item-info-product-title">' . $mostrarProducto->nombre . '</div>';
          echo '<div class="item-info-product-description"><span>Precio:</span> ' . $mostrarProducto->precio . ' $ </div>';
          echo '<div class="item-info-product-description"><span>Marca:</span> ' . $mostrarProducto->marca . '</div>';
          echo '<div class="item-info-product-description"><span>Capacidad:</span> ' . $mostrarProducto->memoria_ram . ' Gb</div>';
          echo '</a>';
          echo '<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out item-info-product-btn">';
          echo '<form action="' . BASE_URL . 'Producto/descripcion&id=' . $mostrarProducto->id . '" method="POST">';
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
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    
    require_once 'views/Producto/descripcion.php';
    require_once 'views/layout/footer.php';
  }
};
