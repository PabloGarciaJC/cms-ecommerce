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
            <div class="row" style="margin: 0 auto">
              <!-- Original -->
              <div class="col">
                <input type="text" class="form-control" placeholder=" Buscador..." id="buscadorProductos">

                <br>
                <!-- Respuesta Ajax  -->
                <div id="respuestaPhpBuscadorProductos"></div>

                <!-- // Respuesta Ajax  -->
              </div>
              <!-- Original -->
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