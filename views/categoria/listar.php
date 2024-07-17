<!-- Estilos de Input File  -->
<style>
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
          <h5 class="card-title mb-0">Gestionar Categorías</h5>
        </div>
        <div class="card-body">
          <!-- Categorias -->
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade active show" id="inbox" aria-labelledby="inbox-tab" role="tabpanel">
                    <div>
                      <div class="row p-4 no-gutters align-items-center">
                        <div class="col-sm-12 col-md-2">
                        </div>
                        <div class="col-sm-12 col-md-10">
                          <ul class="list-inline dl mb-0 float-left float-md-right">
                            <li class="list-inline-item text-info mr-3">
                              <a href="#" data-toggle="modal" data-target="#modalCrearCategoria" class="text-white">
                                <button class="btn btn-circle btn-success text-white">
                                  <i class="fa fa-plus"></i>
                                </button>
                                <span class="ml-2 font-normal text-dark">Crear Categoria</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="table-responsive">
                        <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                          <tbody>
                            <thead>
                              <tr>
                                <th scope="col">Categoría</th>
                                <th scope="col">Subcategoría</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Borrar</th>
                              </tr>
                            </thead>
                          <tbody>
                            <?php while ($listaCategorias = $categoria->fetch_object()) : ?>
                              <tr>
                                <td><?= $listaCategorias->categorias ?></td>
                                <td>Desactivado</td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#modalEditarCategoria">
                                    <button class="btn btn-circle btn-info text-white" class="text-white" onclick="obtenerDatosEditar(<?= $listaCategorias->id ?>, '<?= $listaCategorias->categorias ?>')">
                                      <i class="fa fa-pencil"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>
                                  <button class="btn btn-circle btn-danger text-white" onclick="eliminarDatoss(<?= $listaCategorias->id ?>, '<?= $listaCategorias->categorias ?>');">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                </td>
                              </tr>
                            <?php endwhile; ?>
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
</div>
</div>

<!-- Listar Categorias -->
<div class="modal fade" id="modalCrearCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="mdFormularioListarCategoria">
          <!-- respuesta ajax php -->
          <div id="respuestaPhplistarCategoria" style="text-align: center; display: none"></div>
          <div class="form-group errorListarCategoria">
            <label class="col-form-label ">Crear Categorías</label>
            <input type="text" class="form-control" id="listarCategoria" name="listarCategoria">
            <label class="erroresValidacion"></label>
          </div>
          <div class="form-group">
            <label class="col-form-label">Crear Sub Categorias</label>
            <input type="text" class="form-control" id="listarSubcategoria" name="listarSubCategorias" disabled>
            <label class="erroresValidacion"></label>
          </div>
          <div class="right-w3l">
            <input type="submit" class="form-control" value="Aceptar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Editar Categorias -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Gestionar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="mdFormularioActualizarCategoria">
          <input type="hidden" id="idCategoria">
          <div id="respuestaPhpEditarCategoria" style="display: none"></div>
          <div class="form-group mdErrorCategoria errorCategoria">
            <label class="col-form-label ">Editar Categoría</label>
            <input type="text" class="form-control" id="editarCategoria" name="actualizarCategoria">
            <label class="erroresValidacion"></label>
          </div>
          <div class="form-group mdErrorSubCategorias">
            <label class="col-form-label">Editar Sub Categoría</label>
            <input type="text" class="form-control" id="crearSubcategoria" name="crearSubCategorias" disabled>
          </div>
          <div class="right-w3l">
            <input type="submit" class="form-control" value="Aceptar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>