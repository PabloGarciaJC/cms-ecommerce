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
                            <!-- Buscador Administrativo -->
                            <input type="text" class="form-control" placeholder=" Buscador..." id="buscadorProductos">
                            <!-- //Buscador Administrativo -->
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- Respuesta Ajax  -->
                    <div id="respuestaPhpBuscadorProductos"></div>
                    <!-- // Respuesta Ajax  -->
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