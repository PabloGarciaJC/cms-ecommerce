<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Información Privada</h5>
  </div>
  <div class="card-body">
    <form action="" id="informacionPrivada" method="">
      <input type="hidden" value="<?= $_SESSION['usuarioRegistrado']->Id ?>" id="id" name="id">
      <div id="respuestaPhpInformacionPrivada" style="display: none"></div>
      <div class="form-row ">
        <div class="form-group col-md-6 errorNombre">
          <label>Nombres</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario->Nombres ?>">
          <label class="erroresValidacion"></label>
        </div>
        <div class="form-group col-md-6 errorApellido">
          <label>Apellidos</label>
          <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $usuario->Apellidos ?>">
          <label class=" erroresValidacion"></label>
        </div>
      </div>
      <div class="form-group errorEmail">
        <label>Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $usuario->Email ?>" disabled>
        <label class="erroresValidacion"></label>
      </div>
      <div class="form-group errorDireccion">
        <label>Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $usuario->Direccion ?>">
        <label class="erroresValidacion"></label>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputState">País</label>
          <select class="form-control" id="pais" name="pais" onchange="mostrarCodigoPaises()">
            <?php if ($usuario->Pais == "") : ?>
              <option selected="">Seleccione...</option>
              <?php while ($fila = mysqli_fetch_array($paisesTodos)) : ?>
                <option value="<?= $fila['Id'] ?>"><?= $fila['Pais'] ?></option>
              <?php endwhile; ?>
            <?php else : ?>
              <option selected=""><?= $usuario->Pais ?></option>
              <?php while ($fila = mysqli_fetch_array($paisesTodos)) : ?>
                <option value="<?= $fila['Id'] ?>"><?= $fila['Pais'] ?></option>
              <?php endwhile; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="inputState">Ciudad/Región</label>
          <select class="form-control" id="ciudad" name="ciudad" disabled>
            <?php if ($usuario->Ciudad == "") : ?>
              <option selected="">Seleccione...</option>
            <?php else : ?>
              <option selected=""><?= $usuario->Ciudad ?></option>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group col-md-4 errorCodigoPostal">
          <label for="inputZip">Código Postal</label>
          <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?= $usuario->CodigoPostal ?>">
          <label class="erroresValidacion"></label>
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