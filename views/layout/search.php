<!-- header-bottom-->
<div class="header-bot">
  <div class="container">
    <div class="row header-bot_inner_wthreeinfo_header_mid">
      <!-- logo -->
      <div class="col-md-3 logo_agile">
        <h1 class="text-center">
          <a href="index.html" class="font-weight-bold font-italic">
            <img src="<?= base_url ?>assets/images/logo2.png" alt=" " class="img-fluid">Electro Store
          </a>
        </h1>
      </div>
      <!-- //logo -->
      <!-- header-bot -->
      
      <div class="col-md-9 header mt-4 mb-md-0 mb-4">
        <div class="row">
          <!-- search -->    
          <!-- <form action="">
            <button type="submit" class="ancla" data-ancla="solicita-informacion">Pusal Aqui</button>
          </form>  -->

          <div class="col-10 agileits_search">
            <form class="form-inline" action="" id="formBuscadorGlobal" method="post">
              <input class="form-control mr-sm-2" type="search" placeholder="¿Qué deseas buscar?" aria-label="Search" name="buscadorGeneral" id="buscadorGlobal">
              
              <button type="submit" class="btn my-2 my-sm-0" data-ancla="solicita-informacion">Pusal Aqui</button>
              
              <!-- <button class="btn my-2 my-sm-0"  type="submit">Buscar</button> -->
             
            </form>
          </div>
          <!-- //search -->
          <?php if (isset($_SESSION['usuarioRegistrado']) && Utils::accesoUsuarioAdmin() != true) : ?>
          <!-- cart details -->
          <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
              <a href="<?= base_url ?>carritoCompras/listar"> <img src="https://img.icons8.com/fluency/48/000000/shopping-cart-loaded.png" /></a>
            </div>
          </div>
          <!-- //cart details -->
          <?php endif ;?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- shop locator (popup) -->



<script>
  //   let buscadorGlobal = document.querySelector("#buscadorGlobal"); 

  //  console.log(buscadorGlobal);


  //   buscadorGlobal.addEventListener('keyup', (event) => {
  //     valorBuscador = event.path[0].value;
  //     console.log(valorBuscador);
  //   });


  // function ajaxBuscarProductos(valorBuscador) {
  //   $.ajax({
  //     type: 'POST',
  //     url: baseUrl + 'Producto/autocompletarBuscador',
  //     data: { buscadorProducto: valorBuscador },
  //   })
  //   .done(function (respuestaAjax) {
  //     var data = respuestaAjax;
  //     console.log(data);
  //     // alert(data);
  //   })
  //   .fail(function () {
  //     console.log("error");
  //   })
  //   .always(function () {
  //     console.log("completo");
  //   });
  // } 
</script>