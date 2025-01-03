<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Detalle del Pedido #<?php echo $pedidoDetails->pedido_id; ?></h2>

            <div class="panel-admin__category-list">
                <table class="table table-bordered">
                    <tr>
                        <th>Usuario</th>
                        <td><?php echo $pedidoDetails->usuario_id; ?></td>
                    </tr>
                    <tr>
                        <th>Productos</th>
                        <td><?php echo $pedidoDetails->productos; ?></td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td><?php echo $pedidoDetails->direccion; ?></td>
                    </tr>
                    <tr>
                        <th>Código Postal</th>
                        <td><?php echo $pedidoDetails->codigoPostal; ?></td>
                    </tr>
                    <tr>
                        <th>País</th>
                        <td><?php echo $pedidoDetails->pais; ?></td>
                    </tr>
                    <tr>
                        <th>Ciudad</th>
                        <td><?php echo $pedidoDetails->ciudad; ?></td>
                    </tr>
                    <tr>
                        <th>Coste</th>
                        <td><?php echo $pedidoDetails->coste; ?> €</td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td><?php echo $pedidoDetails->estado; ?></td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td><?php echo date('d/m/Y', strtotime($pedidoDetails->fecha)); ?></td>
                    </tr>
                    <tr>
                        <th>Hora</th>
                        <td><?php echo date('H:i', strtotime($pedidoDetails->hora)); ?></td>
                    </tr>
                </table>
            </div>

            <a href="<?php echo BASE_URL; ?>Admin/<?php echo isset($_GET['url']) ? $_GET['url'] : false; ?>" class="btn btn-primary btn-sm">Volver a la lista de pedidos</a>

        </section>
    </main>
</div>
