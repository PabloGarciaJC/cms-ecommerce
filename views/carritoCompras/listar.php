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
          <h5 class="card-title mb-0">Carrito de Compras</h5>        
          <!-- Respuesta Ajax -->
          <div id="respuestaPhpMostrarCarritoCompras"></div>         
          <!-- Id Categoria Para Obtener el Producto -->
          <input type="hidden" id="idProductoCarritoCompras" value="<?= isset($_GET['id']) ? $_GET['id'] : false ?>">
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- Eliminar Categorias -->
<!-- //modal -->