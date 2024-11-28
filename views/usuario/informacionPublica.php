<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Información pública</h5>
        </div>
        <div class="card-body">

          <?php if (isset($_SESSION['exito'])): ?>
            <div class="alert alert-success" id="mensajeExito">
              <?php echo $_SESSION['exito']; ?>
            </div>
            <?php unset($_SESSION['exito']); ?>
          <?php endif; ?>

          <form action="<?php echo BASE_URL; ?>Usuario/informacionPublica" id="informacionPublica" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-8">
                <input type="hidden" value="<?= $_SESSION['usuarioRegistrado']->Id ?>" name="id" id="idUsuarioRegistrado">

                <!-- Alias Field -->
                <div class="form-group">
                  <label for="inputUsername">Alias</label>
                  <input type="text" class="form-control" placeholder="<?= $usuario->Usuario ?>" disabled>
                  <input type="hidden" class="form-control" value="<?= $usuario->Usuario ?>" name="usuario" id="usuario">
                  <?php if (isset($_SESSION['errores']['usuario'])): ?>
                    <div class="text-danger"><?php echo $_SESSION['errores']['usuario']; ?></div>
                  <?php endif; ?>
                </div>

                <!-- Nro. de Documentación -->
                <div class="form-group">
                  <label for="inputUsername">Nro. de Documentación</label>
                  <input type="text" class="form-control" value="<?= isset($_SESSION['form_data']['documentacion']) ? $_SESSION['form_data']['documentacion'] : $usuario->NumeroDocumento ?>" name="documentacion" id="documentacion">
                  <?php if (isset($_SESSION['errores']['documentacion'])): ?>
                    <div class="text-danger"><?php echo $_SESSION['errores']['documentacion']; ?></div>
                  <?php endif; ?>
                </div>

                <!-- Nro. de Teléfono -->
                <div class="form-group">
                  <label for="inputUsername">Nro. de Telefono</label>
                  <input type="text" class="form-control" value="<?= isset($_SESSION['form_data']['telefono']) ? $_SESSION['form_data']['telefono'] : $usuario->NroTelefono ?>" name="telefono" id="telefono">
                  <?php if (isset($_SESSION['errores']['telefono'])): ?>
                    <div class="text-danger"><?php echo $_SESSION['errores']['telefono']; ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-md-4">
                <div class="text-center">
                  <?php if ($usuario->Url_Avatar != null) : ?>
                    <img src="<?= BASE_URL ?>uploads/images/avatar/<?= $usuario->Url_Avatar ?>" class="rounded-circle img-responsive mt-2" id="previe" width="128" height="128">
                  <?php else : ?>
                    <img src="<?= BASE_URL ?>assets/images/avatar.png" class="rounded-circle img-responsive mt-2" id="previe" width="128" height="128">
                  <?php endif; ?>
                  <div class="mt-2">
                    <label class="custom-file-upload">
                      <input type="file" name="avatarSelecionado" id="file" class="file-img">
                      <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                      Actualice el Avatar
                    </label>
                  </div>
                  <small>Use formato de la imagen jpg, jpeg, png y un peso Max de 1 MB, Recomendado 128 x 128</small> <br>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>

        </div>
      </div>