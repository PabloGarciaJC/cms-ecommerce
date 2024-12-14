<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Ecommerce</h2>
            <div class="panel-admin__stats-overview <?php echo isset($_GET['categoriaId']) ? 'half-width' : ''; ?>">
                <a href="<?php echo BASE_URL ?>Admin/categorias<?php echo isset($_GET['categoriaId']) ? '?categoriaId=' . $_GET['categoriaId'] : ''; ?>" class="panel-admin__stat-card">
                    <span class="panel-admin__stat-icon"><i class="fas fa-th-large"></i></span>
                    <div class="panel-admin__stat-info">
                        <h3 class="panel-admin__stat-number">Crear Categorias</h3>
                    </div>
                </a>
                <?php if (isset($_GET['categoriaId'])): ?>
                    <a href="<?php echo BASE_URL ?>Admin/productos<?php echo isset($_GET['categoriaId']) ? '?categoriaId=' . $_GET['categoriaId'] : ''; ?>" class="panel-admin__stat-card">
                        <span class="panel-admin__stat-icon"><i class="fas fa-cogs"></i></span>
                        <div class="panel-admin__stat-info">
                            <h3 class="panel-admin__stat-number">Crear Productos</h3>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
            <div class="breadcrumbs">
                <nav>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo BASE_URL ?>Admin/catalogo">Inicio</a>
                        </li>
                        <?php if (!empty($breadcrumbs)): ?>
                            <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
                                <li class="breadcrumb-item">
                                    <?php if ($index < count($breadcrumbs) - 1): ?>
                                        <a href="<?php echo BASE_URL ?>Admin/catalogo?categoriaId=<?= $breadcrumb['id']; ?>"><?= htmlspecialchars($breadcrumb['nombre']); ?></a>
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
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Categorias -->
                        <?php if (!empty($getCategorias['categorias']) && $getCategorias['categorias']->num_rows > 0) : ?>
                            <?php while ($categoria = $getCategorias['categorias']->fetch_object()) : ?>
                                <tr>
                                    <?php
                                    $urlCategoria = isset($categoria->parent_id) && $categoria->parent_id != null ? "&categoriaId=" . $categoria->parent_id : false;
                                    $categoriaUrl = BASE_URL . "Admin/catalogo?categoriaId=" . $categoria->id;
                                    $editUrl = BASE_URL . "Admin/categorias?editid=" . $categoria->id . $urlCategoria;
                                    $deleteUrl = BASE_URL . "Admin/categorias?deleteid=" . $categoria->id . $urlCategoria;
                                    ?>
                                    <td>
                                        <a href="<?= $categoriaUrl ?>">
                                            <i class="fas fa-folder subcategoria-icon"></i>
                                            <?= $categoria->nombre; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= $categoriaUrl ?>">
                                            <?= $categoria->descripcion; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= $editUrl; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= $deleteUrl; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <!-- Productos -->
                        <?php if (!empty($getCategorias['productos']) && $getCategorias['productos']->num_rows > 0) : ?>
                            <?php while ($producto = $getCategorias['productos']->fetch_object()) : ?>
                                <tr>
                                    <?php
                                    $urlProducto = isset($producto->parent_id) && $producto->parent_id != null ? "&categoriaId=" . $producto->parent_id : false;
                                    $productoUrl = BASE_URL . "Admin/productos?categoriaId=" . $producto->parent_id;
                                    $editProUrl = BASE_URL . "Admin/productos?editid=" . $producto->id . $urlProducto;
                                    $deleteProUrl = BASE_URL . "Admin/productos?deleteid=" . $producto->id . $urlProducto;
                                    ?>
                                    <td>
                                        <a href="<?= $productoUrl ?>">
                                        <i class="fas fa-box producto-icon" style="margin-right: 5px;"></i> Productos
                                            <?= $producto->nombre; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= $productoUrl ?>">
                                            <?= $producto->descripcion; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= $editProUrl; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= $deleteProUrl; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<?php unset($_SESSION['errores']); ?>