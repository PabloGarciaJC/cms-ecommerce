<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Ecommerce</h2>
            <?php if (isset($_SESSION['exito'])) : ?>
                <div class="alert alert-success alert-dismissible fade show mt-2 success-alert" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo $_SESSION['exito']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['exito']); ?>
            <?php endif; ?>
            <div class="panel-admin__stats-overview">
                <a href="<?php echo BASE_URL ?>Admin/categorias<?php echo isset($_GET['parentid']) ? '?parentid=' . $_GET['parentid'] : false; ?>" class="panel-admin__stat-card">
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

            <div class="breadcrumbs">
                <nav>
                    <ul class="breadcrumb">
                        <!-- Elemento fijo: Inicio -->
                        <li class="breadcrumb-item">
                            <a href="<?php echo BASE_URL ?>Admin/ecommerce">Inicio</a>
                        </li>

                        <!-- Elementos dinámicos: Migas de pan -->
                        <?php if (!empty($breadcrumbs)): ?>
                            <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
                                <li class="breadcrumb-item">
                                    <?php if ($index < count($breadcrumbs) - 1): ?>
                                        <a href="<?php echo BASE_URL ?>Admin/ecommerce?parentid=<?= $breadcrumb['id']; ?>"><?= htmlspecialchars($breadcrumb['nombre']); ?></a>
                                    <?php else: ?>
                                        <span><?= htmlspecialchars($breadcrumb['nombre']); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
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
                        <?php if ($getCategorias->num_rows > 0) : ?>
                            <?php while ($categoriaProducto = $getCategorias->fetch_object()) : ?>
                                <?php
                                $parentid = isset($categoriaProducto->parent_id) ? $categoriaProducto->parent_id : false;
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo BASE_URL ?>Admin/ecommerce&parentid=<?php echo $categoriaProducto->id; ?>">
                                            <i class="fas fa-folder subcategoria-icon"></i>
                                            <?php echo $categoriaProducto->nombre; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>Admin/categorias?editid=<?php echo $categoriaProducto->id; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= BASE_URL ?>Admin/categorias?deteleid=<?php echo $categoriaProducto->id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
<?php unset($_SESSION['errores']); ?>