<style>
  select {
    outline: none;
  }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container p-0">
  <div class="row">
    <div class="col-md-5 col-xl-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Panel Administrativo</h5>
        </div>
        <div class="list-group list-group-flush">
          <!-- <a class="list-group-item list-group-item-action"  href="<?= base_url ?>Usuario/panelAdministrativo">
            Mi Perfil
          </a>
          <a class="list-group-item list-group-item-action"  href="<?= base_url ?>Usuario/cambioPassword">
            Cambio de contraseña
          </a>
          <a class="list-group-item list-group-item-action"  href="#orders">
            Mis Pedidos
          </a>
          <a class="list-group-item list-group-item-action"  href="#localitation">
            Localizador
          </a> -->


          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <a class="list-group-item list-group-item-action" href="<?= base_url ?>Usuario/informacionGeneral">
              Información General
            </a>
          <?php endif; ?>


          <?php if (isset($_SESSION['Admin'])) : ?>
            <a class="list-group-item list-group-item-action" href="<?= base_url ?>Categoria/gestionarCategorias">
              Gestionar Categorias
            </a>
            <div class="list-group-item list-group-item-action">
              <a data-toggle="collapse" href="#homeSubmenu" aria-expanded="false" aria-controls="dateposted" class="dropdown-toggle" style="color: #495057;">Gestión Productos </a>
            </div>

            <div class="collapse" id="homeSubmenu">
              <div class="custom-control custom-checkbox" style="padding-top: 10px;">
                &#x23f5; <a href="<?= base_url ?>Producto/crear" style="color: #495057;">Crear</a>
              </div>

              <div class="custom-control custom-checkbox"> 
                &#x23f5; <a href="<?= base_url ?>Producto/listar" style="color: #495057;">Lista</a>
              </div>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <div class="list-group-item list-group-item-action">
              <a data-toggle="collapse" href="#submenuCarritoCompras" aria-expanded="false" aria-controls="dateposted" class="dropdown-toggle" style="color: #495057;">Carrito de Compras </a>
            </div>
            <div class="collapse" id="submenuCarritoCompras">
              <div class="custom-control custom-checkbox" style="padding-top: 10px;">
                &#x23f5; <a href="<?= base_url ?>CarritoCompras/listar" style="color: #495057;">Mis Pedidos</a> 
              </div>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <a class="list-group-item list-group-item-action" href="<?= base_url ?>Usuario/cerrarSesion">
              Cerrar Sesion
            </a>
          <?php endif; ?>

        </div>
      </div>
    </div>