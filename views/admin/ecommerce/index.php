<style>

</style>

<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>

    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Ecommerce</h2>

            <div class="panel-admin__stats-overview">
                <a href="<?php echo BASE_URL ?>Admin/categorias" class="panel-admin__stat-card">
                    <span class="panel-admin__stat-icon"><i class="fas fa-th-large"></i></span>
                    <div class="panel-admin__stat-info">
                        <h3 class="panel-admin__stat-number">Crear Categorias</h3>
                    </div>
                </a>
                <a href="<?php echo BASE_URL ?>Admin/productos" class="panel-admin__stat-card">
                    <span class="panel-admin__stat-icon"><i class="fas fa-cogs"></i></span>
                    <div class="panel-admin__stat-info">
                        <h3 class="panel-admin__stat-number">Crear Productos</h3>
                    </div>
                </a>
            </div>
            <div class="panel-admin__category-list">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Categoría Principal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($categorias->num_rows > 0) : ?>
                            <?php while ($categoriaProducto = $categorias->fetch_object()) : ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo BASE_URL ?>Admin/categorias">
                                            <i class="fas fa-folder subcategoria-icon"></i>
                                            <?php echo $categoriaProducto->nombre; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>Admin/categorias?id=<?php echo $categoriaProducto->id; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= BASE_URL ?>Admin/eliminarGuardarCategoria?id=<?php echo $categoriaProducto->id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">No hay categorías registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </section>
    </main>
</div>