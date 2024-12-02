<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0"><?php echo isset($_GET['id']) ? 'Editar Producto' : 'Crear Producto' ?></h5>
        </div>
        <div class="card-body">

          <form action="<?php echo BASE_URL; ?>Producto/guardar" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo isset($_GET['id']) ? $_GET['id'] : false ?>" name="idProducto">
            <div class="form-row justify-content-center mb-4">
              <div class="col-md-4 text-center">
                <?php if (isset($_GET['id']) != null): ?>
                  <img src="<?php echo BASE_URL ?>uploads/images/productos/<?php echo isset($_GET['id']) ? $obtenerProductosPorId->imagen : '' ?>" class="img-fluid mt-2 previe">
                <?php else: ?>
                  <img src="<?php echo BASE_URL ?>uploads/images/productos/producto_thumbnail.png" class="img-fluid mt-2 previe">
                <?php endif; ?>
                <div class="mt-2">
                  <label class="custom-file-upload">
                    <input type="file" name="avatarSelecionado" id="file" class="file-img">
                    <span class="btn btn-primary"><i class="fa fa-upload"></i> Subir Imagen</span>
                  </label>
                </div>
                <small class="text-muted d-block">Formato jpg, jpeg, png. Máximo: 1 MB. Tamaño recomendado: 128x128.</small>
                <?php if (isset($_SESSION['erroresProductos']['imagen'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['erroresProductos']['imagen']; ?></div>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombreProducto" value="<?php echo isset($_GET['id']) ? $obtenerProductosPorId->nombre : '' ?>">
                <?php if (isset($_SESSION['erroresProductos']['nombreProducto'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['erroresProductos']['nombreProducto']; ?></div>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-6">
                <label for="">Elige Categoría</label>
                <select class="form-control" name="categoria">
                  <?php echo isset($_GET['id']) ? '<option selected="selected" value="' .  $obtenerProductosPorId->categoria_id . '"> ' .  $obtenerProductosPorId->nombreCategoria . ' </option>' : '' ?>
                  <?php while ($categoriaProducto = $categoria->fetch_object()) : ?>
                    <option value="<?php echo $categoriaProducto->id ?>"><?php echo $categoriaProducto->categorias ?></option>
                  <?php endwhile; ?>
                </select>
                <?php if (isset($_SESSION['erroresProductos']['categoria'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['erroresProductos']['categoria']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Precio</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="precioProducto" value="<?php echo isset($_GET['id']) ? $obtenerProductosPorId->precio : '0' ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><strong>$</strong></div>
                  </div>
                </div>
                <?php if (isset($_SESSION['erroresProductos']['precioProducto'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['erroresProductos']['precioProducto']; ?></div>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-4">
                <label>Stock</label>
                <input type="text" class="form-control" name="stockProducto" value="<?php echo isset($_GET['id']) ? $obtenerProductosPorId->stock : '0' ?>">
                <?php if (isset($_SESSION['erroresProductos']['stockProducto'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['erroresProductos']['stockProducto']; ?></div>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-4">
                <label>Oferta</label>
                <select class="form-control" name="ofertaProducto">
                  <option value="5">5 % de Descuento</option>
                  <option value="10">10 % de Descuento</option>
                  <option value="20">20 % de Descuento</option>
                  <option value="30">30 % de Descuento</option>
                  <option value="40">40 % de Descuento</option>
                  <option value="50">50 % de Descuento</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Marca</label>
                <input type="text" class="form-control" name="marcaProducto" value="<?php echo isset($_GET['id']) ? $obtenerProductosPorId->marca : '' ?>">
                <?php if (isset($_SESSION['erroresProductos']['marcaProducto'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['erroresProductos']['marcaProducto']; ?></div>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-6 form-capacidad">
                <label>Capacidad</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="memoriaRamProducto" value="<?php echo isset($_GET['id']) ? $obtenerProductosPorId->memoria_ram : '0' ?>">
                  <div class="input-group-prepend">
                    <select class="form-control">
                      <option value="KB">Kilobytes (KB)</option>
                      <option value="MB">Megabytes (MB)</option>
                      <option value="GB">Gigabytes (GB)</option>
                      <option value="TB">Terabytes (TB)</option>
                      <option value="PB">Petabytes (PB)</option>
                      <option value="EB">Exabytes (EB)</option>
                      <option value="ZB">Zettabytes (ZB)</option>
                      <option value="YB">Yottabytes (YB)</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea class="form-control" name="descripcionProducto" rows="3"><?php echo isset($_GET['id']) ? $obtenerProductosPorId->descripcion : '' ?></textarea>
              <?php if (isset($_SESSION['erroresProductos']['descripcionProducto'])): ?>
                <div class="text-danger"><?php echo $_SESSION['erroresProductos']['descripcionProducto']; ?></div>
              <?php endif; ?>
            </div>

            <div class="form-group text-right">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>


          </form>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>



</div>
</div>
</div>
</div>