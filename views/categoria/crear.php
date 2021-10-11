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
          <h5 class="card-title mb-0">Gestionar Categorías</h5>
        </div>
        <div class="card-body">
          <!-- Tes -->
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
                                <span class="ml-2 font-normal text-dark">Crear</span>
                              </a>
                            </li>

                            <li class="list-inline-item text-info mr-3">
                              <a href="#" data-toggle="modal" data-target="#modalActualizarCategoria" class="text-white">
                                <button class="btn btn-circle btn-info text-white">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <span class="ml-2 font-normal text-dark">Actualizar</span>
                              </a>
                            </li>

                            <li class="list-inline-item text-danger">
                              <a href="#">
                                <button class="btn btn-circle btn-danger text-white">
                                  <i class="fa fa-trash"></i>
                                </button>
                                <span class="ml-2 font-normal text-dark">Borrar</span>
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
                                <th scope="col">Id</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Subcategoría</th>
                                <th scope="col">Fecha de Creación</th>
                              </tr>
                            </thead>
                          <tbody>
                            <tr>
                              <th scope="row">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="cst1" />
                                  <label class="custom-control-label" for="cst1">&nbsp;</label>
                                </div>
                              </th>
                              <td>
                                "Ikki"
                              </td>
                              <td>Desactivado</td>
                              <td><i class="fa fa-paperclip text-muted"></i> @mdo</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- //Tes -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- crear Categorias -->
<div class="modal fade" id="modalCrearCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Añadir Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" method="POST" id="mdFormularioCrearCategoria">

          <!-- respuesta ajax php -->
          <div id="respuestaPhpCrearCategoria" style="text-align: center; display: none"></div>

          <div class="form-group mdErrorCategoria">
            <label class="col-form-label ">Añadir Categorías</label>
            <input type="text" class="form-control" id="crearCategoria" name="crearCategoria">
          </div>

          <div class="form-group mdErrorSubCategorias">
            <label class="col-form-label">Añadir Sub Categorias</label>
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
<!-- //modal -->

<!-- Actualizar Categorias -->
<div class="modal fade" id="modalActualizarCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" method="POST" id="mdFormularioActualizarCategoria">

          <!-- respuesta ajax php -->
          <div id="respuestaPhpActualizarCategoria" style="text-align: center; display: none"></div>

          <div class="form-group mdErrorCategoria">
            <label class="col-form-label ">Actualizar Categorías</label>
            <input type="text" class="form-control" id="actualizarCategoria" name="actualizarCategoria">
          </div>

          <div class="form-group mdErrorSubCategorias">
            <label class="col-form-label">Añadir Sub Categorias</label>
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
<!-- //modal -->