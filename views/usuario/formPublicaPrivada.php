<!-- Estilos de Input File  -->
<style>
  input[type="file"] {
    display: none;
  }

  .custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
  }

  .erroresValidacion {
    color: red;
  }
</style>

<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Información pública</h5>
        </div>
    
        <div class="card-body">
          <form action="<?= base_url ?>Usuario/InformacionPublica" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-8">

                <input type="hidden" value="<?= $_SESSION['usuarioRegistrado']->Id ?>" name="id">

                <div class="form-group">
                  <label for="inputUsername">Alias</label>
                  <input type="text" class="form-control" name="usuario" value="<?= isset($_SESSION['repoblar']['usuario']) ? $_SESSION['repoblar']['usuario'] : $usuario->Usuario ?>">
                  <div class="erroresValidacion"><?= isset($_SESSION['errores']['alias']) ? $_SESSION['errores']['alias'] : false; ?></div>
                </div>

                <div class="form-group">
                  <label for="inputUsername">Nro. de Documentación</label>
                  <input type="text" class="form-control" name="nroDocumentacion" value="<?= isset($_SESSION['repoblar']['documentacion']) ? $_SESSION['repoblar']['documentacion'] : $usuario->NumeroDocumento ?>">
                  <div class="erroresValidacion"><?= isset($_SESSION['errores']['documentacion']) ? $_SESSION['errores']['documentacion'] : false; ?></div>
                </div>

                <div class="form-group">
                  <label for="inputUsername">Nro. de Telefono</label>
                  <input type="text" class="form-control" name="telefono" value="<?= isset($_SESSION['repoblar']['telefono']) ? $_SESSION['repoblar']['telefono'] : $usuario->NroTelefono ?>">
                  <div class="erroresValidacion"><?= isset($_SESSION['errores']['telefono']) ? $_SESSION['errores']['telefono'] : false; ?></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="text-center">
                  <?php if ($usuario->Url_Avatar != null) : ?>
                    <!-- Imagen Seleciona con Javascript -->
                    <img src="<?= base_url ?>uploads/images/avatar/<?= $usuario->Url_Avatar ?>" class="rounded-circle img-responsive mt-2" id="previe" width="128" height="128">
                  <?php else : ?>
                    <!-- Imagen Seleciona con Javascript -->
                    <img src="<?= base_url ?>assets/images/avatar.png" class="rounded-circle img-responsive mt-2" id="previe" width="128" height="128">
                  <?php endif; ?>

                  <div class="mt-2">
                    <label class="custom-file-upload">
                      <input type="file" / name="avatarSelecionado" id="file" onchange="vista_preliminar(event)">
                      <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                      Actualize el Avatar
                    </label>
                  </div>

                  <small>Use formato de la imagen jpg, jpeg, png y un peso Max de 1 MB, Recomendado 315 x 315</small> <br>
                  <div class="erroresValidacion"><?= isset($_SESSION['errores']['formatosAvatar']) ? $_SESSION['errores']['formatosAvatar'] : false; ?></div>
                  <div class="erroresValidacion"><?= isset($_SESSION['errores']['pesoMaxAvatar']) ? $_SESSION['errores']['pesoMaxAvatar'] : false; ?></div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Información Privada</h5>
        </div>
        <div class="card-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nombres</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Apellidos</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>País</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">Estado</label>
                <select id="inputState" class="form-control">
                  <option selected="">Seleccione...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Código Postal</label>
                <input type="text" class="form-control" id="inputZip">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php Utils::borrarSesionErrores() ?>