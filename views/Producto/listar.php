<div class="col-md-7 col-center">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Lista de Productos</h5>
        </div>
        <div class="card-body">

          <div class="container">
            <div class="row">
              <div class="col">

                <?php if (isset($_SESSION['exitoProductos'])): ?>
                  <div class="alert alert-success mensaje-exito">
                    <?php echo $_SESSION['exitoProductos']; ?>
                  </div>
                  <?php unset($_SESSION['exitoProductos']); ?>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>Producto/listar" method="GET" enctype="multipart/form-data" class="d-flex align-items-center" style="gap: 10px;">
                  <input type="text" class="form-control" placeholder="Buscador..." id="buscadorProductos" name="buscadorProductos">
                  <button type="submit" class="btn btn-primary">Buscar</button>
                </form>

                <div class="container mt-4">
                  <div class="table table-responsive">
                    <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                      <thead>
                        <tr>
                          <th scope="col" style="text-align: center;">Imagen</th>
                          <th scope="col" style="text-align: center;">Productos</th>
                          <th scope="col" style="text-align: center;">Editar</th>
                          <th scope="col" style="text-align: center;">Borrar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($productos->num_rows > 0): ?>
                          <?php while ($mostrarProductos = $productos->fetch_object()): ?>
                            <tr>
                              <td><img class="img-fluid" src="<?php echo BASE_URL . 'uploads/images/productos/' . $mostrarProductos->imagen; ?>" style="max-width: 100px; height: auto;"></td>
                              <td>
                                <strong>Nombre:</strong> <?php echo $mostrarProductos->nombre; ?><br>
                                <strong>Marca:</strong> <?php echo $mostrarProductos->marca; ?><br>
                                <strong>Precio:</strong> <?php echo $mostrarProductos->precio . " $"; ?><br>
                                <strong>Oferta:</strong> <?php echo $mostrarProductos->oferta . " %"; ?><br>
                                <strong>Stock:</strong> <?php echo $mostrarProductos->stock . " Unidades"; ?><br>
                                <strong>Categoria:</strong> <?php echo $mostrarProductos->nombreCategoria; ?><br>
                                <strong>Descripción: <a href="<?php echo BASE_URL . 'Producto/crear&id=' . $mostrarProductos->id; ?>">ver más</a></strong>
                              </td>
                              <td>
                                <a href="<?php echo BASE_URL . 'Producto/crear?id=' . $mostrarProductos->id; ?>" class="btn btn-circle btn-info text-white">
                                  <i class="fa fa-pencil"></i>
                                </a>
                              </td>
                              <td>
                                <a href="<?php echo BASE_URL . 'Producto/eliminar?idProducto=' . $mostrarProductos->id; ?>" class="btn btn-circle btn-danger text-white">
                                  <i class="fa fa-trash"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endwhile; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="4" class="text-center">
                              <div class="alert alert-primary" role="alert">
                                No hay <strong>Productos</strong> con estas Características
                              </div>
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>