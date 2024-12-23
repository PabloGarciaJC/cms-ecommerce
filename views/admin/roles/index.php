<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestionar de Roles</h2>
            
            <div class="panel-admin__stats-overview mt-3">
                <a href="<?php echo BASE_URL; ?>Admin/crearRoles" class="panel-admin__stat-card">
                    <span class="panel-admin__stat-icon"><i class="fas fa-user"></i></span>
                    <div class="panel-admin__stat-info">
                        <h3 class="panel-admin__stat-number">Añadir Rol</h3>
                    </div>
                </a>
            </div>

            <?php if (isset($_SESSION['exito'])) : ?>
                <div class="alert <?php echo $_SESSION['messageClass']; ?> alert-dismissible fade show mt-2 text-center" role="alert">
                    <i class="<?php echo isset($_SESSION['icon']) ? $_SESSION['icon'] : 'fas fa-check-circle'; ?>"></i>
                    <?php echo $_SESSION['exito']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['exito'], $_SESSION['messageClass'], $_SESSION['icon']); ?>
            <?php endif; ?>

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
<?php unset($_SESSION['exito'], $_SESSION['messageClass']); ?>
<?php unset($_SESSION['errores']); ?>