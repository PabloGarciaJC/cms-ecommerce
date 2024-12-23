<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
  <?php include __DIR__ . '../../layout/sidebar.php'; ?>
  <main class="panel-admin__main-content">
    <section class="panel-admin__dashboard">
      <h2 class="panel-admin__dashboard-title">Bienvenido, <?php echo $usuario->Usuario; ?>!</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="panel-admin__stats-overview">
            <div class="row w-100">
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="panel-admin__stat-card w-100">
                  <span class="panel-admin__stat-icon"><i class="fas fa-dollar-sign"></i></span>
                  <div class="panel-admin__stat-info">
                    <h3 class="panel-admin__stat-number">$<?php echo number_format($ingresosMensuales ?? 0.00, 2); ?></h3>
                    <p class="panel-admin__stat-label">Ingresos Mensuales</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="panel-admin__stat-card w-100">
                  <span class="panel-admin__stat-icon"><i class="fas fa-box"></i></span>
                  <div class="panel-admin__stat-info">
                    <h3 class="panel-admin__stat-number"><?php echo $totalProductos ?? 0; ?></h3>
                    <p class="panel-admin__stat-label">Productos en Inventario</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="panel-admin__stat-card w-100">
                  <span class="panel-admin__stat-icon"><i class="fas fa-users"></i></span>
                  <div class="panel-admin__stat-info">
                    <h3 class="panel-admin__stat-number"><?php echo $totalClientes ?? 0; ?></h3>
                    <p class="panel-admin__stat-label">Clientes Registrados</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="panel-admin__stat-card w-100">
                  <span class="panel-admin__stat-icon"><i class="fas fa-users"></i></span>
                  <div class="panel-admin__stat-info">
                    <h3 class="panel-admin__stat-number"><?php echo $pedidosCompletados ?? 0; ?></h3>
                    <p class="panel-admin__stat-label">Pedidos Completados</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="panel-admin__stat-card w-100">
                  <span class="panel-admin__stat-icon"><i class="fas fa-shopping-cart"></i></span>
                  <div class="panel-admin__stat-info">
                    <h3 class="panel-admin__stat-number"><?php echo $pedidosPendientes ?? 0; ?></h3>
                    <p class="panel-admin__stat-label">Pedidos Pendientes</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="panel-admin__stat-card w-100">
                  <span class="panel-admin__stat-icon"><i class="fas fa-dollar-sign"></i></span>
                  <div class="panel-admin__stat-info">
                    <h3 class="panel-admin__stat-number">$<?php echo number_format($ventasTotales ?? 0.00, 2); ?></h3>
                    <p class="panel-admin__stat-label">Ventas Totales</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-admin__orders-history">
        <h3>Historial de Pedidos</h3>
        <table class="table table-striped mt-4 text-center">
          <thead>
            <tr>
              <th>ID Pedido</th>
              <th>Cliente</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($historialPedidos as $pedido): ?>
              <tr>
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo $pedido['cliente']; ?></td>
                <td><?php echo $pedido['estado']; ?></td>
                <td><?php echo $pedido['fecha']; ?></td>
                <td class="align-middle">
                  <a href="<?php echo BASE_URL; ?>Admin/detallePedido?id=<?php echo $pedido['id']; ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>
