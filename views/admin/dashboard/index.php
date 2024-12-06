<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">

  <?php include __DIR__ . '../../layout/sidebar.php'; ?>

  <main class="panel-admin__main-content">
    <section class="panel-admin__dashboard">
      <h2 class="panel-admin__dashboard-title">Estadísticas</h2>
      <div class="panel-admin__stats-overview">
        <div class="panel-admin__stat-card">
          <span class="panel-admin__stat-icon"><i class="fas fa-shopping-cart"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">120</h3>
            <p class="panel-admin__stat-label">Pedidos Pendientes</p>
          </div>
        </div>
        <div class="panel-admin__stat-card">
          <span class="panel-admin__stat-icon"><i class="fas fa-dollar-sign"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">$15,320</h3>
            <p class="panel-admin__stat-label">Ingresos Mensuales</p>
          </div>
        </div>
        <div class="panel-admin__stat-card">
          <span class="panel-admin__stat-icon"><i class="fas fa-box"></i></span>
          <div class="panel-admin__stat-info">
            <h3 class="panel-admin__stat-number">320</h3>
            <p class="panel-admin__stat-label">Productos en Inventario</p>
          </div>
        </div>
        <div class="panel-admin__stat-card">
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

    <!-- <section class="panel-admin__dashboard">
      <h2 class="panel-admin__dashboard-title">Gestión de Categorías</h2>

      <div class="panel-admin__category-form">
        <form action="ruta_para_guardar_categoria.php" method="POST">
          <div class="form-group">
            <label for="categoryName">Nombre de la Categoría:</label>
            <input type="text" id="categoryName" name="categoryName" class="form-control" placeholder="Ejemplo: Electrónica" required>
          </div>
          <div class="form-group">
            <label for="categoryDescription">Descripción:</label>
            <textarea id="categoryDescription" name="categoryDescription" class="form-control" placeholder="Descripción de la categoría..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Crear Categoría</button>
        </form>
      </div>

      <div class="panel-admin__subcategory-form mt-4">
        <h3>Crear Subcategoría</h3>
        <form action="ruta_para_guardar_subcategoria.php" method="POST">
          <div class="form-group">
            <label for="parentCategory">Categoría Principal:</label>
            <select id="parentCategory" name="parentCategory" class="form-control" required>
              <option value="">Seleccionar Categoría</option>
              <option value="1">Electrónica</option>
              <option value="2">Ropa</option>
            </select>
          </div>
          <div class="form-group">
            <label for="subcategoryName">Nombre de la Subcategoría:</label>
            <input type="text" id="subcategoryName" name="subcategoryName" class="form-control" placeholder="Ejemplo: Smartphones" required>
          </div>
          <div class="form-group">
            <label for="subcategoryDescription">Descripción:</label>
            <textarea id="subcategoryDescription" name="subcategoryDescription" class="form-control" placeholder="Descripción de la subcategoría..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Crear Subcategoría</button>
        </form>
      </div>

      <div class="panel-admin__category-list mt-5">
        <h3>Categorías Existentes</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Categoría</th>
              <th>Descripción</th>
              <th>Subcategorías</th>
              <th>Acciones</th>
              <th>Ver Productos</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Electrónica</td>
              <td>Todo lo relacionado con tecnología y dispositivos electrónicos.</td>
              <td>
                <ul>
                  <li>Smartphones</li>
                  <li>Laptops</li>
                </ul>
              </td>
              <td>
                <button class="btn btn-warning btn-sm">Editar</button>
                <button class="btn btn-danger btn-sm">Eliminar</button>
              </td>
              <td>
                <a href="productos.php?categoria=1" class="btn btn-info btn-sm">Ver Productos</a>
              </td>
            </tr>
            <tr>
              <td>Ropa</td>
              <td>Categoría de ropa para hombres, mujeres y niños.</td>
              <td>
                <ul>
                  <li>Hombre</li>
                  <li>Mujer</li>
                </ul>
              </td>
              <td>
                <button class="btn btn-warning btn-sm">Editar</button>
                <button class="btn btn-danger btn-sm">Eliminar</button>
              </td>
              <td>
                <a href="productos.php?categoria=2" class="btn btn-info btn-sm">Ver Productos</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </section> -->








  </main>

</div>