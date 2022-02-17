<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Confirmar el Pedido</h5>
        </div>

        <div class="card-body">
          <!-- <form action="<?= base_url ?>Pedidos/guardar" method="POST"> -->
          <form action="" id="confimarPedido" method="POST">

            <div class="form-row">
              <div class="form-group col-md-6">

                <!-- Usuario Id -->
                <input type="hidden" class="form-control" id="usuarioIdCarrito" name="usuarioId" value="<?= $usuario->Id ?>">
                <!-- // Usuario Id -->

                <label>Alias</label>
                <input type="text" class="form-control" id="aliasCarrito" name="alias" value="<?= $usuario->Usuario ?>" disabled>
              </div>
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="text" class="form-control" id="emailCarrito" name="email" value="<?= $usuario->Email ?>" disabled>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombreCarrito" name="nombre" value="<?= $usuario->Nombres ?>" disabled>
              </div>
              <div class="form-group col-md-6">
                <label>Apellido</label>
                <input type="text" class="form-control" id="apellidosCarrito" name="apellidos" value="<?= $usuario->Apellidos ?>" disabled>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Dirección</label>
                <input type="text" class="form-control" id="direccionCarrito" name="direccion" value="<?= $usuario->Direccion ?>" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Numero de Teléfono </label>
                <input type="text" class="form-control" id="telefonoCarrito" name="telefono" value="<?= $usuario->NroTelefono ?>" disabled>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Pais</label>
                <input type="text" class="form-control" id="paisCarrito" name="pais" value="<?= $usuario->Pais ?>" disabled>
              </div>

              <div class="form-group col-md-4">
                <label for="inputState">Ciudad/Región</label>
                <input type="text" class="form-control" id="ciudadCarrito" name="ciudad" value="<?= $usuario->Ciudad ?>" disabled>
              </div>

              <div class="form-group col-md-4 errorCodigoPostal">
                <label for="inputZip">Código Postal</label>
                <input type="text" class="form-control" id="CodigoPostalCarrito" name="CodigoPostal" value="<?= $usuario->CodigoPostal ?>" disabled>
              </div>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">

                <label>Total a Pagar</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" id="totalPagarCarrito" name="totalPagar" value="<?= $stats['total'] ?>" disabled>
                  <div class="input-group-prepend">
                    <div class="input-group-text"><strong>$</strong></div>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label>Total</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" id="stockTotalesCarrito" name="stockTotales" value="<?= $stats['stockTotales'] ?>" disabled>
                  <div class="input-group-prepend">
                    <div class="input-group-text"><strong>Unidades</strong></div>
                  </div>
                </div>
              </div>
            </div>

            <a href="<?= base_url ?>CarritoCompras/listar" class="btn btn-danger">ver Cesta</a>

            <button type="submit" class="btn btn-primary">Confirmar Pedido</button>
          </form>
        </div>

        <!-- Respuesta Ajax Confimar Pedido -->
        <div id="respuestaPhpConfimarPedido" style="display: none;"></div>
        <!-- // Respuesta Ajax Confimar Pedido -->

        <br>
        <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">

          <thead>
            <tr>
              <th scope="col" style="text-align: center;">Imagen</th>
              <th scope="col" style="text-align: center;">Producto</th>
              <th scope="col" style="text-align: center;">Unidades</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($_SESSION['carrito'] as $indice => $mostrarProducto) : ?>
              <tr>
                <td><img class="img-fluid" style="margin:auto; display:block;" src="<?= base_url ?>uploads/images/productos/<?= $mostrarProducto['imagen'] ?>"></td>
                <td style="text-align: center;">
                  <br>
                  <a href="<?= base_url ?>Producto/descripcion&id=<?= $mostrarProducto['idProducto'] ?>">
                    <strong>Nombre:</strong> <?= $mostrarProducto['nombre'] ?><br>
                    <strong>Nombre:</strong> <?= $mostrarProducto['marca'] ?><br>
                    <strong>Nombre:</strong> <?= $mostrarProducto['precio'] ?><br>
                    <strong>Nombre:</strong> <?= $mostrarProducto['oferta'] ?><br>
                    <strong>Nombre:</strong> <?= $mostrarProducto['nombreCategoria'] ?>
                  </a>
                </td>
                <td style="text-align: center;"><br> <br> <br> <?= $mostrarProducto['stock'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div><!-- Fin Footer -->
</div> <!-- Fin Footer -->
</div> <!-- Fin Footer -->