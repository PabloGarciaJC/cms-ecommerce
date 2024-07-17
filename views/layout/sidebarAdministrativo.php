<style>
  select {
    outline: none;
  }
</style>

<br>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container p-0">
  <div class="row">
    <div class="col-md-5 col-xl-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Panel Administrativo</h5>
        </div>
        <div class="list-group list-group-flush">
          <!-- Para Ambos -->
          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>Usuario/informacionGeneral">
              Información General
            </a>
          <?php endif; ?>
          <!-- Para el Admin  -->
          <?php if (Utils::accesoUsuarioAdmin()) : ?>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>Categoria/gestionarCategorias">
              Gestionar Categorias
            </a>
            <div class="list-group-item list-group-item-action">
              <a data-toggle="collapse" href="#homeSubmenu" aria-expanded="false" aria-controls="dateposted" class="dropdown-toggle" style="color: #495057;">Gestionar Productos </a>
            </div>
            <div class="collapse" id="homeSubmenu">
              <div class="custom-control custom-checkbox" style="padding-top: 10px;">
                &#x23f5; <a href="<?= BASE_URL ?>Producto/crear" style="color: #495057;">Crear</a>
              </div>
              <div class="custom-control custom-checkbox">
                &#x23f5; <a href="<?= BASE_URL ?>Producto/listar" style="color: #495057;">Lista</a>
              </div>
            </div>
          <?php endif; ?>
          <!-- Para Cliente Comun -->
          <?php if (isset($_SESSION['usuarioRegistrado']) && Utils::accesoUsuarioAdmin() != true) : ?>
            <div class="list-group-item list-group-item-action">
              <a data-toggle="collapse" href="#submenuCarritoCompras" aria-expanded="false" aria-controls="dateposted" class="dropdown-toggle" style="color: #495057;">Carrito de Compras </a>
            </div>
            <div class="collapse" id="submenuCarritoCompras">
              <div class="custom-control custom-checkbox" style="padding-top: 10px;">
                &#x23f5; <a href="<?= BASE_URL ?>CarritoCompras/listar" style="color: #495057;">Cesta</a>
              </div>
            </div>
          <?php endif; ?>
          <!-- Para Ambos -->
          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <div class="list-group-item list-group-item-action">
              <a data-toggle="collapse" href="#gestionPedidos" aria-expanded="false" aria-controls="dateposted" class="dropdown-toggle" style="color: #495057;">Gestionar Pedidos </a>
            </div>
            <div class="collapse" id="gestionPedidos">
              <div class="custom-control custom-checkbox" style="padding-top: 10px;">
                &#x23f5; <a href="<?= BASE_URL ?>Pedidos/listar" style="color: #495057;">Listar</a>
              </div>
            </div>
          <?php endif; ?>
          <!-- Para Ambos -->
          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>Usuario/cerrarSesion">
              Cerrar Sesion
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>