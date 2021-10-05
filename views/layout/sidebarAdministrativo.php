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

          <?php if (isset($_SESSION['Admin'])) : ?>
            <a class="list-group-item list-group-item-action" href="#localitation">
              PruebaAdmin 1
            </a>
            <a class="list-group-item list-group-item-action" href="#localitation">
              PruebaAdmin 2
            </a>
            <a class="list-group-item list-group-item-action" href="#localitation">
              PruebaAdmin 3
            </a>
            <a class="list-group-item list-group-item-action" href="#localitation">
              PruebaAdmin 4
            </a>
          <?php endif; ?>

          <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
            <a class="list-group-item list-group-item-action" href="<?= base_url ?>Usuario/cerrarSesion">
              Cerrar Sesion
            </a>
          <?php endif; ?>
          
        </div>
      </div>
    </div>