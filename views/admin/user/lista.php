<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Lista de Usuarios</h2>

            <div class="panel-admin__category-list">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">ID</th>
                            <th class="text-center align-middle">Usuario</th>
                            <th class="text-center align-middle">Nombres</th>
                            <th class="text-center align-middle">Apellidos</th>
                            <th class="text-center align-middle">Email</th>
                            <th class="text-center align-middle">Telefono</th>
                            <th class="text-center align-middle">Direccion</th>
                            <th class="text-center align-middle">Pais</th>
                            <th class="text-center align-middle">Ciudad</th>
                            <th class="text-center align-middle">Codigo Postal</th>
                            <th class="text-center align-middle">Rol</th>
                            <th class="text-center align-middle">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($usuario = $usuarios->fetch_object()): ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $usuario->usuario_id; ?></td>
                                <td class="text-center align-middle"><?php echo $usuario->usuario_alias; ?></td>
                                <td class="text-center align-middle"><?php echo $usuario->usuario_nombres; ?></td>
                                <td class="text-center align-middle"><?php echo $usuario->usuario_apellidos; ?></td>
                                <td class="text-center align-middle"><?php echo $usuario->usuario_email; ?></td>
                                <td class="text-center align-middle"><?php echo $usuario->usuario_telefono; ?></td>
                                <td><?php echo $usuario->usuario_direccion; ?></td>
                                <td><?php echo $usuario->usuario_pais; ?></td>
                                <td><?php echo $usuario->usuario_ciudad; ?></td>
                                <td><?php echo $usuario->usuario_codigo_postal; ?></td>
                                <td><?php echo $usuario->rol_nombre; ?></td>

                                <td class="text-center align-middle">
                                    <a href="<?php echo BASE_URL; ?>Admin/detalleUsuario?id=<?php echo $usuario->Id; ?>" class="btn btn-info btn-sm">Ver Perfil</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>