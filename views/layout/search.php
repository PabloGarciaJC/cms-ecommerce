<div class="header-bot">
  <div class="container">
    <div class="row header-bot_inner_wthreeinfo_header_mid">
      <div class="col-md-3 logo_agile">
        <h1 class="text-center">
          <a href="/" class="font-weight-bold font-italic">
            <img src="<?= BASE_URL ?>assets/images/logo2.png" class="img-fluid">Electro Store
          </a>
        </h1>
      </div>
      <div class="col-md-9 header mt-4 mb-md-0 mb-4">
        <div class="row">
          <div class="col-10 agileits_search">
            <form class="form-inline" action="" id="formBuscadorGlobal" method="post">
              <input class="form-control mr-sm-2" type="search" placeholder="¿Qué deseas buscar?" aria-label="Search" name="buscadorGeneral" id="buscadorGlobal">
              <button type="submit" class="btn my-2 my-sm-0" data-ancla="solicita-informacion">Pusal Aqui</button>   
            </form>
          </div>
          <?php if (isset($_SESSION['usuarioRegistrado']) && Utils::accesoUsuarioAdmin() != true) : ?>
          <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
              <a href="<?= BASE_URL ?>carritoCompras/listar"> <img src="https://img.icons8.com/fluency/48/000000/shopping-cart-loaded.png" /></a>
            </div>
          </div>
          <?php endif ;?>
        </div>
      </div>
    </div>
  </div>
</div>



