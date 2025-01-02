<div class="container">
    <div class="breadcrumbs">
        <nav>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo BASE_URL ?>"><?php echo TEXT_INICIO; ?></a>
                </li>
                <?php if (!empty($breadcrumbs)): ?>
                    <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
                        <li class="breadcrumb-item">
                            <?php if ($index < count($breadcrumbs) - 1): ?>
                                <a href="<?php echo BASE_URL ?>Catalogo/index?parent_id=<?= $breadcrumb['grupo_id']; ?>"><?= htmlspecialchars($breadcrumb['nombre']); ?></a>
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
            <input type="hidden" name="parent_id" value="<?= $_GET['parent_id'] ?? ''; ?>" />
            <input type="hidden" name="textoBusqueda" value="<?= $_GET['textoBusqueda'] ?? ''; ?>" />
            <input type="text" name="minPrecio" placeholder="Precio mínimo" value="<?= $_GET['minPrecio'] ?? ''; ?>" />
            <input type="text" name="maxPrecio" placeholder="Precio máximo" value="<?= $_GET['maxPrecio'] ?? ''; ?>" />
            <button type="submit"><?php echo TEXT_TITLE_FILTRO; ?></button>
        </form>
    </div>
</div>

<!-- Componente en el Fichero de Catalogo -->
<?php include __DIR__ . '/box.php'; ?>
<?php include __DIR__ . '/productos.php'; ?>