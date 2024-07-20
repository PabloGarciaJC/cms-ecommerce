<div class="col-md-7 col-xl-8">
  <div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Gestionar Pedido</h5>
        </div>
        <!-- Respuesta Ajax mostrar Pedido -->
        <div id="respuestaPhpMostrarPedidos"></div>
      </div>
    </div>
  </div>
</div>
</div> 
</div> 

<!-- Modal Gestionar Pedido -->
<div class="modal fade" id="gestionarPedido" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Cambiar Estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="mdFormularioEstadoPedido" method="POST">
          <input type="hidden" id="idPedidos">
          <!-- Respuesta Ajax mostrar Pedido -->
          <div id="respuestaPhpEditarPedidos" style ="display: none"></div>
          <div class="form-group">
            <label for="estadoPedido">Estado del Pedido</label>
            <select class="form-control" id="estadoPedido">
              <option selected >Pendiente</option>
              <option >Confimardo</option>
              <option >Rechazado</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary mb-2">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- // Modal Gestionar Pedido -->