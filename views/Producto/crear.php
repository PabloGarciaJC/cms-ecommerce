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
<br>
<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">

      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0"><?= isset($_GET['id']) ? 'Editar Producto' : 'Crear Producto' ?></h5>
        </div>
        <div class="card-body">

          <!-- Respuesta AJAX PHP  -->
          <div id="respuestaPhpGuardar"></div>
          <!-- style="display: none" -->

          <form action="" id="formularioProducto" method="POST" enctype="multipart/form-data">

            <div class="form-row ">

              <div class="form-group col-md-6 errorNombreProducto">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombreProducto" value="<?= isset($_GET['id']) ? $obtenerProductosPorId->nombre : false ?>">
                <label class="erroresValidacion"></label>
              </div>

              <!-- Para Actualizar lo Estoy Usando -->
              <input type="hidden" class="form-control" id="idProducto" value="<?= isset($_GET['id']) ? $obtenerProductosPorId->id : false ?>">
              <!-- // Para Actualizar lo Estoy Usando -->

              <div class="form-group col-md-6">
                <label for="">Elige Categoría</label>
                <select class="form-control" id="categoria">
                  <?= isset($_GET['id']) ? '<option selected="selected" value="' .  $obtenerProductosPorId->categoria_id . '"> ' .  $obtenerProductosPorId->nombreCategoria . ' </option>' : false ?>
                  <?php while ($categoriaProducto = $categoria->fetch_object()) : ?>
                    <option value="<?= $categoriaProducto->id ?>"><?= $categoriaProducto->categorias ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4 errorPrecioProducto">
                <label>Precio</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" id="precioProducto" value=" <?= isset($_GET['id']) ? $obtenerProductosPorId->precio : '0' ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><strong>$</strong></div>
                  </div>
                </div>
                <label class="erroresValidacion"></label>
              </div>

              <div class="form-group col-md-4 errorStockProducto">
                <label>Stock</label>
                <input type="text" class="form-control" id="stockProducto" value=" <?= isset($_GET['id']) ? $obtenerProductosPorId->stock : '0' ?>">
                <label class="erroresValidacion"></label>
              </div>

              <div class="form-group col-md-4 errorOfertaProducto">
                <label>Oferta</label>
                <select class="form-control" id="ofertaProducto">
                  <option value="5">5 % de Descuento</option>
                  <option value="10">10 % de Descuento</option>
                  <option value="20">20 % de Descuento</option>
                  <option value="30">30 % de Descuento</option>
                  <option value="40">40 % de Descuento</option>
                  <option value="50">50 % de Descuento</option>
                </select>
              </div>

            </div>
            <div class="form-row ">
              <div class="form-group col-md-6 errorMarcaProducto">
                <label>Marca</label>
                <input type="text" class="form-control" id="marcaProducto" value="<?= isset($_GET['id']) ? $obtenerProductosPorId->marca : false ?>">
                <label class="erroresValidacion"></label>
              </div>

              <div class="form-group col-md-6 errorMemoriaRamProducto">
                <label>Capacidad</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" id="memoriaRamProducto" value=" <?= isset($_GET['id']) ? $obtenerProductosPorId->memoria_ram : '0' ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><strong>Gb</strong></div>
                  </div>
                </div>
                <label class="erroresValidacion"></label>
              </div>
            </div>

            <div class="form-group errorDescripcionProducto">
              <label>Descripción</label>
              <textarea class="form-control" id="descripcionProducto" rows="3"><?= isset($_GET['id']) ? $obtenerProductosPorId->descripcion : false ?></textarea>
              <label class="erroresValidacion"></label>
            </div>

            <div class="product-sec1 px-sm-4 ">
              <div class="errorFileProducto">
                <p style="text-align: center;"><small>Formatos de la imagen JPG, JPEG, PNG y un peso Max de 1 MB, <strong>Recomendado 160 Ancho x 160 Alto</strong></small></p>
                <label class="erroresValidacion"></label>
              </div>
              <div class="row">
                <div class="col-md-4 product-men">
                  <!-- Vacio -->
                </div>
                <div class="col-md-4 product-men mt-md-0 mt-5">
                  <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item text-center">
                      <img class = "img-fluid" src="<?= base_url ?>assets/images/<?= isset($_GET['id']) ? $obtenerProductosPorId->imagen : false ?>" id="imagenProducto" alt="">
                    </div>
                    <div class="item-info-product text-center mt-4">
                      <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                        <label class="custom-file-upload">
                          <input type="file" / name="avatarSelecionado" id="archivoImagenProducto" onchange="vistaPreliminarImagenProducto(event)">
                          <span class="btn btn-primary"><i class="fa fa-upload"></i></span> <small>Subir Imagen</small>
                        </label>
                      </div><br>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 product-men">
                  <!-- Vacio -->
                </div>
              </div>
            </div>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary"><?= isset($_GET['id']) ? 'Editar' : 'Guardar' ?></button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
