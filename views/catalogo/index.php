<div class="container">
    <div class="breadcrumbs">
        <nav>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo BASE_URL ?>">Inicio</a>
                </li>
                <?php if (!empty($breadcrumbs)): ?>
                    <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
                        <li class="breadcrumb-item">
                            <?php if ($index < count($breadcrumbs) - 1): ?>
                                <a href="<?php echo BASE_URL ?>Catalogo/index?categoriaId=<?= $breadcrumb['id']; ?>"><?= htmlspecialchars($breadcrumb['nombre']); ?></a>
                            <?php else: ?>
                                <span><?= htmlspecialchars($breadcrumb['nombre']); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="filter-container">
        <form method="GET" action="<?= BASE_URL ?>Catalogo/index" class="d-flex w-100">
            <select name="searchCategoriaId">
                <option value="">Subcategorías</option>
                <?php foreach ($getCategorias['categorias'] as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>" <?= (isset($_GET['categoriaId']) && $_GET['categoriaId'] == $categoria['id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($categoria['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="categoriaId" value="<?= $_GET['categoriaId'] ?? ''; ?>" />
            <input type="text" name="minPrecio" placeholder="Precio mínimo" value="<?= $_GET['minPrecio'] ?? ''; ?>" />
            <input type="text" name="maxPrecio" placeholder="Precio máximo" value="<?= $_GET['maxPrecio'] ?? ''; ?>" />
            <button type="submit">Aplicar filtros</button>
        </form>
    </div>
</div>
 <!-- Componente en el Fichero de Catalogo -->
<?php include __DIR__ . '/productos.php'; ?>