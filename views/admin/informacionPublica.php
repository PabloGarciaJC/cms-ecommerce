<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Información General</h5>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['exito'])): ?>
            <div class="alert alert-success mensaje-exito">
              <?php echo $_SESSION['exito']; ?>
            </div>
            <?php unset($_SESSION['exito']); ?>
          <?php endif; ?>
          <form action="<?php echo BASE_URL; ?>Admin/informacionPublica" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $_SESSION['usuarioRegistrado']->Id ?>" name="id" id="idUsuarioRegistrado">
            <div class="form-row justify-content-center mb-4">
              <div class="col-md-4 text-center">
                <?php if ($usuario->Url_Avatar != null): ?>
                  <img src="<?= BASE_URL ?>uploads/images/avatar/<?= $usuario->Url_Avatar ?>" class="rounded-circle img-fluid mt-2 previe" style="max-width: 128px; height: auto;">
                <?php else: ?>
                  <img src="<?= BASE_URL ?>assets/images/avatar.png" class="rounded-circle img-fluid mt-2 previe" style="max-width: 128px; height: auto;">
                <?php endif; ?>
                <div class="mt-2">
                  <label class="custom-file-upload">
                    <input type="file" name="avatarSelecionado" id="file" class="file-img">
                    <span class="btn btn-primary"><i class="fa fa-upload"></i> Subir Avatar</span>
                  </label>
                </div>
                <small class="text-muted d-block">Formato jpg, jpeg, png. Máximo: 1 MB. Tamaño recomendado: 128x128.</small>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="usuario">Alias</label>
                    <input type="text" class="form-control" placeholder="<?= $usuario->Usuario ?>" disabled>
                    <input type="hidden" class="form-control" value="<?= $usuario->Usuario ?>" name="usuario">
                    <?php if (isset($_SESSION['errores']['usuario'])): ?>
                      <div class="text-danger"><?php echo $_SESSION['errores']['usuario']; ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="documentacion">Nro. de Documentación</label>
                    <input type="text" class="form-control" value="<?= isset($_SESSION['form_data']['documentacion']) ? $_SESSION['form_data']['documentacion'] : $usuario->NumeroDocumento ?>" name="documentacion">
                    <?php if (isset($_SESSION['errores']['documentacion'])): ?>
                      <div class="text-danger"><?php echo $_SESSION['errores']['documentacion']; ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="telefono">Nro. de Teléfono</label>
                    <input type="text" class="form-control" value="<?= isset($_SESSION['form_data']['telefono']) ? $_SESSION['form_data']['telefono'] : $usuario->NroTelefono ?>" name="telefono">
                    <?php if (isset($_SESSION['errores']['telefono'])): ?>
                      <div class="text-danger"><?php echo $_SESSION['errores']['telefono']; ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" value="<?= isset($_SESSION['form_data']['nombre']) ? $_SESSION['form_data']['nombre'] : $usuario->Nombres ?>" name="nombre">
                    <?php if (isset($_SESSION['errores']['nombre'])): ?>
                      <div class="text-danger"><?php echo $_SESSION['errores']['nombre']; ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control" value="<?= isset($_SESSION['form_data']['apellido']) ? $_SESSION['form_data']['apellido'] : $usuario->Apellidos ?>" name="apellido">
                    <?php if (isset($_SESSION['errores']['apellido'])): ?>
                      <div class="text-danger"><?php echo $_SESSION['errores']['apellido']; ?></div>
                    <?php endif; ?>
                  </div>
                     <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control w-100" value="<?= isset($_SESSION['form_data']['direccion']) ? $_SESSION['form_data']['direccion'] : $usuario->Direccion ?>" name="direccion">
                    <?php if (isset($_SESSION['errores']['direccion'])): ?>
                      <div class="text-danger"><?php echo $_SESSION['errores']['direccion']; ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pais">País</label>
                    <select class="form-control" id="pais" name="pais">
                      <option><?php echo isset($paisesActual) ? $paisesActual->Pais : 'Seleccione...' ?> </option>
                      <?php while ($fila = mysqli_fetch_array($paisesTodos)): ?>
                        <option value="<?php echo $fila['Id'] ?>"
                          <?php echo (isset($_SESSION['form_data']['pais']) && $_SESSION['form_data']['pais'] == $fila['Id']) || ($usuario->Pais == $fila['Pais']) ? 'selected' : '' ?>>
                          <?php echo $fila['Pais'] ?>
                        </option>
                      <?php endwhile; ?>
                    </select>
                    <?php if (isset($_SESSION['errores']['pais'])): ?>
                      <div class="invalid-feedback"><?= $_SESSION['errores']['pais'] ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="ciudad">Ciudad/Región</label>
                    <select class="form-control" id="ciudad" name="ciudad" disabled>
                      <option value="">Seleccione...</option>
                      <?php if ($usuario->Ciudad): ?>
                        <option selected><?= $usuario->Ciudad ?></option>
                      <?php endif; ?>
                    </select>
                    <?php if (isset($_SESSION['errores']['ciudad'])): ?>
                      <div class="invalid-feedback"><?= $_SESSION['errores']['ciudad'] ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="codigoPostal">Código Postal</label>
                    <input type="text" class="form-control" name="codigoPostal" value="<?= $_SESSION['form_data']['codigoPostal'] ?? $usuario->CodigoPostal ?>">
                    <?php if (isset($_SESSION['errores']['codigoPostal'])): ?>
                      <div class="invalid-feedback"><?= $_SESSION['errores']['codigoPostal'] ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="form-row justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Cierre de la sección -->
    </div>
  </div>
</div>
</div>
</div>