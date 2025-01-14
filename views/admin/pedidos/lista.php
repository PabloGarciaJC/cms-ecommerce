<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Pedidos</h2>
            <?php if (isset($_SESSION['exito'])): ?>
                <div class="alert alert-success text-center">
                    <?php echo $_SESSION['exito']; ?>
                </div>
                <?php unset($_SESSION['exito']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['errores'])): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $_SESSION['errores']; ?>
                </div>
                <?php unset($_SESSION['errores']); ?>
            <?php endif; ?>
            <div class="panel-admin__category-list">
                <div class="table-responsive" style="max-height: 500px; overflow-y: auto; overflow-x: auto;">
                    <table class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">ID Pedido</th>
                                <th class="text-center align-middle">Usuario</th>
                                <th class="text-center align-middle">Productos</th>
                                <th class="text-center align-middle">Total</th>
                                <th class="text-center align-middle">Fecha</th>
                                <th class="text-center align-middle">Estado</th>
                                <th class="text-center align-middle">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaPedidos as $pedido): ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $pedido->pedido_id; ?></td>
                                    <td class="text-center align-middle"><?php echo $pedido->nombre_usuario; ?></td>
                                    <td class="text-center align-middle"><?php echo $pedido->productos; ?></td>
                                    <td class="text-center align-middle">$<?php echo number_format($pedido->coste, 2); ?></td>
                                    <td class="text-center align-middle">
                                        <?php echo date('d/m/Y', strtotime($pedido->fecha)); ?>
                                    </td>
                                    <?php if ($_SESSION['usuarioRegistrado']->rol_nombre == 'Admin'): ?>
                                        <td class="text-center align-middle">
                                            <form method="POST" action="<?php echo BASE_URL; ?>Admin/actualizarPedidos">
                                                <select name="estado" class="form-control form-select-movil" required>
                                                    <?php foreach ($estados as $estado): ?>
                                                        <option value="<?php echo $estado; ?>" <?php echo $estado == $pedido->estado ? 'selected' : ''; ?>>
                                                            <?php echo $estado; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                        </td>
                                    <?php else: ?>
                                        <td class="text-center align-middle">
                                            <?php echo $pedido->estado; ?>
                                        </td>
                                        <td class="align-middle">
                                            <a href="<?php echo BASE_URL; ?>Admin/detallePedido?id=<?php echo $pedido->pedido_id; ?>&url=listaPedidos" class="btn btn-info btn-sm">Ver Detalles</a>
                                        </td>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['usuarioRegistrado']->rol_nombre == 'Admin'): ?>
                                        <td class="text-center align-middle">
                                            <input type="hidden" name="pedido_id" value="<?php echo $pedido->pedido_id; ?>" />
                                            <button type="submit" class="btn btn-success btn-sm">Actualizar Estado</button>
                                            </form>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>

<?php
unset($_SESSION['errores']);
unset($_SESSION['form']);
unset($_SESSION['exito']);
?>