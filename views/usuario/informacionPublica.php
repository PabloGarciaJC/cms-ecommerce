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
          <form action="" id="informacionPublica" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-8">
                <input type="hidden" value="<?= $_SESSION['usuarioRegistrado']->Id ?>" id="idUsuarioRegistrado">

                <!-- Respuesta de Informacion Publica -->
                <div id="respuestaPhpInformacionPublica" style="display: none"></div>

                <!-- Respuesta de avatarVistaPrevia, Nota: No me Devuelve 1-->
                <div id="respuestaPhpAvatarVistaPrevia" style="display: none"></div>

                <div class="form-group errorUsuario">
                  <label for="inputUsername">Alias</label>
                  <input type="text" class="form-control" placeholder="<?= $usuario->Usuario ?>" disabled>
                  <input type="hidden" class="form-control" value="<?= $usuario->Usuario ?>" name="usuario" id="usuario">
                  <label class="erroresValidacion"></label>
                </div>

                <div class="form-group errorDocumentacion">
                  <label for="inputUsername">Nro. de Documentación</label>
                  <input type="text" class="form-control" value="<?= $usuario->NumeroDocumento ?>" name="documentacion" id="documentacion">
                  <label class="erroresValidacion"></label>
                </div>

                <div class="form-group errorTelefono">
                  <label for="inputUsername">Nro. de Telefono</label>
                  <input type="text" class="form-control" name="telefono" value="<?= $usuario->NroTelefono ?>" id="telefono">
                  <label class="erroresValidacion"></label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="text-center">
                  <?php if ($usuario->Url_Avatar != null) : ?>
                    <!-- Imagen Seleciona con Javascript -->
                    <img src="<?= BASE_URL ?>uploads/images/avatar/<?= $usuario->Url_Avatar ?>" class="rounded-circle img-responsive mt-2" id="previe" width="128" height="128">
                  <?php else : ?>
                    <!-- Imagen Seleciona con Javascript -->
                    <img src="<?= BASE_URL ?>assets/images/avatar.png" class="rounded-circle img-responsive mt-2" id="previe" width="128" height="128">
                  <?php endif; ?>

                  <div class="mt-2 errorFile">
                    <label class="custom-file-upload">
                      <input type="file" / name="avatarSelecionado" id="file" onchange="vista_preliminar(event)">
                      <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                      Actualize el Avatar
                    </label>
                    <label class="erroresValidacion"></label>
                  </div>
                  <small>Use formato de la imagen jpg, jpeg, png y un peso Max de 1 MB, Recomendado 128 x 128</small> <br>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
      