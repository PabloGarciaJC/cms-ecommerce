<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Catálogo</h2>

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
                                        <a href="<?php echo BASE_URL ?>Admin/catalogo?categoriaId=<?= $breadcrumb['grupo_id']; ?>"><?= htmlspecialchars($breadcrumb['nombre']); ?></a>
                                    <?php else: ?>
                                        <span><?= htmlspecialchars($breadcrumb['nombre']); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
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
            <div class="panel-admin__category-list-catalogo">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Categoría Principal</th>
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
                                    $categoriaUrl = BASE_URL . "Admin/catalogo?categoriaId=" . $categoria->grupo_id;
                                    $editUrl = BASE_URL . "Admin/categorias?editid=" . $categoria->grupo_id . $urlCategoria;
                                    $deleteUrl = BASE_URL . "Admin/categorias?deleteid=" . $categoria->grupo_id . $urlCategoria;
                                    ?>
                                    <td>
                                        <a href="<?= $categoriaUrl ?>">
                                            <i class="fas fa-folder subcategoria-icon"></i>
                                            <?= $categoria->nombre; ?>
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
                                    $editProUrl = BASE_URL . "Admin/productos?editid=" . $producto->grupo_id . $urlProducto;
                                    $deleteProUrl = BASE_URL . "Admin/productos?deleteid=" . $producto->grupo_id . $urlProducto;
                                    $imagenes = json_decode($producto->imagenes);
                                    $imagenProducto = (!empty($imagenes) && !empty($imagenes[0]))
                                        ? BASE_URL . 'uploads/images/productos/' . $imagenes[0]
                                        : BASE_URL . 'uploads/images/productos/default.jpg';
                                    ?>
                                    <td>
                                        <a href="<?= $editProUrl ?>">
                                            <img src="<?php echo $imagenProducto; ?>" alt="Imagen del producto" style="width: 50px;">
                                            <?= $producto->nombre; ?>
                                        </a>
                                    </td>
                                    <td class="align-middle"">
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
<?php unset($_SESSION['exito'], $_SESSION['messageClass']); ?>
<?php unset($_SESSION['errores']); ?>