<style>

</style>

<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>

    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Listado de Categorías</h2>

            <div class="panel-admin__stats-overview">
                <a href="" class="panel-admin__stat-card" onclick="redirectTo('categorias')">
                    <span class="panel-admin__stat-icon"><i class="fas fa-th-large"></i></span>
                    <div class="panel-admin__stat-info">
                        <h3 class="panel-admin__stat-number">Crear Categorias</h3>
                    </div>
                </a>
                <a href="" class="panel-admin__stat-card" onclick="redirectTo('productos')">
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
                            <th>Subcategorías</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categorias)) : ?>
                            <?php foreach ($categorias as $categoria_id => $categoria) : ?>
                                <tr>
                                    <td>
                                        <i class="fas fa-box categoria-icon"></i>
                                        <?= htmlspecialchars($categoria['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </td>
                                    <td class="subcategorias-cell">
                                        <?php if (!empty($categoria['subcategorias'])) : ?>
                                            <ul class="subcategorias-list">
                                                <?php foreach ($categoria['subcategorias'] as $subcategoria) : ?>
                                                    <?php if (isset($subcategoria['nombre'])) : ?>
                                                        <li>
                                                            <i class="fas fa-folder subcategoria-icon"></i>
                                                            <a href="<?= BASE_URL ?>subcategoria/<?= $subcategoria['id'] ?>">
                                                                <?= htmlspecialchars($subcategoria['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>Admin/categorias?id=<?= $categoria_id ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= BASE_URL ?>Admin/eliminarGuardarCategoria?id=<?= $categoria_id ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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