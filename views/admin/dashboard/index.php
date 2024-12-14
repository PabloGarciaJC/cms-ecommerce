<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">

  <?php include __DIR__ . '../../layout/sidebar.php'; ?>

  <main class="panel-admin__main-content">
    <section class="panel-admin__dashboard">
      <h2 class="panel-admin__dashboard-title">Estadísticas</h2>
      <div class="panel-admin__stats-overview">
        <div class="panel-admin__stat-card w-100">
          <span class="panel-admin__stat-icon"><i class="fas fa-shopping-cart"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">120</h3>
            <p class="panel-admin__stat-label">Pedidos Pendientes</p>
          </div>
        </div>
        <div class="panel-admin__stat-card w-100">
          <span class="panel-admin__stat-icon"><i class="fas fa-dollar-sign"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">$15,320</h3>
            <p class="panel-admin__stat-label">Ingresos Mensuales</p>
          </div>
        </div>
        <div class="panel-admin__stat-card w-100">
          <span class="panel-admin__stat-icon"><i class="fas fa-box"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">320</h3>
            <p class="panel-admin__stat-label">Productos en Inventario</p>
          </div>
        </div>
        <div class="panel-admin__stat-card w-100">
          <span class="panel-admin__stat-icon"><i class="fas fa-users"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">1,250</h3>
            <p class="panel-admin__stat-label">Clientes Registrados</p>
          </div>
        </div>
      </div>
      <!-- Gráficos -->
      <div class="panel-admin__charts">
        <div class="panel-admin__chart">
          <h3>Ventas Mensuales</h3>
          <canvas id="salesChart"></canvas> <!-- Usarás Chart.js o similar -->
        </div>
        <div class="panel-admin__chart">
          <h3>Productos Más Vendidos</h3>
          <canvas id="productsChart"></canvas>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      // Gráfico de Ventas Mensuales
      const salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
          labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
          datasets: [{
            label: 'Ventas',
            data: [500, 1000, 1500, 2000, 2500, 3000],
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            fill: true,
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top'
            }
          }
        }
      });

      // Gráfico de Productos Más Vendidos
      const productsChart = new Chart(document.getElementById('productsChart'), {
        type: 'bar',
        data: {
          labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D'],
          datasets: [{
            label: 'Unidades Vendidas',
            data: [100, 150, 200, 300],
            backgroundColor: ['#007bff', '#6c757d', '#28a745', '#ffc107']
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top'
            }
          }
        }
      });
    </script>
  </main>

</div>