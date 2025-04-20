
<div class="container py-xl-4">
    <div class="product-sec1 container">
        <div class="row pb-5">
            <?php if (!empty($getCategorias['productos']) && $getCategorias['productos']->num_rows > 0) : ?>
                <?php while ($prod = $getCategorias['productos']->fetch_object()) : ?>
                    <?php include __DIR__ . '../../producto/plantilla.php'; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="container p-3"><?php echo ERROR_NO_PRODUCTS_FOUND; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>