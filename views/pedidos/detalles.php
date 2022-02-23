<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Detalles del Pedido</h5>
        </div>

        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Alias</label>
              <input type="text" class="form-control" id="" name="alias" value="<?= $usuarioPorPedido->Usuario ?>" disabled>
            </div>
            <div class="form-group col-md-6">
              <label>Email</label>
              <input type="text" class="form-control" id="" name="email" value="<?= $usuarioPorPedido->Email ?>" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Nombre</label>
              <input type="text" class="form-control" id="" name="nombre" value="<?= $usuarioPorPedido->Nombres ?>" disabled>
            </div>
            <div class="form-group col-md-6">
              <label>Apellido</label>
              <input type="text" class="form-control" id="" name="apellidos" value="<?= $usuarioPorPedido->Apellidos ?>" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Dirección</label>
              <input type="text" class="form-control" id="" name="direccion" value="<?= $usuarioPorPedido->Direccion ?>" disabled>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Numero de Teléfono </label>
              <input type="text" class="form-control" id="" name="telefono" value="<?= $usuarioPorPedido->NroTelefono ?>" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Pais</label>
              <input type="text" class="form-control" id="" name="pais" value="<?= $usuarioPorPedido->Pais ?>" disabled>
            </div>

            <div class="form-group col-md-4">
              <label for="inputState">Ciudad/Región</label>
              <input type="text" class="form-control" id="" name="ciudad" value="<?= $usuarioPorPedido->Ciudad ?>" disabled>
            </div>

            <div class="form-group col-md-4 errorCodigoPostal">
              <label for="inputZip">Código Postal</label>
              <input type="text" class="form-control" id="" name="CodigoPostal" value="<?= $usuarioPorPedido->CodigoPostal ?>" disabled>
            </div>
          </div>
        </div>

        <!-- Tabla -->
        <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">

          <thead>
            <tr>
              <th scope="col" style=" text-align: center;">Imagen</th>
              <th scope="col" style=" text-align: center;">Productos</th>
              <th scope="col" style=" text-align: center;">Unidades</th>
            </tr>
          </thead>

          <tbody>
            <?php while ($mostrarProducto = $mostrarProductos->fetch_object()) : ?>
              <tr>
                <td style=" text-align: center;">
                  <img class="img-fluid" src="<?= base_url ?>uploads/images/productos/<?= $mostrarProducto->imagen ?>">
                </td>
                <td style=" text-align: center;">
                  <strong>Nombre:</strong> <?= $mostrarProducto->nombre ?><br>
                  <strong>Marca:</strong> <?= $mostrarProducto->marca ?><br>
                  <strong>Precio:</strong> <?= $mostrarProducto->precio ?> <br>
                  <strong>Oferta:</strong> <?= $mostrarProducto->oferta ?><br>
                  <strong>Categoria:</strong> <?= $mostrarProducto->nombreCategoria ?> <br>
                </td>
                <td style=" text-align: center;"><br><br><?= $mostrarProducto->unidades ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div><!-- Fin Footer -->
</div> <!-- Fin Footer -->
</div> <!-- Fin Footer -->