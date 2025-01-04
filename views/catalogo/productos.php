<div class="container py-xl-4 py-lg-2 ">
    <div class="product-sec1 container py-sm-5 mb-4">
        <div class="row">
            <?php if (!empty($getCategorias['productos']) && $getCategorias['productos']->num_rows > 0) : ?>
                <?php while ($prod = $getCategorias['productos']->fetch_object()) : ?>
                    <?php include __DIR__ . '../../producto/plantilla.php'; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="container"><?php echo ERROR_NO_PRODUCTS_FOUND; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>