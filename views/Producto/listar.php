<!-- Estilos de Input File  -->
<style>
  .erroresValidacion {
    color: red;
  }

  .table tbody tr td {
    text-align: center;
    vertical-align: middle;
    border-top: 1px solid #e7ebee;
  }
</style>

<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Lista de Productos</h5>
          <div id="respuestaPhpEliminarProducto" style="text-align: center; display: none"></div>
        </div>
        <div class="card-body">

          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade active show" id="inbox" aria-labelledby="inbox-tab" role="tabpanel">
                    <div class="row p-4 no-gutters align-items-center">
                      <div class="col-sm-12 col-md-2">
                      </div>
                      <div class="col-sm-12 col-md-10">
                        <ul class="list-inline dl mb-0 float-left float-md-right">
                          <li class="list-inline-item text-info mr-3">

                            <form action="<?= base_url ?>Producto/buscardor" method="POST">
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="buscador" name="buscar" placeholder="Buscar">
                                <button type="submit" class="btn btn-primary">
                                  <i class="fas fa-search"></i>
                                </button>
                              </div>
                            </form>

                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                        <tbody>
                          <thead>
                            <tr>
                              <th scope="col" style=" text-align: center;">Productos</th>
                              <th scope="col" style=" text-align: center;">Precio</th>
                              <th scope="col" style=" text-align: center;">Oferta</th>
                              <th scope="col" style=" text-align: center;">Categoria</th>
                              <th scope="col" style=" text-align: center;">Editar</th>
                              <th scope="col">Borrar</th>
                            </tr>
                          </thead>
                        <tbody>
                          <?php if ($productos->num_rows > 0) : ?>
                            <?php while ($mostrarProductos = $productos->fetch_object()) : ?>
                              <tr>
                                <td> <?= $mostrarProductos->nombre ?><br>
                                  Marca: <?= $mostrarProductos->marca ?><br>
                                  Stock: <?= $mostrarProductos->stock ?> </td>
                                <td><?= $mostrarProductos->precio ?></td>
                                <td><?= $mostrarProductos->oferta ?></td>
                                <td><?= $mostrarProductos->nombreCategoria ?></td>
                                <td>
                                  <a href="<?= base_url ?>Producto/crear&id=<?= $mostrarProductos->id ?>">
                                    <button class="btn btn-circle btn-info text-white" class="text-white" onclick="obtenerDatosEditar(<?= $mostrarProductos->id ?>, '<?= $mostrarProductos->nombre ?>')">
                                      <i class="fa fa-pencil"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>
                                  <button class="btn btn-circle btn-danger text-white" onclick="eliminarDatosProducto(<?= $mostrarProductos->id ?>, '<?= $mostrarProductos->nombre ?>');">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                </td>
                              </tr>
                            <?php endwhile; ?>
                          <?php else : ?>
                            <td colspan="8">No hay ningun registro</td>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>

                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-end">
                        <!-- Anterior -->
                        <?php if ($pagina != 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= base_url ?>Producto/listar&pag=<?= $pagina - 1 ?>">Anterior</a>
                          </li>
                        <?php else : ?>
                          <li class="page-item disabled">
                            <a class="page-link" href="">Anterior</a>
                          </li>
                        <?php endif; ?>
                        <!-- Cuerpo -->
                        <?php for ($i = 1; $i <= $mostrarNumerosdePaginas; $i++) : ?>
                          <?php if ($i == $pagina) : ?>
                            <li class="page-item active"><a class="page-link" href="#"><?= $i ?></a></li>
                          <?php else : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url ?>Producto/listar&pag=<?= $i ?>"><?= $i ?></a></li>
                          <?php endif; ?>
                        <?php endfor; ?>
                        <!-- Siguiente -->
                        <?php if ($pagina != $mostrarNumerosdePaginas) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= base_url ?>Producto/listar&pag=<?= $pagina + 1 ?>">Siguente</a>
                          </li>
                        <?php else : ?>
                          <li class="page-item disabled">
                            <a class="page-link" href="">Siguente</a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
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

<!-- Eliminar Categorias -->

<!-- //modal -->