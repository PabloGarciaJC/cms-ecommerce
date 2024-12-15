<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestionar de Roles</h2>
            <div class="panel-admin__stats-overview">
                <a href="<?php echo BASE_URL; ?>Admin/crearRoles" class="panel-admin__stat-card w-50">
                    <span class="panel-admin__stat-icon"><i class="fas fa-user"></i></span>
                    <div class="panel-admin__stat-info">
                        <h3 class="panel-admin__stat-number">Añadir Rol</h3>
                    </div>
                </a>
            </div>
            <div class="panel-admin__category-list">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Roles</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($rol = $obtenerRoles->fetch_object()): ?>
                        <tr>
                            <td><?php echo $rol->nombre; ?></td>
                            <td><?php echo $rol->descripcion; ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>Admin/crearRoles?editid=<?php echo $rol->id; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?php echo BASE_URL; ?>Admin/crearRoles?deleteid=<?php echo $rol->id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>